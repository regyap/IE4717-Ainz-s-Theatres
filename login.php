    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Ainz's Theatres</title>
        <meta charset="utf-8" / >
        <link rel="stylesheet" href="css/global.css" />
        <link rel="stylesheet" href="css/login.css" />
    </head>
    <script src="js/global.js"></script>
    <script>
        function validateEmail() {
        const emailInput = document.getElementById("emailInput").value;
        console.log(emailInput)
        const resultMessage = document.getElementById("resultMessage");
        const pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+$/;
        console.log("Pattern test result:", pattern.test(emailInput));

        if (pattern.test(emailInput)) {
            console.log("Email is valid")
            resultMessage.innerHTML = "Email is valid";
        } else {
            resultMessage.innerHTML = "Email is not valid";
        }
        }
       
    function validateForm() {
        if (validateEmail()) {
            return true; // Proceed with form submission
        } else {
            // Set a parameter indicating the failure status
            window.location.href = "login.php?login=fail";
            return false; // Prevent form submission
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
  
          $sql_select="SELECT * FROM movie where (releaseDate<=DATE_ADD(CURDATE(), INTERVAL 7 DAY)) AND (releaseDate>=DATE_ADD(CURDATE(), INTERVAL -30 DAY))";
          
          $fb_movieList = $conn->query($sql_select);
          $fb_locationList = null;
          $fb_screeningList = null;
  
          if(isset($_GET['fb_movie'])&&isset($_GET['fb_movie'])){
          if($fb_movie!=0 && $fb_location==0){
            $sql_select="SELECT DISTINCT L.* FROM location as L JOIN screening as S ON L.id=S.locationId where S.movieId=".$fb_movie." AND S.timing<DATE_ADD(CURDATE(), INTERVAL 7 DAY) AND (S.timing>CURDATE())";
            $fb_locationList = $conn->query($sql_select);
          }else if($fb_movie!=0 && $fb_location!=0){
            $sql_select="SELECT DISTINCT L.* FROM location as L JOIN screening as S ON L.id=S.locationId where S.movieId=".$fb_movie." AND S.timing<DATE_ADD(CURDATE(), INTERVAL 7 DAY) AND (S.timing>CURDATE())";
            $fb_locationList = $conn->query($sql_select);
            $sql_select="SELECT DISTINCT id, DAYNAME(timing) as dayName, DAY(timing) as day, MONTHNAME(timing) as monthName, HOUR(timing) as hour, MINUTE(timing) as minute FROM screening where movieId=".$fb_movie." AND locationId=".$fb_location." AND timing<DATE_ADD(CURDATE(), INTERVAL 7 DAY) AND (timing>CURDATE())";
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
        <section class="boxbg">
            <div class="box">
                <div id="profileimg"><img src="image/login.png"></div> <br>
                <h2>Sign In</h2>

                <form action="php/signin_process.php" method="post">


                    <div>
                        <input type="text" name="emailforsignin" pattern=".{3,}" required autofocus oninput="validateEmail()" id="emailInput">
                        <label>Enter Email: </label>
                    </div>
                    <div>
                        <input type="password" name="passwordforsignin" pattern=".{3,}" required autofocus>
                        <label> Enter Password: </label>
                    </div>

                    <div id="resultMessage"></div>

                         <?php 
                        if (isset($_GET['status']))
                        {
                            if ($_GET['status']=='fail')
                                echo "Invalid email or password,try again";
                        }
                        ?>
                    <input type="submit" name="submit" value="login" onsubmit="return validateEmail();">
                </form><br>
                <p>
                    Don't have an account? <br />
                    Create one
                    <a href="signup.php">here</a>
                </p>

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