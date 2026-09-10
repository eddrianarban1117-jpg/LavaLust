<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add User | LavaLust</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #0b0b0b;
            color: #ffffff;
            min-height: 100vh;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.035) 1px, transparent 1px);
            background-size: 75px 75px;
            pointer-events: none;
        }

        .navbar {
            position: relative;
            height: 80px;
            border-bottom: 1px solid #252525;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
            background: rgba(11, 11, 11, 0.95);
        }

        .logo {
            font-size: 25px;
            font-weight: 700;
            letter-spacing: -1px;
        }

        .logo span {
            color: #f04b16;
        }

        .nav-link {
            color: #a5a5a5;
            text-decoration: none;
            font-size: 14px;
        }

        .nav-link:hover {
            color: #ffffff;
        }

        .container {
            position: relative;
            width: 90%;
            max-width: 700px;
            margin: 65px auto;
        }

        .back {
            display: inline-block;
            color: #999999;
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 25px;
        }

        .back:hover {
            color: #ffffff;
        }

        .title {
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 42px;
            letter-spacing: -1.5px;
            margin-bottom: 8px;
        }

        .title h1 span {
            color: #f04b16;
        }

        .title p {
            color: #777777;
            font-size: 15px;
        }

        .card {
            background: #111111;
            border: 1px solid #303030;
            border-radius: 12px;
            padding: 32px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            font-size: 14px;
            font-weight: bold;
            color: #eeeeee;
        }

        input {
            width: 100%;
            padding: 14px 15px;
            background: #171717;
            border: 1px solid #363636;
            border-radius: 7px;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        input::placeholder {
            color: #666666;
        }

        input:focus {
            border-color: #f04b16;
            box-shadow: 0 0 0 2px rgba(240, 75, 22, 0.12);
        }

        .buttons {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .submit-btn,
        .cancel-btn {
            flex: 1;
            padding: 14px;
            border-radius: 7px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .submit-btn {
            border: none;
            background: #f04b16;
            color: #ffffff;
        }

        .submit-btn:hover {
            background: #ff5c25;
        }

        .cancel-btn {
            background: transparent;
            color: #999999;
            border: 1px solid #363636;
        }

        .cancel-btn:hover {
            background: #1b1b1b;
            color: #ffffff;
        }

        @media (max-width: 600px) {

            .navbar {
                padding: 0 5%;
            }

            .container {
                width: 92%;
                margin: 40px auto;
            }

            .title h1 {
                font-size: 34px;
            }

            .card {
                padding: 24px;
            }

            .buttons {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">

        <div class="logo">
            Lava<span>Lust</span>
        </div>

        <a href="/users" class="nav-link">
            Users
        </a>

    </nav>


    <main class="container">

        <a href="/users" class="back">
            ← Back to Users
        </a>

        <div class="title">
            <h1>Add <span>User</span></h1>
            <p>Create a new user in the system.</p>
        </div>


        <div class="card">

            <form action="/users/store" method="POST">

                <div class="form-group">

                    <label for="firstname">
                        First Name
                    </label>

                    <input
                        type="text"
                        id="firstname"
                        name="firstname"
                        placeholder="Enter first name"
                        required>

                </div>


                <div class="form-group">

                    <label for="lastname">
                        Last Name
                    </label>

                    <input
                        type="text"
                        id="lastname"
                        name="lastname"
                        placeholder="Enter last name"
                        required>

                </div>


                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter email address"
                        required>

                </div>


                <div class="form-group">

                    <label for="username">
                        Username
                    </label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Enter username"
                        required>

                </div>


                <div class="buttons">

                    <button type="submit" class="submit-btn">
                        Add User
                    </button>

                    <a href="/users" class="cancel-btn">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </main>

</body>

</html>