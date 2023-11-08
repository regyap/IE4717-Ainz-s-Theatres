<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/purchaseHistory.css" />
  </head>
  <script src="js/global.js"></script>
  <?php
    session_start();
    if(isset($_SESSION["login"])){
      if($_SESSION["login"]=='IsIn'){
        $userId = $_SESSION["userId"];
      }
    }

  $conn=mysqli_connect("localhost","root","" ,"IE4717_ainzs_theatres");
// Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if(isset($userId)){
    $sql_select="SELECT M.title as movieTitle, 
                M.image,
                L.name as locationName, 
                P.seatNumbers, 
                DAYNAME(S.timing) as dayName, 
                DAY(S.timing) as day, 
                MONTHNAME(S.timing) as monthName, 
                HOUR(S.timing) as hour, 
                MINUTE(S.timing) as minute, 
                P.timeOfPayment,
                P.totalAmount
                FROM payment as P 
                JOIN screening as S ON P.screeningId=S.id 
                JOIN movie as M ON M.id=S.movieId
                JOIN location as L ON L.id=S.locationId
                where userId=".$userId;
      $paymentRecords = $conn->query($sql_select);
  }
  
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
      <a href="login.html" class="user"
        ><img src="image/login.png" />Hello, Ainz</a
      >
      <br />
      <a href="#" class="navlinks">NOW SHOWING</a>
      <a href="#" class="navlinks">COMING SOON</a>
      <a href="index.php" id="logo"><img src="image/Asset 1@4x.png" /></a>
      <a href="locations.php" class="navlinks">LOCATION</a>
      <a href="#" class="navlinks">ABOUT US</a>
      <br />
      <input type="submit" value="FAST BOOKING" class="lol" />
    </nav>

    <div id="content">
      <div id="slip">
        <div class="content">
            <div class="title">
                Purchase History
            </div>
            <hr color="#fbcc97">
            <div class="scrollView">
            <?php
              while($row = $paymentRecords->fetch_assoc()){
            ?>
                <div class="historyRecord">
                    <img src="image/<?php echo $row['image']?>">
                    <div class="textContent">
                        <div class="col1">
                            <span>
                              <?php echo $row['movieTitle']?>
                            </span>
                            <span>
                              <?php echo $row['locationName']?>
                            </span>
                            <span>
                              <?php echo $row['seatNumbers']?>
                            </span>
                            <span>
                              <?php echo strtoupper(substr($row['dayName'], 0, 3)) ?>  |  <?php echo $row["day"] ?> <?php echo strtoupper(substr($row['monthName'], 0, 3)) ?>  |  <?php echo $row["hour"] ?>:<?php echo $row["minute"] ?>
                            </span>
                        </div>
                        <div class="col2">
                            <span>
                              paid on <?php echo $row['timeOfPayment']?>
                            </span>
                            <span class="amountPaid">
                              $<?php echo number_format($row['totalAmount'],2)?>
                            </span>
                        </div>
                    </div>
                </div>
          <?php
            }
          ?>
            </div>
        </div>
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
