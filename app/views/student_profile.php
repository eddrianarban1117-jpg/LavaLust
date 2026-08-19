<!DOCTYPE html>
<html>
<head>
    <title>My Student Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #eef2f7;
            margin: 0;
        }

        .profile {
            width: 80%;
            max-width: 700px;
            margin: 50px auto;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #243b53;
        }

        .info {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .label {
            font-weight: bold;
        }

        .navigation {
            text-align: center;
            margin-top: 25px;
        }

        a {
            display: inline-block;
            padding: 10px 18px;
            margin: 5px;
            text-decoration: none;
            background: #243b53;
            color: white;
            border-radius: 7px;
        }
    </style>
</head>

<body>

<div class="profile">

    <h1>My Student Profile</h1>

    <div class="info">
        <span class="label">Student ID:</span>
        <?= $student_id ?>
    </div>

    <div class="info">
        <span class="label">Name:</span>
        <?= $name ?>
    </div>

    <div class="info">
        <span class="label">Course:</span>
        <?= $course ?>
    </div>

    <div class="info">
        <span class="label">Year Level:</span>
        <?= $year ?>
    </div>

    <div class="info">
        <span class="label">Section:</span>
        <?= $section ?>
    </div>

    <div class="info">
        <span class="label">Email:</span>
        <?= $email ?>
    </div>

    <div class="navigation">

        <a href="<?= site_url('student'); ?>">
            Home
        </a>

        <a href="<?= site_url('student/profile'); ?>">
            Student Profile
        </a>

    </div>

</div>

</body>
</html>