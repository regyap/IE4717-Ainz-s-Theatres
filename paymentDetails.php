<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/paymentDetails.css" />
  </head>
  <script>
    function validatePaymentDetails(){
      var r = /^[6,8-9]{1}[0-9]{7}$/;
      var contact = document.getElementById("form_contact").value;
      // var valid = r.test(contact);
      if(r.test(contact)) {
        return true;
      }
      else{
        alert("Please enter a valid contact number (8 digits and starts with 6/8/9)");
        return false;
      }
    }

    function goToPreviousPage(screeningId){
      location.href = 'seatSelection.php?screeningId='+screeningId;
    }
  </script>
  <script src="js/global.js"></script>
  <?php
      session_start();
      if(isset($_SESSION["login"])){
        if($_SESSION["login"]=='IsIn'){
          $userId = $_SESSION["userId"];
          $userEmail = $_SESSION["email"];
          $userName = $_SESSION["username"];
          $userContact = $_SESSION["contact"];
        }
      }

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

      //  FAST BOOKING -------------------------------
      if(isset($_GET['fb_movie'])){
        $fb_movie = intval($_GET['fb_movie']);
        }
        if(isset($_GET['fb_location'])){
        $fb_location = intval($_GET['fb_location']);
        }

        $conn=mysqli_connect("localhost","root","" ,"IE4717_ainzs_theatres");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if(isset($_GET['fb_movie'])&&isset($_GET['fb_movie'])){
        if($fb_movie!=0 && $fb_location==0){
            $sql_select="SELECT DISTINCT L.* FROM location as L JOIN screening as S ON L.id=S.locationId where S.movieId=".$fb_movie." AND S.timing>DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
            $fb_locationList = $conn->query($sql_select);
        }else if($fb_movie!=0 && $fb_location!=0){
            $sql_select="SELECT DISTINCT L.* FROM location as L JOIN screening as S ON L.id=S.locationId where S.movieId=".$fb_movie." AND S.timing>DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
            $fb_locationList = $conn->query($sql_select);
            $sql_select="SELECT DISTINCT id, DAYNAME(timing) as dayName, DAY(timing) as day, MONTHNAME(timing) as monthName, HOUR(timing) as hour, MINUTE(timing) as minute FROM screening where movieId=".$fb_movie." AND locationId=".$fb_location." AND timing>DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
            $fb_screeningList = $conn->query($sql_select);
        }
        }
        //  FAST BOOKING END -------------------------------

        $conn->close();
?>
  <body>
  <nav class="navbar">
    <?php
      // session_start();
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
        <form action="php/purchaseTickets.php" method="post" onsubmit="return validatePaymentDetails();">
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
              <td class="textbox"><input name="form_name" type="text" value="<?php if(isset($userName)){echo $userName;} ?>" required/></td>
            </tr>
            <tr>
              <td class="subLabel">Email</td>
              <td class="textbox"><input name="form_email" type="email" value="<?php if(isset($userEmail)){echo $userEmail;}  ?>" required/></td>
            </tr>
            <tr>
              <td class="subLabel">Contact Number</td>
              <td class="textbox"><input id="form_contact" name="form_contact" type="number" value="<?php if(isset($userContact)){echo $userContact;}  ?>" required/></td>
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
        <input name="form_userId" type="text" value="<?php if(isset($userId)){echo $userId;}else{echo null;} ?>" hidden>
        <section id="section3">
          <div class="buttonsContainer">
            <button class="button" onclick="goToPreviousPage(<?php echo $screeningId ?>);">BACK</button>
          <input class="button" type="submit" value="PAY">
          </div>
        </section>
        </form>
      </div>
    </div>

    <footer>
    <div class="footers">
      <div class="footersections">
        <br> <br> <br>
        <span>CONTACT</span>
        <br> <br>
        <div class="line"></div>
        <br> <br>
        <div class="contact">
          <p>ainztheatres@gmail.com</p>
          <p><b> 1234-5678-9012</b></p>
        </div>
        <br> <br> <br>
        <p class="bb">Based in Singapore.<br>Available for sale Worldwide</p>


      </div>
      <div class="footersections">
        <div class="logofooter">
          <img src="./image/Asset 1@4x.png">

          <div class="socialmedia">
            <img src="./image/instagram-symbol.png">
            <img src="./image/twitter.png">
            <img src="./image/facebook.png">
            <img src="./image/pinterest.png">
          </div>

        </div><br>

        <p>Your Best Movie Experience</p>
      </div>

      <div class="footersections">
        <br> <br> <br>
        <span>ENJOY EXCLUSIVE PERKS</span>
        <br> <br>
        <div class="line"></div>
        <br> <br>
        <form>
          <input type="text" placeholder="Enter Email"><br>
          <input type="submit" value="SIGN UP">
        </form>
        <br><br><br><br><br><br><br>
      </div>
    </div>

    <div class="footerbottom">
      <div class="footernav">
        <a href="index.php#nowShowingSection">NOW SHOWING</a>
        <a href="index.php#nowShowingSection">COMING SOON</a>
        <a href="locations.php">LOCATION</a>
        <a href="index.php#aboutuscontent">ABOUT US</a>
      </div>
      <br> <br>
      <p>© 2021 Ainz's Theatres. All Rights Reserved.</p>
  </footer>

    <!-- -----------------FAST BOOKING POPUP-------------------- -->
    <div id="fastBookingPopup" >
      <div class="FB_Card">
        <div class="FB_close" onclick="closeFastBooking();">X</div>
        <div class="FB_title">FAST BOOKING</div>
        <form class="FB_form" onsubmit="return validateFastBooking()" method="post" action="php/submitFastBooking.php">
            <select id="FB_movie" name="FB_movie" onchange="selectFastBooking();">
              <option value="0">MOVIE</option>
              <?php
              while($row = $fb_movieList->fetch_assoc()){
              ?>
              <option value="<?php echo $row["id"] ?>"><?php echo $row["title"] ?></option>
              <?php
              }
              ?>
            </select>
            <select id="FB_location" name="FB_location" onchange="selectFastBooking();" >
              <option value="0">LOCATION</option>
              <?php
              if($fb_locationList != null){
                while($row = $fb_locationList->fetch_assoc()){
              ?>
              <option value="<?php echo $row["id"] ?>"><?php echo $row["name"] ?></option>
              <?php
                }
              }else{
              ?>
              <option value="0">Please select a MOVIE first</option>
              <?php
              }
              ?>
            </select>
            <select id="FB_time" name="FB_time">
              <option value="0">TIME</option>
              <?php
              if($fb_screeningList != null){
                while($row = $fb_screeningList->fetch_assoc()){
              ?>
              <option value="<?php echo $row["id"] ?>"><?php echo strtoupper(substr($row['dayName'], 0, 3)) ?>  |  <?php echo $row["day"] ?> <?php echo strtoupper(substr($row['monthName'], 0, 3)) ?>  |  <?php echo $row["hour"] ?>:<?php echo $row["minute"] ?></option>
              <?php
                }
              }else{
              ?>
              <option value="0">Please select a MOVIE and LOCATION first</option>
              <?php
              }
              ?>
            </select>
          <input type="submit" class="FB_booknow" value="BOOK NOW">
        </form>
      </div>
    </div>
  </body>
</html>
