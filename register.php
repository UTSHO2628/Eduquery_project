<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // password hash
    $role = $_POST['role'];

    // Check if user already exists
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        echo "<script>alert('Email already registered!'); window.location.href='register.php';</script>";
    } else {
        $query = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', '$role')";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Registration successful!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Something went wrong!');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - EduQuery</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Register</h2>
        <form method="POST" action="">
            <input type="email" name="email" placeholder="Enter Email" required><br>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <select name="role" required>
                <option value="">Select Role</option>
                <option value="student">Student</option>
                <option value="admin">Admin</option>
            </select><br>
            <button type="submit">Register</button>
        </form>
        <p>Already registered? <a href="index.php">Login</a></p>
    </div>
</body>
</html>
