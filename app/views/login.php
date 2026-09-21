<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$error = $error ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login | LavaLust</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            background:
                linear-gradient(
                    rgba(10, 10, 10, 0.95),
                    rgba(10, 10, 10, 0.98)
                ),
                repeating-linear-gradient(
                    45deg,
                    #111111 0px,
                    #111111 10px,
                    #151515 10px,
                    #151515 20px
                );

            color: #ffffff;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 20px;
        }


        /* ======================================================
           LOGIN CONTAINER
        ====================================================== */

        .login-container {
            width: 100%;
            max-width: 430px;
        }


        /* ======================================================
           LOGO
        ====================================================== */

        .logo-section {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo {
            font-size: 36px;
            font-weight: 800;
            letter-spacing: 2px;
        }

        .logo span {
            color: #ff7a00;
        }

        .subtitle {
            margin-top: 8px;

            color: #999999;

            font-size: 14px;
        }


        /* ======================================================
           LOGIN CARD
        ====================================================== */

        .login-card {
            background: #1b1b1b;

            border: 1px solid #303030;

            border-radius: 14px;

            padding: 35px;

            box-shadow:
                0 15px 45px rgba(0, 0, 0, 0.45);
        }

        .login-card h2 {
            text-align: center;

            margin-bottom: 8px;

            font-size: 25px;
        }

        .login-description {
            text-align: center;

            color: #999999;

            font-size: 14px;

            margin-bottom: 28px;
        }


        /* ======================================================
           ERROR MESSAGE
        ====================================================== */

        .alert {
            background:
                rgba(220, 53, 69, 0.12);

            border:
                1px solid #dc3545;

            color:
                #ff7b86;

            padding:
                12px 14px;

            border-radius:
                8px;

            margin-bottom:
                20px;

            font-size:
                14px;

            line-height:
                1.5;
        }


        /* ======================================================
           FORM
        ====================================================== */

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            color: #dddddd;

            font-size: 14px;

            font-weight: 600;
        }

        .form-group input {
            width: 100%;

            padding: 13px 14px;

            background: #111111;

            border:
                1px solid #3a3a3a;

            border-radius: 8px;

            color: #ffffff;

            font-size: 15px;

            outline: none;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease;
        }

        .form-group input::placeholder {
            color: #666666;
        }

        .form-group input:focus {
            border-color:
                #ff7a00;

            box-shadow:
                0 0 0 3px
                rgba(255, 122, 0, 0.12);
        }


        /* ======================================================
           LOGIN BUTTON
        ====================================================== */

        .login-button {
            width: 100%;

            padding: 14px;

            border: none;

            border-radius: 8px;

            background: #ff7a00;

            color: #ffffff;

            font-size: 15px;

            font-weight: 700;

            cursor: pointer;

            transition:
                background 0.2s ease,
                transform 0.1s ease;
        }

        .login-button:hover {
            background: #e96d00;
        }

        .login-button:active {
            transform: translateY(1px);
        }


        /* ======================================================
           LOGIN INFORMATION
        ====================================================== */

        .login-info {
            margin-top: 22px;

            padding: 14px;

            border-radius: 8px;

            background: #111111;

            border: 1px solid #2d2d2d;

            text-align: center;
        }

        .login-info-title {
            color: #999999;

            font-size: 12px;

            margin-bottom: 6px;
        }

        .login-info-text {
            color: #777777;

            font-size: 12px;

            line-height: 1.5;
        }


        /* ======================================================
           FOOTER
        ====================================================== */

        .footer {
            text-align: center;

            margin-top: 22px;

            color: #666666;

            font-size: 12px;
        }


        /* ======================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 480px) {

            body {
                padding: 15px;
            }

            .login-card {
                padding: 25px 20px;
            }

            .logo {
                font-size: 30px;
            }

        }

    </style>

</head>


<body>

    <div class="login-container">


        <!-- ==================================================
             LOGO
        ================================================== -->

        <div class="logo-section">

            <div class="logo">
                Lava<span>Lust</span>
            </div>

            <div class="subtitle">
                Student Product Management System
            </div>

        </div>


        <!-- ==================================================
             LOGIN CARD
        ================================================== -->

        <div class="login-card">

            <h2>
                Welcome Back
            </h2>

            <p class="login-description">
                Sign in to access the product management system.
            </p>


            <!-- ==================================================
                 ERROR MESSAGE
            ================================================== -->

            <?php if (!empty($error)): ?>

                <div
                    class="alert"
                    role="alert"
                >
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>


            <!-- ==================================================
                 LOGIN FORM
            ================================================== -->

            <form
                method="POST"
                action="<?= site_url('login/authenticate') ?>"
            >


                <!-- USERNAME -->

                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter your username"
                        autocomplete="username"
                        required
                    >

                </div>


                <!-- PASSWORD -->

                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >

                </div>


                <!-- LOGIN BUTTON -->

                <button
                    type="submit"
                    class="login-button"
                >
                    Login
                </button>

            </form>


            <!-- ==================================================
                 INFORMATION
            ================================================== -->

            <div class="login-info">

                <div class="login-info-title">
                    Authentication Required
                </div>

                <div class="login-info-text">
                    Please enter your valid account credentials
                    to continue to the Product Management System.
                </div>

            </div>

        </div>


        <!-- ==================================================
             FOOTER
        ================================================== -->

        <div class="footer">
            LavaLust CRUD Application
        </div>

    </div>

</body>

</html>