<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add User | LavaLust</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f7f6;
            color: #263238;
        }

        .container {
            max-width: 650px;
            margin: 60px auto;
            background: white;
            padding: 35px;
            border-radius: 14px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.07);
        }

        h1 {
            margin-bottom: 8px;
        }

        .subtitle {
            color: #7a8781;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d9e0dc;
            border-radius: 8px;
            margin-bottom: 20px;
            outline: none;
        }

        input:focus {
            border-color: #3b8f61;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        button,
        a {
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        button {
            background: #3b8f61;
            color: white;
        }

        .back {
            background: #e9eeeb;
            color: #425049;
        }
    </style>
</head>

<body>

    <div class="container">

        <h1>Add New User</h1>

        <p class="subtitle">
            Enter the user's information below.
        </p>

        <form action="/users/store" method="POST">

            <label>First Name</label>
            <input type="text" name="firstname" required>

            <label>Last Name</label>
            <input type="text" name="lastname" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Username</label>
            <input type="text" name="username" required>

            <div class="buttons">

                <button type="submit">
                    Save User
                </button>

                <a href="/users" class="back">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</body>

</html>