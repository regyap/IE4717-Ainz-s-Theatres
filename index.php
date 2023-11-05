<!DOCTYPE html>
<html lang="en">

<head>
  <title>Ainz's Theatres</title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="css/global.css" />
  <link rel="stylesheet" href="css/index.css" />
</head>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("defaultOpen").click();
  });

  function selectMovie(index) {
      location.href = 'movieDetails.php?movieID='+index;
  }
</script>

<?php
        $conn=mysqli_connect("localhost","root","" ,"IE4717_ainzs_theatres");
    // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $sql_select="SELECT * FROM movie where releaseDate<=DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
        $nowShowing = $conn->query($sql_select);

        $sql_select="SELECT * FROM movie where releaseDate>=DATE_ADD(CURDATE(), INTERVAL -7 DAY)";
        $comingSoon = $conn->query($sql_select);

        $conn->close();
    ?>

<body>
  <nav class="navbar">
    <a href="login.html" class="user"><img src="image/login.png">Hello, Ainz</a>
    <br>
    <a href="#" class="navlinks">NOW SHOWING</a>
    <a href="#" class="navlinks">COMING SOON</a>
    <a href="#" id="logo"><img src="image/Asset 1@4x.png"></a>
    <a href="#" class="navlinks">LOCATION</a>
    <a href="aboutus.html" class="navlinks">ABOUT US</a>
    <br>
    <input type="submit" value="FAST BOOKING" class="lol">
  </nav>

  <section class="slideshow">
    <div class="slideshow-container">

      <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="image/oppenheimer.webp" alt="slide1">


        <!-- <div id="slide1"></div> -->

      </div>

      <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="image/oppenheimer.webp" alt="slide2">

        <!--                    <div id="slide2"></div>-->

      </div>

      <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="image/oppenheimer.webp" alt="slide3">
        <!--                    <div id="slide3"></div>-->

      </div>

      <div id="spacebetweenbuttons">
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
      </div>

    </div>


  </section>
  <section>
    <div class="audience">
      <!-- <img src="./image/seats.jpeg"> -->
    </div>
  </section>

  <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
  <section class="tabSection">
    <!-- Tab links -->
    <div class="tab">
      <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen">NOW SHOWING</button>
      <button class="tablinks" onclick="openCity(event, 'Paris')">COMING SOON</button>
      <!-- <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button> -->
    </div>

    <!-- Tab content -->
    <div id="London" class="tabcontent">
      <div class="tabItems">
        <h3>NOW SHOWING</h3>


        <form class="nowshowingform">
          <label for="cars"></label>
          <select id="cars" name="cars">
            <option value="volvo">EVERYTHING</option>
            <option value="saab">Saab</option>
            <option value="fiat">Fiat</option>
            <option value="audi">Audi</option>
          </select>

          <p> at</p>

          <label for="cars"></label>
          <select id="cars1" name="cars" class="shift">
            <option value="volvo">EVERYWHERE</option>
            <option value="saab">Saab</option>
            <option value="fiat">Fiat</option>
            <option value="audi">Audi</option>
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
    <div class="aboutuscontent">
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
        <a href="#">NOW SHOWING</a>
        <a href="#">COMING SOON</a>
        <a href="#">LOCATION</a>
        <a href="#">ABOUT US</a>
      </div>
      <br> <br>
      <p>© 2021 Ainz's Theatres. All Rights Reserved.</p>
  </footer>




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
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) { slideIndex = 1 }
    if (n < 1) { slideIndex = slides.length }
    for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex - 1].style.display = "block";
    dots[slideIndex - 1].className += " active";
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