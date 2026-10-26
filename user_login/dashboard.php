
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$username = htmlspecialchars(
    $_SESSION["username"],
    ENT_QUOTES,
    "UTF-8"
);

$email = htmlspecialchars(
    $_SESSION["email"],
    ENT_QUOTES,
    "UTF-8"
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, <?= $username ?>!</h1>

    <h2>Dashboard</h2>

    <p>You have successfully logged in.</p>

    <h3>User Details</h3>
    <p>Username: <?= $username ?></p>
    <p>Email: <?= $email ?></p>

    <a href="logout.php">Logout</a>
</body>
</html>
