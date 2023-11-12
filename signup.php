<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/signup.css" />
</head>
<script src="js/global.js"></script>
<script>
        function validateEmail() {
        
        }
        function signup_validate()
        {
            var pw = document.getElementById('pass');
            var cfpw = document.getElementById('confirmpass');

            if(pw.value != cfpw.value)
            {
                alert("Passwords do not match. Please re-enter");
                document.getElementById('pass').value = "";
                document.getElementById('confirmpass') = "";
                return false;
            }else{
              var emailInput = document.getElementById("email").value;
              var pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

              if (!pattern.test(emailInput)) {
                document.getElementById('email').value = "";
                alert("Email is invalid. Please re-enter");
              }else{
                var r = /^[6,8-9]{1}[0-9]{7}$/;
                var contact = document.getElementById("contact").value;
                if(r.test(contact)) {
                  return true;
                }
                else{
                  document.getElementById('contact').value = "";
                  alert("Please enter a valid contact number (8 digits and starts with 6/8/9)");
                  return false;
                }
              }
            }
        }

</script>

<?php

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
            <button onclick="myFunction()" class="dropbtn"><img src="image/login.png" id="dropbtnimg">
                <p>Hello,
                    <?php echo $username?>
                </p>
            </button>
            <div id="myDropdown" class="dropdown-content">

                <a href="purchaseHistory.php">Purchase History</a>
                <form action="php/signin_process.php" method="post" id="signout" name="signout">
                    <a href="#" onclick="document.getElementById('signout').submit();">Log out</a>
                </form>
            </div>
        </div>


        <?php  }}else{ ?>
        <a href="login.php" class="user" id="login"><img src="image/login.png">
            <p>Login</p>
        </a>
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

    <section class="boxbg">
        <div class="box">
            <h1>Welcome to <br>AINZ'S THEATRES</h1>
            <p>Don't have an account?
                Create an account here or <a href="login.php">log in</a></p>
            <h3>Create account here</h3><br>
            <form action="php/insertUser.php" method="post" onsubmit="return signup_validate();">

                <?php 
                if(isset($_GET['status'])){
                  if($_GET['status']=='fail'){
                    $errorMessage = "Email is already registered.";
                  }
                ?>
                <div style="color: red; font-family: Montserrat; margin-bottom:16px;"><?php echo $errorMessage ?></div>
                <?php
                }
                ?>
                <div>
                    <input type="text" name="email" pattern=".{3,}" required autofocus id="email">
                    <label> Email: </label>
                </div>
                <div>
                    <input type="text" name="name" pattern=".{3,}" required autofocus id="name">
                    <label> Name: </label>
                  
                </div>
                <div>  <input type="text" name="contact" pattern=".{3,}" required autofocus  id="contact">
                    <label> Contact Number: </label>
                 
                </div>
                <div>
                    <input type="password" id="pass" name="pass" pattern=".{3,}" required autofocus>
                    <label> Enter Password: </label>
                </div>
                <div>
                    <input type="password" id="confirmpass" name="confirmpass" pattern=".{3,}" required autofocus>
                    <label> Confirm Password: </label>
                </div>


                <input type="submit" value="register">
            </form><br>
        
        </div>


    </section>

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