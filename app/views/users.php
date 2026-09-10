<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>User Management | LavaLust</title>

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

        /* Background Grid */
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
            transition: 0.2s;
        }

        .nav-link:hover {
            color: #ffffff;
        }

        .container {
            position: relative;
            width: 90%;
            max-width: 1150px;
            margin: 70px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .title h1 {
            font-size: 34px;
            letter-spacing: -1px;
            margin-bottom: 8px;
        }

        .title p {
            color: #777777;
            font-size: 14px;
        }

        .add-btn {
            display: inline-block;
            background: #f04b16;
            color: #ffffff;
            text-decoration: none;
            padding: 13px 20px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: bold;
            transition: 0.2s;
        }

        .add-btn:hover {
            background: #ff5c25;
            transform: translateY(-1px);
        }

        .card {
            background: #111111;
            border: 1px solid #292929;
            border-radius: 12px;
            overflow: hidden;
        }

        .card-header {
            padding: 22px 25px;
            border-bottom: 1px solid #292929;
        }

        .card-header h2 {
            font-size: 18px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #151515;
            color: #888888;
            text-align: left;
            padding: 16px 20px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 17px 20px;
            border-top: 1px solid #222222;
            color: #d7d7d7;
            font-size: 14px;
        }

        tbody tr {
            transition: 0.2s;
        }

        tbody tr:hover {
            background: #171717;
        }

        .id {
            color: #f04b16;
            font-weight: bold;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            display: inline-block;
            padding: 7px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
            transition: 0.2s;
        }

        .edit-btn {
            background: #242424;
            color: #ffffff;
            border: 1px solid #3a3a3a;
        }

        .edit-btn:hover {
            background: #333333;
        }

        .delete-btn {
            background: #321814;
            color: #ff6940;
            border: 1px solid #4a2119;
        }

        .delete-btn:hover {
            background: #4a1f16;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #777777;
        }

        @media (max-width: 700px) {

            .navbar {
                padding: 0 5%;
            }

            .container {
                width: 94%;
                margin: 40px auto;
            }

            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .title h1 {
                font-size: 28px;
            }

            .add-btn {
                width: 100%;
                text-align: center;
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

        <div class="header">

            <div class="title">
                <h1>User Management</h1>
                <p>Manage users stored in the system.</p>
            </div>

            <a href="/users/create" class="add-btn">
                + Add User
            </a>

        </div>


        <div class="card">

            <div class="card-header">
                <h2>Users</h2>
            </div>

            <div class="table-container">

                <table>

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (!empty($users)): ?>

                            <?php foreach ($users as $user): ?>

                                <tr>

                                    <td class="id">
                                        <?= $user['id']; ?>
                                    </td>

                                    <td>
                                        <?= $user['firstname']; ?>
                                    </td>

                                    <td>
                                        <?= $user['lastname']; ?>
                                    </td>

                                    <td>
                                        <?= $user['email']; ?>
                                    </td>

                                    <td>
                                        <?= $user['username']; ?>
                                    </td>

                                    <td>

                                        <div class="actions">

                                            <a
                                                href="/users/edit/<?= $user['id']; ?>"
                                                class="edit-btn">
                                                Edit
                                            </a>

                                            <a
                                                href="/users/delete/<?= $user['id']; ?>"
                                                class="delete-btn"
                                                onclick="return confirm('Are you sure you want to delete this user?');">
                                                Delete
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>
                                <td colspan="6" class="empty">
                                    No users found.
                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </main>

</body>

</html>