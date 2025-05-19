<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'student') {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard – EduQuery</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['user']['username']; ?> 👋</h2>
    <a href="logout.php">Logout</a>

    <div class="chat-container">
        <h3>Ask me anything about campus!</h3>
        <div id="chat-box"></div>
        <input type="text" id="user-input" placeholder="Type your question...">
        <button onclick="sendMessage()">Send</button>
    </div>

    <script src="assets/js/chatbot.js"></script>
</body>
</html>
