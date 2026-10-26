
<?php
require_once "db.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    if (
        $username === "" ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($password) < 8
    ) {
        $message = "Enter valid details. Password must be at least 8 characters.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare(
            "INSERT INTO users (username, email, password)
             VALUES (?, ?, ?)"
        );
        $stmt->bind_param("sss", $username, $email, $hash);

        if ($stmt->execute()) {
            header("Location: login.php");
            exit;
        } else {
            $message = $stmt->errno === 1062
                ? "This email is already registered."
                : "Registration failed. Please try again.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Registration</title>
</head>
<body>
    <h2>Create Account</h2>

    <p><?= htmlspecialchars($message, ENT_QUOTES, "UTF-8") ?></p>

    <form method="POST" action="register.php">
        <label>Username:</label><br>
        <input type="text" name="username" maxlength="100"
               required><br><br>

        <label>Email:</label><br>
        <input type="email" name="email" maxlength="150"
               required><br><br>

        <label>Password (minimum 8 characters):</label><br>
        <input type="password" name="password"
               minlength="8" required><br><br>

        <button type="submit">Register</button>
    </form>

    <p>Already registered?
        <a href="login.php">Login here</a>
    </p>
</body>
</html>
