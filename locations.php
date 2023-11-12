<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/locations.css" />
  </head>
  <script>
      function selectLocation(index) {
      location.href = 'timingOfLocations.php?locationId='+index;
      }
  </script>
  <script src="js/global.js"></script>

  <?php
        $conn=mysqli_connect("localhost","root","" ,"IE4717_ainzs_theatres");
    // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        $sql_select="SELECT * FROM location";
        $locations = $conn->query($sql_select);

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
    <?php
          while($row = $locations->fetch_assoc()){
    ?>
      <div class="locationCard" onclick="selectLocation('<?php echo $row['id'] ?>');">
        <img src="image/locations/<?php echo $row["image"] ?>" />
        <div class="descSection">
          <span class="name"><?php echo $row["name"] ?></span>
          <span class="address"><?php echo $row["address"] ?></span>
          <div class="showtimesBTN">SHOWTIMES</div>
        </div>
      </div>
    <?php
          }
    ?>
      </div>
    </div>
  </body>
</html>
