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
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f7f6;
            color: #263238;
        }

        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 240px;
            height: 100vh;
            background: #17221d;
            color: white;
            padding: 25px 18px;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 40px;
            padding-left: 10px;
        }

        .logo span {
            color: #65c18c;
        }

        .nav-title {
            font-size: 12px;
            color: #8d9a94;
            margin: 20px 10px 10px;
            text-transform: uppercase;
        }

        .nav-item {
            display: block;
            padding: 13px 15px;
            color: #c9d1cd;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
        }

        .nav-item:hover,
        .nav-item.active {
            background: #2d4939;
            color: white;
        }

        .main {
            margin-left: 240px;
            min-height: 100vh;
            padding: 30px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-size: 28px;
            margin-bottom: 6px;
        }

        .page-title p {
            color: #7a8781;
            font-size: 14px;
        }

        .admin {
            background: white;
            padding: 10px 16px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.06);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .card-header h2 {
            font-size: 20px;
        }

        .add-btn {
            background: #3b8f61;
            color: white;
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .add-btn:hover {
            background: #2f754e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #f0f5f2;
            color: #52615a;
            text-align: left;
            padding: 14px;
            font-size: 13px;
        }

        td {
            padding: 15px 14px;
            border-bottom: 1px solid #edf0ee;
            font-size: 14px;
        }

        tr:hover {
            background: #fafcfb;
        }

        .id {
            font-weight: bold;
            color: #3b8f61;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .edit-btn,
        .delete-btn {
            padding: 7px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 12px;
            font-weight: bold;
        }

        .edit-btn {
            background: #e6f3eb;
            color: #287047;
        }

        .delete-btn {
            background: #fdeaea;
            color: #c0392b;
        }

        .edit-btn:hover {
            background: #d2ebdc;
        }

        .delete-btn:hover {
            background: #f8d5d2;
        }

        @media (max-width: 800px) {
            .sidebar {
                width: 190px;
            }

            .main {
                margin-left: 190px;
                padding: 20px;
            }

            table {
                font-size: 12px;
            }

            .card {
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="logo">
            Lava<span>Lust</span>
        </div>

        <div class="nav-title">Menu</div>

        <a href="/users" class="nav-item active">
            Dashboard
        </a>

        <a href="/users" class="nav-item">
            Users
        </a>

    </aside>

    <main class="main">

        <div class="topbar">

            <div class="page-title">
                <h1>User Management</h1>
                <p>Manage registered users in the system.</p>
            </div>

            <div class="admin">
                Admin
            </div>

        </div>

        <div class="card">

            <div class="card-header">

                <h2>Users List</h2>

                <a href="/users/create" class="add-btn">
                    + Add User
                </a>

            </div>

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

                </tbody>

            </table>

        </div>

    </main>

</body>

</html>