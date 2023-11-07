<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "IE4717_ainzs_theatres");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $email = $_POST["emailforsignin"];
    $password = $_POST["passwordforsignin"];

    // prepared statements to prevent SQL injection
    $sqlquery = "SELECT * FROM user WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($sqlquery);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >= 1) {
        $_SESSION['login'] = 'IsIn';

        while ($row = mysqli_fetch_assoc($result)) {
            // Access the 'username' column
            $username = $row['username'];
            $_SESSION['username'] = $username;

            $email = $row['email'];
            $_SESSION['email'] = $email;

            $contact = $row['contact'];
            $_SESSION['contact'] = $contact;

        }

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