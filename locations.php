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
      location.href = 'timingsOfLocation.html?locationId='+index;
      }
  </script>

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
