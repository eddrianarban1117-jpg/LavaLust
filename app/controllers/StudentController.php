<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentController extends Controller {

    public function index() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Allow access to the student profile
        $_SESSION['student_access'] = true;

        $this->call->view('student');
    }

    public function profile() {

        $student = [
            'student_id' => 'MCC2024-00093',
            'name'       => 'ARBAN, EDDRIAN S.',
            'course'     => 'BS Information Technology',
            'year'       => '3rd Year',
            'section'    => 'BSIT-3F2',
            'email'      => 'eddrianarban1117@gmail.com'
        ];

        $this->call->view('student_profile', $student);
    }
}
?>