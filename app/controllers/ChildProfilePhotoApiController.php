<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ChildProfilePhotoApiController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->call->library('api');
        $this->call->model('UsersModel');
    }

    public function parent_photo($id)
    {
        $this->api->require_method('GET');
        $parent = $this->authenticated_user('parent');
        if (!$parent) return;

        $child_id = $this->valid_child_id($id);
        if (!$child_id) return;
        $child = $this->db->table('children')
            ->select('profile_photo')
            ->where('id', $child_id)
            ->where('parent_user_id', (int) $parent['id'])
            ->get();
        if (!$child) {
            $this->api->respond_error('Child profile not found.', 404);
            return;
        }

        $this->send_photo($child['profile_photo'] ?? '', $child_id);
    }

    public function upload_parent_photo($id)
    {
        $this->api->require_method('POST');
        $parent = $this->authenticated_user('parent');
        if (!$parent) return;

        $child_id = $this->valid_child_id($id);
        if (!$child_id) return;
        $child = $this->db->table('children')
            ->select('profile_photo')
            ->where('id', $child_id)
            ->where('parent_user_id', (int) $parent['id'])
            ->get();
        if (!$child) {
            $this->api->respond_error('Child profile not found.', 404);
            return;
        }

        try {
            $photo = $this->validate_photo($_FILES['profile_photo'] ?? null);
            $stored_photo = $this->store_photo($photo, $child_id);
        } catch (InvalidArgumentException $error) {
            $this->api->respond_error($error->getMessage(), 400);
            return;
        }

        try {
            $this->db->table('children')
                ->where('id', $child_id)
                ->where('parent_user_id', (int) $parent['id'])
                ->update([
                    'profile_photo' => $stored_photo['relative_path'],
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
        } catch (Throwable $error) {
            if (is_file($stored_photo['absolute_path'])) {
                unlink($stored_photo['absolute_path']);
            }
            throw $error;
        }

        $this->delete_photo($child['profile_photo'] ?? '', $child_id);
        $this->api->respond([
            'status' => true,
            'message' => 'Child profile photo updated.',
        ]);
    }

    public function teacher_photo($id)
    {
        $this->api->require_method('GET');
        $teacher = $this->authenticated_user('teacher');
        if (!$teacher) return;

        $child_id = $this->valid_child_id($id);
        if (!$child_id) return;
        $child = $this->db->raw(
            'SELECT c.profile_photo
             FROM children c
             WHERE c.id = ?
               AND c.enrollment_status = \'enrolled\'
               AND (
                   EXISTS (
                       SELECT 1
                       FROM class_students cs
                       JOIN classes cl ON cl.id = cs.class_id
                       JOIN teacher_profiles tp ON tp.cdc_id = cl.cdc_id
                       WHERE cs.child_id = c.id AND tp.user_id = ?
                         AND tp.employment_status = \'active\' AND cl.status = \'active\'
                   )
                   OR EXISTS (
                       SELECT 1 FROM child_transfer_requests transfer
                       WHERE transfer.child_id = c.id
                         AND transfer.receiving_teacher_user_id = ?
                         AND transfer.status = \'awaiting_receiving_cdc\'
                   )
               )
             LIMIT 1',
            [$child_id, (int) $teacher['id'], (int) $teacher['id']]
        )->fetch(PDO::FETCH_ASSOC);
        if (!$child) {
            $this->api->respond_error('Assigned child profile not found.', 404);
            return;
        }

        $this->send_photo($child['profile_photo'] ?? '', $child_id);
    }

    private function authenticated_user($role)
    {
        $payload = $this->api->require_jwt();
        $user_id = filter_var($payload['sub'] ?? null, FILTER_VALIDATE_INT);
        if (!$user_id) {
            $this->api->respond_error('Unauthorized.', 401);
            return null;
        }

        $user = $this->UsersModel->find_by_id($user_id);
        if (!$user || (int) $user['is_active'] !== 1) {
            $this->api->respond_error('Account is unavailable.', 401);
            return null;
        }
        if ($user['role'] !== $role) {
            $this->api->respond_error('You are not authorized to access this child profile photo.', 403);
            return null;
        }
        if ($role === 'teacher') {
            $teacher_access = $this->call->library('TeacherAccess', $this->db);
            if (!$teacher_access->is_active((int) $user['id'])) {
                $this->api->respond_error('Teacher account approval and invitation acceptance are required.', 403);
                return null;
            }
        }
        return $user;
    }

    private function valid_child_id($id)
    {
        $child_id = filter_var($id, FILTER_VALIDATE_INT);
        if (!$child_id || $child_id < 1) {
            $this->api->respond_error('Invalid child profile.', 400);
            return null;
        }
        return (int) $child_id;
    }

    private function validate_photo($file)
    {
        if (!$file || ($file['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_NO_FILE) {
            throw new InvalidArgumentException('Choose a JPG or PNG profile photo to upload.');
        }
        if (($file['error'] ?? UPLOAD_ERR_OK) !== UPLOAD_ERR_OK
            || !is_uploaded_file($file['tmp_name'] ?? '')
            || ($file['size'] ?? 0) <= 0
            || $file['size'] > 2097152) {
            throw new InvalidArgumentException('Profile photos must be JPG or PNG files no larger than 2 MB.');
        }

        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        $image = @getimagesize($file['tmp_name']);
        $extensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
        ];
        if (!isset($extensions[$mime]) || !$image || ($image['mime'] ?? null) !== $mime) {
            throw new InvalidArgumentException('Profile photos must be valid JPG or PNG images.');
        }

        return [
            'tmp_name' => $file['tmp_name'],
            'extension' => $extensions[$mime],
        ];
    }

    private function store_photo(array $photo, $child_id)
    {
        $directory = ROOT_DIR . 'runtime/uploads/child-profile-photos/' . (int) $child_id;
        if (!is_dir($directory) && !mkdir($directory, 0750, true) && !is_dir($directory)) {
            throw new RuntimeException('Could not create the private child photo directory.');
        }

        $stored_name = bin2hex(random_bytes(20)) . '.' . $photo['extension'];
        $absolute_path = $directory . DIRECTORY_SEPARATOR . $stored_name;
        if (!move_uploaded_file($photo['tmp_name'], $absolute_path)) {
            throw new RuntimeException('Could not store the child profile photo.');
        }

        return [
            'absolute_path' => $absolute_path,
            'relative_path' => 'runtime/uploads/child-profile-photos/' . (int) $child_id . '/' . $stored_name,
        ];
    }

    private function send_photo($relative_path, $child_id)
    {
        if ($relative_path === '') {
            http_response_code(204);
            return;
        }
        if (!preg_match(
            '#^runtime/uploads/child-profile-photos/' . (int) $child_id . '/[a-f0-9]{40}\.(?:jpg|png)$#D',
            (string) $relative_path
        )) {
            $this->api->respond_error('The saved child profile photo path is invalid.', 500);
            return;
        }

        $path = ROOT_DIR . str_replace('/', DIRECTORY_SEPARATOR, $relative_path);
        if (!is_file($path) || !is_readable($path)) {
            $this->api->respond_error('The saved child profile photo could not be found.', 404);
            return;
        }

        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($path);
        if (!in_array($mime, ['image/jpeg', 'image/png'], true)) {
            $this->api->respond_error('The saved child profile photo has an unsupported format.', 500);
            return;
        }

        header('Content-Type: ' . $mime);
        header('Content-Length: ' . (string) filesize($path));
        header('Cache-Control: private, no-store');
        header('X-Content-Type-Options: nosniff');
        readfile($path);
        exit;
    }

    private function delete_photo($relative_path, $child_id)
    {
        if (!preg_match(
            '#^runtime/uploads/child-profile-photos/' . (int) $child_id . '/[a-f0-9]{40}\.(?:jpg|png)$#D',
            (string) $relative_path
        )) {
            return;
        }
        $path = ROOT_DIR . str_replace('/', DIRECTORY_SEPARATOR, $relative_path);
        if (is_file($path) && !unlink($path)) {
            error_log('Could not remove the replaced child profile photo: ' . $path);
        }
    }
}
