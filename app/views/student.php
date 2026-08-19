<!DOCTYPE html>
<html>
<head>
    <title>My Student Hub</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f7;
            margin: 0;
        }

        .container {
            width: 80%;
            max-width: 800px;
            margin: 80px auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h1 {
            color: #243b53;
        }

        p {
            color: #52606d;
        }

        a {
            display: inline-block;
            margin: 10px;
            padding: 12px 20px;
            background: #243b53;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        a:hover {
            background: #102a43;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Welcome to My Student Hub</h1>

    <p>
        This is my LavaLust Student Information Application.
    </p>

    <a href="<?= site_url('student'); ?>">
        Home
    </a>

    <a href="<?= site_url('student/profile'); ?>">
        Student Profile
    </a>

</div>

</body>
</html>