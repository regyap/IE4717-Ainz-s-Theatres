<!DOCTYPE html>
<html lang="en">

<head>
  <title>Ainz's Theatres</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/index.css" />
</head>
<script src="js/global.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var defaultOpenElement = document.getElementById("defaultOpen");
    if (defaultOpenElement) {
        defaultOpenElement.click();
    }

    
    var urlString = window.location.href;
    var paramString = window.location.href.split('/#')[0];
    paramString = paramString.split('?')[1];
    let urlParams = new URLSearchParams(paramString);

    // set filter previously selected values
    var movieId = urlParams.get('movie');
    var locationId = urlParams.get('location');
    if(movieId != null && locationId != null){
      document.getElementById("movieFilterSelect").value = movieId;
      document.getElementById("locationFilterSelect").value = locationId;
    }

  });

  function selectFilter(){
    var movieId = document.getElementById("movieFilterSelect").value;
    var locationId = document.getElementById("locationFilterSelect").value;
    location.href = '?movie='+movieId+'&location='+locationId+'/#nowShowingSection';
  }

  function selectMovie(index) {
      location.href = 'movieDetails.php?movieID='+index;
  }

</script>
<script src="js/global.js"></script>

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

      $sql_select="SELECT * FROM movie where (releaseDate<=DATE_ADD(CURDATE(), INTERVAL 7 DAY)) AND (releaseDate>=DATE_ADD(CURDATE(), INTERVAL -30 DAY))";
        $movieFilter = $conn->query($sql_select);

        $sql_select="SELECT id, name FROM location";
        $locations = $conn->query($sql_select);

        if(isset($_GET['movie'])&&isset($_GET['location'])){

          $movieId = intval($_GET['movie']);
          $locationId = intval($_GET['location']);

        if($movieId!=0 && $locationId==0){
          // select specific movie that is released the past month OR will be released in next 7 days
          $sql_select="SELECT * FROM movie where id=".$movieId." AND (releaseDate<=DATE_ADD(CURDATE(), INTERVAL 7 DAY)) AND (releaseDate>=DATE_ADD(CURDATE(), INTERVAL -30 DAY))";
          $nowShowing = $conn->query($sql_select);
        }else if($movieId==0 && $locationId!=0){
          // select movies that has a screening at specific location that screening timing is within today and next 7 days
          $sql_select="SELECT DISTINCT M.* FROM movie as M JOIN screening as S ON M.id=S.movieId where S.locationId=".$locationId." AND S.timing<DATE_ADD(CURDATE(), INTERVAL 7 DAY) AND (S.timing>CURDATE())";
          $nowShowing = $conn->query($sql_select);
        }else if($movieId!=0 && $locationId!=0){
          // select specific movie that has a screening at specific location that screening timing is within today and next 7 days
          $sql_select="SELECT DISTINCT M.* FROM movie as M JOIN screening as S ON M.id=S.movieId where M.id=".$movieId." AND S.locationId=".$locationId." AND S.timing<DATE_ADD(CURDATE(), INTERVAL 7 DAY) AND (S.timing>CURDATE())";
          $nowShowing = $conn->query($sql_select);
        }else{
          $sql_select="SELECT * FROM movie where (releaseDate<=DATE_ADD(CURDATE(), INTERVAL 7 DAY)) AND (releaseDate>=DATE_ADD(CURDATE(), INTERVAL -30 DAY))";
          $nowShowing = $conn->query($sql_select);
        }
      }else{
        $sql_select="SELECT * FROM movie where (releaseDate<=DATE_ADD(CURDATE(), INTERVAL 7 DAY)) AND (releaseDate>=DATE_ADD(CURDATE(), INTERVAL -30 DAY))";
          $nowShowing = $conn->query($sql_select);
      }
        
        $sql_select="SELECT * FROM movie where releaseDate>DATE_ADD(CURDATE(), INTERVAL 7 DAY)";
        $comingSoon = $conn->query($sql_select);

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

  <section class="slideshow">
    <div class="slideshow-container">
      <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="image/oppenheimer.webp" alt="slide1">
      </div>

      <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="image/five-nights-at-freddys-banner.webp" alt="slide2">
      </div>

      <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="image/creationOfTheGods-banner.jpeg" alt="slide3">
      </div>

      <div id="spacebetweenbuttons">
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>
    </div>


  </section>
  <section>
    <div class="audience">
    </div>
  </section>

  <section class="tabSection">
    <!-- Tab links -->
    <div class="tab">
      <button class="tablinks" onclick="openCity(event, 'nowShowingSection')" id="defaultOpen">NOW SHOWING</button>
      <button class="tablinks" onclick="openCity(event, 'Paris')">COMING SOON</button>
    </div>

    <!-- Tab content -->
    <div id="nowShowingSection" class="tabcontent" >
      <div class="tabItems">
        <h3>NOW SHOWING</h3>


        <form class="nowshowingform">
          <select id="movieFilterSelect" name="movieFilterSelect" onchange="selectFilter();">
            <option value="0">EVERYTHING</option>
            <?php

              while($row = $movieFilter->fetch_assoc()){
            ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
            <?php
              }
            ?>
          </select>

          <p> at</p>

          <select id="locationFilterSelect" name="locationFilterSelect" class="shift" onchange="selectFilter();">
            <option value="0">EVERYWHERE</option>
            <?php
              while($row = $locations->fetch_assoc()){
            ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
            <?php
              }
            ?>
          </select>

          <p> that's happening this week</p>

        </form>

        <div class="movieContent">
        <?php
          while($row = $nowShowing->fetch_assoc()){
        ?>
          <div class="movie" onclick="selectMovie('<?php echo $row['id'] ?>');">
            <img src="image/movies/<?php echo $row["image"] ?>" alt="movie1">
            <div class="movieInfo">
              <p class="title"><?php echo $row["title"] ?></p>
              <p><?php echo $row["duration"] ?>min | <?php echo $row["viewerDiscretion"] ?></p>
              <p><?php echo $row["genre"] ?></p>
              <br>
            </div>
          </div>
        <?php
          }
        ?>
        </div>
      </div>
    </div>

    <div id="Paris" class="tabcontent">
      <div class="tabItems">
        <h3>COMING SOON</h3>
        <div class="movieContent">
        <?php
          while($row = $comingSoon->fetch_assoc()){
        ?>
          <div class="movie" onclick="selectMovie('<?php echo $row['id'] ?>');">
            <img src="image/movies/<?php echo $row["image"] ?>" alt="movie1">
            <div class="movieInfo">
              <p class="title"><?php echo $row["title"] ?></p>
              <p><?php echo $row["duration"] ?>min | <?php echo $row["viewerDiscretion"] ?></p>
              <p><?php echo $row["genre"] ?></p>
              <br>
            </div>
          </div>
        <?php
          }
        ?>
        </div>

      </div>

  </section>

  <section class="aboutus">
    <img src="./image/Glass_Half_Full_6_640_360_81_s_c1.jpg" class="glassimg">
    <img src="./image/bath.jpg" class="bathimg">
    <div class="aboutuscontent" id="aboutuscontent">
      <h1>HELLO!</h1>
      <p>Introducing the truly unmatched cinematic experience, merging art-house with mouth-watering café and bar menus.
        Fabulously designed interiors. State-of-the-art laser projection technology. <br>Welcome to Ainz.
      </p>
    </div>
  </section>

  <section class="cafeandbar">
    <img src="./image/Tivoli- Lloyd Evans Photography-7.jpg" class="cafe">
    <div class="cafeandbarcontent" id="cafek">
      <h1>AINZ<br>CAFE</h1>
      <p>Join us for coffee, stay for lunch, take in a film.
      </p>
    </div>
    <img src=" ./image/Tivoli - Ellis Reed 2.jpg" class="bar">
    <div class="cafeandbarcontent">
      <h1>AINZ<br>BAR</h1>
      <p>Tickle your tastebuds and unwind into a contemporary or classic favourite.
      </p>
    </div>
  </section>

  <section class="lounge">
    <div class="loungesection">
      <img src="./image/WEB_IMAGERY_WITH_CHELTENHAM_BATH_ADDITION-06.jpg" class="lounge">
      <div class="loungecontent">
        <h1>THE<br>LOUNGE</h1>
        <p>Your comfort zone. Your treats. You call the shots. Join us for a coffee, a light bite or to catch up on
          email
          with our FREE Wi-Fi. Whether you are taking in a Film or not our door is open.
        </p>
      </div>
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
<script>
  var slideIndex = 1;
  showSlides(slideIndex);

  function plusSlides(n) {
    showSlides(slideIndex += n);
  }

  function currentSlide(n) {
    showSlides(slideIndex = n);
  }

  function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    slides[slideIndex - 1].style.display = "block";
  }




  //tabs
  function openCity(evt, cityName) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");

    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }

</script>

</html>