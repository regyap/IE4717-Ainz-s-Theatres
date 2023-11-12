<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/seatSelection.css" />
  </head>
  <script src="js/global.js"></script>
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
  <script src="js/global.js"></script>

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

      //  FAST BOOKING -------------------------------
      if(isset($_GET['fb_movie'])){
        $fb_movie = intval($_GET['fb_movie']);
        }
        if(isset($_GET['fb_location'])){
        $fb_location = intval($_GET['fb_location']);
        }

        $sql_select="SELECT id, title FROM movie where releaseDate<=DATE_ADD(CURDATE(), INTERVAL -7 DAY)";

        $fb_movieList = $conn->query($sql_select);
        $fb_locationList = null;
        $fb_screeningList = null;

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
