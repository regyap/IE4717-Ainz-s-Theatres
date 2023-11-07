<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/seatSelection.css" />
  </head>
  <script>
    var selectedSeats = '';

    function selectSeat(){
      let checkboxes = document.querySelectorAll('input[name="seatInput"]:checked');
            let values = [];
            checkboxes.forEach((checkbox) => {
                values.push(checkbox.value);
            });
            document.getElementById("form_selectedSeats").value = values;
            document.getElementById("form_numberOfSeats").value = values.length;
            document.getElementById("selectedSeatNumbers").innerHTML = values;
            console.log(document.getElementById("form_selectedSeats").value);
            console.log(document.getElementById("form_numberOfSeats").value);
    }  

    function checkValid(){
      var number = document.getElementById("form_numberOfSeats").value;
      if(number<=0 || number==null){
        alert('Please select at least 1 seat before proceeding');
      }
    }
  </script>

  <?php

      $screeningId = intval($_GET['screeningId']);

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
      <div class="bookingDetails">
        <div class="location"><img src="image/location.png"><span><?php echo $locationName ?></span></div>
        <div class="movie"><?php echo $movieTitle ?> <span class="discretion"><?php echo $viewerDiscretion ?></span></div>
        <div class="date"><?php echo $dayName ?>, <?php echo $day ?> <?php echo $monthName ?></div>
        <div class="time"><?php echo $hour ?>:<?php echo $minute ?></div>
      </div>
      <div class="title">Select Seats</div>
      <div class="seatsSection">
        <div class="exit"></div>
        <ol class="cabin fuselage">
          <li class="row row--G">
            <ol class="seats" type="A">
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G1" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox"  name="seatInput" value="G2" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G3" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G4" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G5" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G6" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G7" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G8" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G9" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G10" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G11" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G12" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G13" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G14" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G15" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" name="seatInput" value="G16" onclick="selectSeat();"/>
              </li>
            </ol>
          </li>
          <li class="row row--F">
            <ol class="seats" type="A">
              <li class="seat">
                <input type="checkbox" value="F1" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F2" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F3" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F4" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F5" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F6" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F7" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F8" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F9" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F10" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F11" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F12" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F13" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F14" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F15" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="F16" name="seatInput" onclick="selectSeat();"/>
              </li>
            </ol>
          </li>
          <li class="row row--E">
            <ol class="seats" type="A">
              <li class="seat">
                <input type="checkbox" value="E1" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E2" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E3" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E4" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E5" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E6" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E7" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E8" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E9" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E10" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E11" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E12" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E13" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E14" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E15" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="E16" name="seatInput" onclick="selectSeat();"/>
              </li>
            </ol>
          </li>
          <li class="row row--D">
            <ol class="seats" type="A">
              <li class="seat">
                <input type="checkbox" value="D1" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D2" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D3" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D4" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D5" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D6" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D7" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D8" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D9" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D10" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D11" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D12" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D13" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D14" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D15" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="D16" name="seatInput" onclick="selectSeat();"/>
              </li>
            </ol>
          </li>
          <li class="row row--C">
            <ol class="seats" type="A">
              <li class="seat">
                <input type="checkbox" value="C1" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C2" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C3" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C4" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C5" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C6" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C7" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C8" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C9" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C10" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="11" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C12" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C13" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C14" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C15" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="C16" name="seatInput" onclick="selectSeat();"/>
              </li>
            </ol>
          </li>
          <li class="row row--B">
            <ol class="seats" type="A">
              <li class="seat">
                <input type="checkbox" value="B1" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B2" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B3" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B4" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B5" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B6" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B7" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B8" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B9" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B10" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B11" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B12" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B13" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B14" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B15" name="seatInput" onclick="selectSeat();"/>
              </li>
              <li class="seat">
                <input type="checkbox" value="B16" name="seatInput" onclick="selectSeat();"/>
              </li>
            </ol>
          </li>
          <li class="row row--A">
            <ol class="seats" type="A">
              <li class="seat">
                <input type="checkbox" value="A1" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A2" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A3" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A4" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A5" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A6" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A7" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A8" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A9" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A10" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A11" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A12" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A13" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A14" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A15" name="seatInput" disabled/>
              </li>
              <li class="seat">
                <input type="checkbox" value="A16" name="seatInput" disabled/>
              </li>
            </ol>
          </li>
        </ol>
        <div class="screen">screen</div>
        <div class="exit"></div>
      </div>
      
      <div class="legend">
        <div>
          <div class="box1"></div><span>Available</span>
        </div>
        <div>
          <div class="box2"></div><span>Not available</span>
        </div>
        <div>
          <div class="box3"></div><span>Selected</span>
        </div>
      </div>
      <div class="selectedSeatsText">
        <span>Seats selected:</span><br />
        <span id="selectedSeatNumbers"></span>
      </div>
      <form method="post" action="paymentDetails.php" onsubmit="return checkValid()">
        <input name="form_numberOfSeats" id="form_numberOfSeats" type="number" value="0" hidden>
        <input name="form_selectedSeats" id="form_selectedSeats" type="text" value="" hidden>
        <input name="form_screeningId" type="number" value="<?php echo $screeningId ?>" hidden>
        <div class="proceedBtn">
          <input type="submit" value="Proceed to payment">
        </div>
      </form>
    </div>
  </body>
</html>
