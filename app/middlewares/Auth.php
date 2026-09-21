<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class Auth
{
    /*
    |--------------------------------------------------------------------------
    | Default Login Credentials
    |--------------------------------------------------------------------------
    |
    | These credentials are for the laboratory authentication.
    | Do NOT use your database password here.
    |
    */

    private const USERNAME = 'admin';
    private const PASSWORD = 'admin123';


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    public static function login($username, $password)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (
            $username === self::USERNAME &&
            $password === self::PASSWORD
        ) {
            session_regenerate_id(true);

            $_SESSION['authenticated'] = true;
            $_SESSION['username'] = $username;

            return true;
        }

        return false;
    }


    /*
    |--------------------------------------------------------------------------
    | Check Authentication
    |--------------------------------------------------------------------------
    */

    public static function check()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return isset($_SESSION['authenticated'])
            && $_SESSION['authenticated'] === true;
    }


    /*
    |--------------------------------------------------------------------------
    | Get Logged-in Username
    |--------------------------------------------------------------------------
    */

    public static function user()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        return $_SESSION['username'] ?? null;
    }


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    public static function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        if (ini_get('session.use_cookies')) {

            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }
}
?>