<?php
include 'db/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = strtolower(trim($_POST['msg']));

    $sql = "SELECT answer FROM faqs WHERE LOWER(question) LIKE '%$input%'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        echo $row['answer'];
    } else {
        echo "Sorry, I don't have an answer for that yet.";
    }
}
?>
