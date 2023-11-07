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
        // echo "<script>alert('DB CONNECTED')</script>";
     }

     if(isset($_POST['form_grandTotal']) && $_POST['form_grandTotal']>0){
        $screeningId = $_POST['form_screeningId'];
        $email = $_POST['form_email'];
        $contact = $_POST['form_contact'];
        $seatNumbers = $_POST['form_selectedSeats'];
        $numberOfSeats = $_POST['form_numberOfSeats'];
        $totalAmount = $_POST['form_grandTotal'];
        $paymentMethod = $_POST['form_paymentMethod'];
        $userId = $_POST['form_userId'];
        $status = 'success';

        if($userId != null){
            $sql_insert="INSERT INTO payment (screeningId, email, contact, seatNumbers, numberOfSeats, totalAmount, paymentMethod, userId, status) VALUES (?,?,?,?,?,?,?,?,?)";
            $stmt1 = $conn->prepare($sql_insert);
            $stmt1->bind_param('isisidsis', $screeningId, $email, $contact, $seatNumbers, $numberOfSeats, $totalAmount, $paymentMethod, $userId, $status);
        }else{
            $sql_insert="INSERT INTO payment (screeningId, email, contact, seatNumbers, numberOfSeats, totalAmount, paymentMethod, status) VALUES (?,?,?,?,?,?,?,?)";
            $stmt1 = $conn->prepare($sql_insert);
            $stmt1->bind_param('isisidss', $screeningId, $email, $contact, $seatNumbers, $numberOfSeats, $totalAmount, $paymentMethod, $status);
        }

        $result1 = $stmt1->execute();
        $stmt1->close();

        // the message
        $msg = "Your movie ticket purchase is successful\n use this QR code for entry to theatre:";

        // use wordwrap() if lines are longer than 70 characters
        $msg = wordwrap($msg,70);

        // send email
        mail($email,"Ainzs Theatres Payment Confirmation",$msg);
     }


     $conn->close();
     header("Location:../success.html");

?>