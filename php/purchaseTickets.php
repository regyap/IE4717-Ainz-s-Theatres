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

            $sql_find_user ="select * from user where id = ? limit 1";
            $stmt2 = $conn->prepare($sql_find_user);
            $stmt2->bind_param('i', $userId);
            // Bind the results to variables
            $stmt2->execute();
            $stmt2->store_result();  // The error is still occurring because you are trying to execute another query ($locationList = $conn->query($sql_select_location);) while there are pending results from the previous query executed with a prepared statement ($stmt2->execute();).

            $sql_select_location="SELECT distinct(movie.title) as title, screening.timing as screentime, location.name as locationName
            from screening
            LEFT JOIN movie ON movie.id = screening.movieId 
            LEFT JOIN location ON location.id = screening.locationId 
            WHERE screening.id = ".$screeningId." limit 1;";
            $locationList = $conn->query($sql_select_location);
            $row = $locationList->fetch_assoc(); // Fetch a row from the result set

            // Fetch the result
            if ($stmt2->fetch() && ($locationList->num_rows > 0) && $row) {
                
                $movieTitle = $row['title'];
                $screenTime = $row['screentime'];
                $locationName = $row['locationName'];
            
                $to = $email;
                $subject = "Ainz Theatres - Ticket Purchase Confirmation";
                
                // Email message
                $message = "Dear $resultName,\r\n\r\n";
                $message .= "Thank you for choosing Ainz Theatres for your movie experience!\r\n";
                $message .= "We are pleased to confirm your recent ticket purchase. Below are the details of your transaction:\r\n\r\n";
                $message .= "Movie: $movieTitle\r\n"; // Replace with the actual movie title
                $message .= "Date and Time: $screenTime\r\n"; // Replace with the actual screening date and time
                $message .= "Location: $locationName\r\n";
                $message .= "Number of Seats: $numberOfSeats\r\n";
                $message .= "Seat Numbers: $seatNumbers\r\n";
                $message .= "Total Amount Paid: $$totalAmount\r\n\r\n";
                $message .= "We look forward to welcoming you to Ainz Theatres. If you have any questions or need further assistance, feel free to contact us.\r\n\r\n";
                $message .= "Best regards,\r\n";
                $message .= "Ainz Theatres Team";
                
                // Additional headers
                $headers = 'From: Ainz Theatres <your-email@example.com>' . "\r\n";
                $headers .= 'Reply-To: your-email@example.com' . "\r\n";
                $headers .= 'Content-Type: text/plain; charset=UTF-8';
                
                // Send the email
                mail($to, $subject, $message, $headers);
                
            }

          

        }else{
            $sql_insert="INSERT INTO payment (screeningId, email, contact, seatNumbers, numberOfSeats, totalAmount, paymentMethod, status) VALUES (?,?,?,?,?,?,?,?)";
            $stmt1 = $conn->prepare($sql_insert);
            $stmt1->bind_param('isisidss', $screeningId, $email, $contact, $seatNumbers, $numberOfSeats, $totalAmount, $paymentMethod, $status);


            $sql_select_location="SELECT distinct(movie.title) as title, screening.timing as screentime, location.name as locationName
            from screening
            LEFT JOIN movie ON movie.id = screening.movieId 
            LEFT JOIN location ON location.id = screening.locationId 
            WHERE screening.id = ".$screeningId." limit 1;";
            $locationList = $conn->query($sql_select_location);
         
            if ( $locationList->num_rows > 0) {
                $row = $locationList->fetch_assoc(); // Fetch a row from the result set
                $movieTitle = $row['title'];
                $screenTime = $row['screentime'];
                $locationName = $row['locationName'];

                $to      = 'f32ee@localhost';
                $subject = "Ainz Theatres - Ticket Purchase Confirmation";
                
                // Email message
                $message = "Dear Anon,\r\n\r\n";
                $message .= "Thank you for choosing Ainz Theatres for your movie experience!\r\n";
                $message .= "We are pleased to confirm your recent ticket purchase. Below are the details of your transaction:\r\n\r\n";
                $message .= "Movie: $movieTitle\r\n"; // Replace with the actual movie title
                $message .= "Date and Time: $screenTime\r\n"; // Replace with the actual screening date and time
                $message .= "Location: $locationName\r\n";
                $message .= "Number of Seats: $numberOfSeats\r\n";
                $message .= "Seat Numbers: $seatNumbers\r\n";
                $message .= "Total Amount Paid: $$totalAmount\r\n\r\n";
                $message .= "We look forward to welcoming you to Ainz Theatres. If you have any questions or need further assistance, feel free to contact us.\r\n\r\n";
                $message .= "Best regards,\r\n";
                $message .= "Ainz Theatres Team";
                
                // Additional headers
                $headers = 'From: Ainz Theatres <your-email@example.com>' . "\r\n";
                $headers .= 'Reply-To: your-email@example.com' . "\r\n";
                $headers .= 'Content-Type: text/plain; charset=UTF-8';
                
                // Send the email
                mail($to, $subject, $message, $headers);
            }
            
        }

        $result1 = $stmt1->execute();
        $stmt1->close();
        $stmt2->close();
    }

    //     // the message
    //     $msg = "Your movie ticket purchase is successful\n use this QR code for entry to theatre:";

    //     // use wordwrap() if lines are longer than 70 characters
    //     $msg = wordwrap($msg,70);

    //     // send email
    //     mail($email,"Ainzs Theatres Payment Confirmation",$msg);
    //  }
    



     $conn->close();
     header("Location:../success.php");

?>