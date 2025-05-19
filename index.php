<?php
session_start();
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $res = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($res) == 1) {
        $user = mysqli_fetch_assoc($res);
        $_SESSION['user'] = $user;
        
        if ($user['role'] == 'admin') {
            header("Location: admin_panel.php");
        } else {
            header("Location: dashboard.php");
        }
    } else {
        echo "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login - EduQuery</title></head>
<body>
<h2>Login</h2>
<form method="POST">
  Username: <input name="username" required><br>
  Password: <input name="password" type="password" required><br>
  <button type="submit">Login</button>
</form>
</body>
</html>
