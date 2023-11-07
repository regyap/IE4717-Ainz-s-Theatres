<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/paymentDetails.css" />
  </head>
  <script>
    
  </script>
  <?php

      $numberOfSeats = $_POST['form_numberOfSeats'];
      $selectedSeats = $_POST['form_selectedSeats'];
      $screeningId = $_POST['form_screeningId'];

      $ticketsAmount = number_format($numberOfSeats*23, 2);
      $bookingFees = number_format(3, 2);
      $grandTotal = number_format($ticketsAmount+$bookingFees, 2);

      $conn=mysqli_connect("localhost","root","" ,"IE4717_ainzs_theatres");
      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      $sql_select="SELECT S.id, DAYNAME(S.timing) as dayName, DAY(S.timing) as day, MONTHNAME(S.timing) as monthName, HOUR(S.timing) as hour, MINUTE(S.timing) as minute, M.title as movieTitle, M.viewerDiscretion, L.name AS locationName FROM screening AS S JOIN movie AS M ON S.movieId = M.id JOIN location AS L ON S.locationId = L.id WHERE S.id = ".$screeningId;
      $selectionDetails = $conn->query($sql_select);
      $row = $selectionDetails->fetch_assoc();
      $id = $row['id'];
      $dayName = strtoupper(substr($row['dayName'], 0, 3));
      $day = $row['day'];
      $monthName = strtoupper(substr($row['monthName'], 0, 3));
      $hour = $row['hour'];
      $minute = $row['minute'];
      $movieTitle = $row['movieTitle'];
      $viewerDiscretion = $row['viewerDiscretion'];
      $locationName = $row['locationName'];

?>
  <body>
  <nav class="navbar">
    <?php
      session_start();
      if(isset($_SESSION['login'])=="IsIn"){
        if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        
    ?>
    
    <div class="dropdown">
    <button onclick="myFunction()" class="dropbtn"><img src="image/login.png" id="dropbtnimg"><p>Hello, <?php echo $username?></p></button>
      <div id="myDropdown" class="dropdown-content">
      
        <a href="purchaseHistory.php">Purchase History</a>
        <form action="php/signin_process.php" method="post" id="signout" name="signout">
        <a href="#" onclick="document.getElementById('signout').submit();">Log out</a>
        </form>
      </div>
  </div>

   
    <?php  }}else{ ?>
      <a href="login.php" class="user" id="login"><img src="image/login.png" ><p>Login</p></a>
  <?php }?>
  
  
    <br>
    <a href="index.php#nowShowingSection" class="navlinks">NOW SHOWING</a>
    <a href="index.php#nowShowingSection" class="navlinks">COMING SOON</a>
    <a href="index.php" id="logo"><img src="image/Asset 1@4x.png"></a>
    <a href="locations.php" class="navlinks">LOCATION</a>
    <a href="index.php#aboutuscontent" class="navlinks">ABOUT US</a>
    <br>
    <input type="submit" value="FAST BOOKING" class="lol" onclick="openFastBooking();">
  </nav>

    <div id="content">
      <div id="paymentSlip">
        <form action="php/purchaseTickets.php" method="post" onsubmit="">
        <section id="section1">
          <div class="title">Payment Details</div>
          <table class="amountInfo">
            <tr class="row1">
              <td class="col1">
                <img src="image/oppenheimer.webp" />
              </td>
              <td class="col2">
                <div class="movie">
                  <div id="discretion"><?php echo $viewerDiscretion ?></div>
                  <div id="movieTitle"><?php echo $movieTitle ?></div>
                </div>
                <div class="location"><?php echo $locationName ?></div>
                <div class="date"><?php echo $dayName ?>, <?php echo $day ?> <?php echo $monthName ?></div>
                <div class="time"><?php echo $hour ?>:<?php echo $minute ?></div>
              </td>
              <td class="col3"></td>
            </tr>
            <tr>
              <td class="horizontalLine" colspan="3">
                <hr class="tableSeparations" color="#5A5A5A" />
              </td>
            </tr>
            <tr class="amtLabelRow">
              <td colspan="2"></td>
              <td>
                <div class="amtLBL">AMOUNT</div>
              </td>
            </tr>
            <tr class="row2">
              <td class="col1">Seat(s)</td>
              <td class="col2">
                <div><?php echo $numberOfSeats ?> X Adult($23.00) Tickets</div>
                <br />
                <div><?php echo $selectedSeats ?></div>
              </td>
              <td class="col3">
                <!-- <div class="amtLBL">AMOUNT</div><br /> -->
                <div>$<?php echo $ticketsAmount ?></div>
              </td>
            </tr>
            <tr>
              <td class="horizontalLine" colspan="3">
                <hr class="tableSeparations" color="#5A5A5A" />
              </td>
            </tr>
            <tr class="amtLabelRow">
              <td colspan="2"></td>
              <td>
                <div class="amtLBL">AMOUNT</div>
              </td>
            </tr>
            <tr class="row3">
              <td class="col1">
                <div>Booking Fees:</div>
                <br />
                <div>Grand Total:</div>
              </td>
              <td class="col2"></td>
              <td class="col3">
                <!-- <div class="amtLBL">AMOUNT</div><br /> -->
                <div>$<?php echo $bookingFees ?></div>
                <br />
                <div>$<?php echo $grandTotal ?></div>
              </td>
            </tr>
          </table>
        </section>
        <hr class="middleLine" color="#fbcc97" />
        <section id="section2">
          <table class="userPaymentDetails">
            <tr>
              <td class="label" rowspan="3">Contact Information:</td>
              <td class="subLabel">Name</td>
              <td class="textbox"><input name="form_name" type="text" required/></td>
            </tr>
            <tr>
              <td class="subLabel">Email</td>
              <td class="textbox"><input name="form_email" type="email" required/></td>
            </tr>
            <tr>
              <td class="subLabel">Contact Number</td>
              <td class="textbox"><input name="form_contact" type="number" required/></td>
            </tr>
            <tr>
              <td class="label">Choose Your Payment Method:</td>
              <td class="label"></td>
              <td>
                <input
                  type="radio"
                  id="dbs"
                  name="form_paymentMethod"
                  value="DBS"
                  required
                />
                <label for="dbs">DBS</label>
                <input
                  type="radio"
                  id="uob"
                  name="form_paymentMethod"
                  value="UOB"
                  required
                />
                <label for="uob">UOB</label><br />
              </td>
            </tr>
          </table>
        </section>
        <input name="form_screeningId" type="number" value="<?php echo $screeningId ?>" hidden>
        <input name="form_numberOfSeats" type="number" value="<?php echo $numberOfSeats ?>" hidden>
        <input name="form_selectedSeats" type="text" value="<?php echo $selectedSeats ?>" hidden>
        <input name="form_grandTotal" type="text" value="<?php echo $grandTotal ?>" hidden>
        <section id="section3">
          <div class="buttonsContainer">
            <button class="button">BACK</button>
          <input class="button" type="submit" value="PAY">
          </div>
        </section>
        </form>
      </div>
    </div>
  </body>
</html>
