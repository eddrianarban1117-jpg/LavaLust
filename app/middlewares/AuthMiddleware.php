<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthMiddleware
{
    public function handle(Closure $next)
    {
        /*
        |--------------------------------------------------------------------------
        | Start Session
        |--------------------------------------------------------------------------
        */

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }


        /*
        |--------------------------------------------------------------------------
        | Check Authentication
        |--------------------------------------------------------------------------
        */

        if (
            !isset($_SESSION['authenticated']) ||
            $_SESSION['authenticated'] !== true
        ) {
            /*
            | User is NOT logged in.
            | Redirect to login page.
            */

            redirect(site_url('login'));
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | User is Authenticated
        |--------------------------------------------------------------------------
        */

        return $next();
    }
}
?>