<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Show Login Page
    |--------------------------------------------------------------------------
    */

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        /*
        |--------------------------------------------------------------------------
        | If Already Logged In
        |--------------------------------------------------------------------------
        */

        if (
            isset($_SESSION['authenticated']) &&
            $_SESSION['authenticated'] === true
        ) {
            redirect(site_url('products'));
            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Display Login Page
        |--------------------------------------------------------------------------
        */

        $this->call->view('login');
    }


    /*
    |--------------------------------------------------------------------------
    | Process Login
    |--------------------------------------------------------------------------
    */

    public function authenticate()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect(site_url('login'));
            return;
        }

        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';

        /*
        |--------------------------------------------------------------------------
        | Load Authentication Class
        |--------------------------------------------------------------------------
        */

        require_once APP_DIR . 'middlewares/Auth.php';


        /*
        |--------------------------------------------------------------------------
        | Validate Login
        |--------------------------------------------------------------------------
        */

        if (Auth::login($username, $password)) {

            redirect(site_url('products'));
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | Login Failed
        |--------------------------------------------------------------------------
        */

        $data = [
            'error' => 'Invalid username or password.'
        ];

        $this->call->view('login', $data);
    }


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public function logout()
    {
        require_once APP_DIR . 'middlewares/Auth.php';

        Auth::logout();

        redirect(site_url('login'));
    }
}
?>