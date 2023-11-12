<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/purchaseHistory.css" />
  </head>
  <script>
    
  </script>
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
  </body>
</html>
