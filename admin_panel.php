<?php
session_start();
include 'db/config.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Handle Add FAQ
if (isset($_POST['add'])) {
    $q = mysqli_real_escape_string($conn, $_POST['question']);
    $a = mysqli_real_escape_string($conn, $_POST['answer']);
    mysqli_query($conn, "INSERT INTO faqs(question, answer) VALUES('$q','$a')");
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM faqs WHERE id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel – EduQuery</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Admin Panel – Manage FAQs</h2>
    <a href="logout.php">Logout</a>
    <form method="POST">
        <input type="text" name="question" placeholder="Enter Question" required>
        <input type="text" name="answer" placeholder="Enter Answer" required>
        <button type="submit" name="add">Add FAQ</button>
    </form>

    <h3>Existing FAQs:</h3>
    <table border="1" cellpadding="8">
        <tr>
            <th>Question</th><th>Answer</th><th>Action</th>
        </tr>
        <?php
        $res = mysqli_query($conn, "SELECT * FROM faqs");
        while ($row = mysqli_fetch_assoc($res)) {
            echo "<tr>
                <td>{$row['question']}</td>
                <td>{$row['answer']}</td>
                <td><a href='?delete={$row['id']}' onclick='return confirm(\"Delete this FAQ?\")'>Delete</a></td>
        </tr>";
        }
        ?>
    </table>
</body>
</html>
