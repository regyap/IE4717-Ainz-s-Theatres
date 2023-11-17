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

            $sql_find_user ="select id, name, email from user where id = ? limit 1";
            $stmt2 = $conn->prepare($sql_find_user);
            $stmt2->bind_param('i', $userId);
            // Bind the results to variables
            $stmt2->execute();
            $stmt2->store_result();  // The error is still occurring because you are trying to execute another query ($locationList = $conn->query($sql_select_location);) while there are pending results from the previous query executed with a prepared statement ($stmt2->execute();).

             // Bind the result to variables
            $stmt2->bind_result($resultUserId, $resultName, $resultEmail); /* Add other columns as needed */


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
                
                    // Base64 encode the image
            $qrCodeImage = 'https://assets.publishing.service.gov.uk/media/5f5f601ee90e076cdbd9226b/QR_code_image.jpg';
            $base64QrCode = base64_encode(file_get_contents($qrCodeImage));
            $qrCodeSrc = $qrCodeImage;

            // Email message
            $message = "Dear $resultName,<br><br>";
            $message .= "Thank you for choosing Ainz Theatres for your movie experience!<br>";
            $message .= "We are pleased to confirm your recent ticket purchase. Below are the details of your transaction:<br><br>";
            $message .= "Movie: $movieTitle<br>";
            $message .= "Date and Time: $screenTime<br>";
            $message .= "Location: $locationName<br>";
            $message .= "Number of Seats: $numberOfSeats<br>";
            $message .= "Seat Numbers: $seatNumbers<br>";
            $message .= "Total Amount Paid: $$totalAmount<br><br><br>";
            $message .= "<img src='$qrCodeSrc' alt='Ainz Theatres QR Code' width='300'>";
            $message .= "<br><br>We look forward to welcoming you to Ainz Theatres. If you have any questions or need further assistance, feel free to contact us.<br><br>";
            $message .= "Best regards,<br>";
            $message .= "Ainz Theatres Team";

            // Additional headers
            $headers = 'From: Ainz Theatres <your-email@example.com>' . "\r\n";
            $headers .= 'Reply-To: your-email@example.com' . "\r\n";
            $headers .= 'Content-Type: text/HTML; charset=UTF-8';
                
                // Send the email
                mail($to, $subject, $message, $headers);
                
            }
            $stmt2->close();

          

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

                $to      = $email   ;
                $subject = "Ainz Theatres - Ticket Purchase Confirmation";
                
             // Base64 encode the image
             $qrCodeImage = 'https://assets.publishing.service.gov.uk/media/5f5f601ee90e076cdbd9226b/QR_code_image.jpg';
             $base64QrCode = base64_encode(file_get_contents($qrCodeImage));
             $qrCodeSrc = $qrCodeImage;
 
             // Email message
             $message = "Dear Anon,<br><br>";
             $message .= "Thank you for choosing Ainz Theatres for your movie experience!<br>";
             $message .= "We are pleased to confirm your recent ticket purchase. Below are the details of your transaction:<br><br>";
             $message .= "Movie: $movieTitle<br>";
             $message .= "Date and Time: $screenTime<br>";
             $message .= "Location: $locationName<br>";
             $message .= "Number of Seats: $numberOfSeats<br>";
             $message .= "Seat Numbers: $seatNumbers<br>";
             $message .= "Total Amount Paid: $$totalAmount<br><br><br>";
             $message .= "<img src='$qrCodeSrc' alt='Ainz Theatres QR Code' width='300'>";
             $message .= "<br><br>We look forward to welcoming you to Ainz Theatres. If you have any questions or need further assistance, feel free to contact us.<br><br>";
             $message .= "Best regards,<br>";
             $message .= "Ainz Theatres Team";
 
             // Additional headers
             $headers = 'From: Ainz Theatres <your-email@example.com>' . "\r\n";
             $headers .= 'Reply-To: your-email@example.com' . "\r\n";
             $headers .= 'Content-Type: text/HTML; charset=UTF-8';
                
                // Send the email
                mail($to, $subject, $message, $headers);
            }
            
        }

        $result1 = $stmt1->execute();
        $stmt1->close();
    
    }

     $conn->close();
     header("Location:../success.php");

?>