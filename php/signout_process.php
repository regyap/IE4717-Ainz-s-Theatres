<?php
 session_start();

$conn = mysqli_connect("localhost", "root", "", "IE4717_ainzs_theatres");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signout'])) {
   
   
    if (isset($_SESSION['login'])) {
        unset($_SESSION['login']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['contact']);
        session_destroy();
        session_unset();
        header("Location: ../index.php");
        exit();
    }
    else{
        header("Location: ../index.php");
        exit();
    }
}
else {
    if (isset($_SESSION['login'])) {
        unset($_SESSION['login']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        unset($_SESSION['contact']);
        session_unset();
        header("Location: ../index.php");
        exit();
    }
}
?>