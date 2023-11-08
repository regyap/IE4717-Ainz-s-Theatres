<?php
// backend.php script to handle the ID received from the frontend
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Your backend logic here, for example, you can process the ID or perform database operations
    // For demonstration, let's just echo the received ID
    echo "Received ID: $id";
} else {
    echo "ID not received.";
}
?>

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

?>