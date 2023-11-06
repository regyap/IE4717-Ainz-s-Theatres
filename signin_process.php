<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "IE4717_ainzs_theatres");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $username = $_POST["usernameforsignin"];
    $password = $_POST["passwordforsignin"];

    // prepared statements to prevent SQL injection
    $sqlquery = "SELECT * FROM user WHERE name = ? AND password = ?";
    $stmt = $conn->prepare($sqlquery);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >= 1) {
        $_SESSION['login'] = 'IsIn';
        $_SESSION['username'] = $username;

        // Redirect
        header('location: index.php');
        exit();
    } else {
        $_SESSION['login'] = false;
        header("Location: login.php?status=fail");
        exit();
    }
} else {
    if (isset($_SESSION['login'])) {
        unset($_SESSION['login']);
        unset($_SESSION['username']);
        header('location: index.php');
        exit();
    }
}
?>