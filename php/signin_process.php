<?php


$conn = mysqli_connect("localhost", "root", "", "IE4717_ainzs_theatres");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $email = $_POST["emailforsignin"];
    $password = $_POST["passwordforsignin"];

    // prepared statements to prevent SQL injection
    $sqlquery = "SELECT * FROM user WHERE email = ? AND password = ? limit 1";
    $stmt = $conn->prepare($sqlquery);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        session_start();

        while ($row = mysqli_fetch_assoc($result)) {
            
            $_SESSION['login']='IsIn';

            $userId = $row['id'];
            $_SESSION['userId'] = $userId;

            $username = $row['name'];
            $_SESSION['username'] = $username;

            $email = $row['email'];
            $_SESSION['email'] = $email;

            $contact = $row['contact'];
            $_SESSION['contact'] = $contact;

        }

        // Redirect
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['login'] = false;
        header("Location: ../login.php?status=fail");
        exit();
    }
}elseif(isset($_POST['signout'])){
    session_start();
    session_destroy();
    session_unset();
    header('Location: ../index.php');
    exit();
}
else {
    session_start();
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