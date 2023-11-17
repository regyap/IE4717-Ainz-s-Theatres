<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

 $conn=mysqli_connect("localhost","root","" ,"IE4717_ainzs_theatres");
 // Check connection
     if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
        echo "Connnection Fail";
     }
     else{
        echo "<script>alert('DB CONNECTED')</script>";
     }

    if(isset($_POST['email'])){

        $email = $_POST['email'];
        $sql_select = "SELECT COUNT(*) FROM user WHERE email = '" . $email. "'";
        $duplicateUsers = $conn->query($sql_select);
        $row = $duplicateUsers->fetch_assoc();
        if($row["COUNT(*)"]>0){
            session_start();
            $conn->close();
            header("Location:../signup.php?status=fail");
        }else{
            $name = $_POST['name'];
            $password = $_POST['pass'];
            $contact = $_POST['contact'];

            $sql_insert="INSERT INTO user (email, name, password, contact) VALUES (?,?,?,?)";
            $stmt1 = $conn->prepare($sql_insert);
            $stmt1->bind_param('sssi', $email, $name, $password, $contact);
            
            $result1 = $stmt1->execute();
            $stmt1->close();

            $conn->close();
            header("Location:../login.php");
        }

     }

?>