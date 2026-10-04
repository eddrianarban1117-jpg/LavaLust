<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class ApiAuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->library('api');
    }

    public function login()
    {
        $this->api->require_method('POST');
        $this->api->rate_limit();

        $input = $this->api->body();

        $username = trim($input['username'] ?? '');
        $password = $input['password'] ?? '';

        /*
        |--------------------------------------------------------------------------
        | Lab 5 / Lab 6 Login Credentials
        |--------------------------------------------------------------------------
        */

        $valid_username = 'admin';
        $valid_password = 'admin123';

        if (
            $username !== $valid_username ||
            $password !== $valid_password
        ) {
            $this->api->respond_error(
                'Invalid username or password.',
                401
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Generate JWT Access + Refresh Tokens
        |--------------------------------------------------------------------------
        |
        | The API library requires a user ID.
        | User ID 1 is used for the Lab 6 admin account.
        |
        */

        $tokens = $this->api->issue_tokens([
            'id' => 1,
            'role' => 'admin',
            'scopes' => [
                'read',
                'write'
            ]
        ]);

        $this->api->respond([
            'status' => true,
            'message' => 'Login successful.',
            'user' => [
                'id' => 1,
                'username' => $username,
                'role' => 'admin'
            ],
            'tokens' => $tokens
        ]);
    }
}
?>