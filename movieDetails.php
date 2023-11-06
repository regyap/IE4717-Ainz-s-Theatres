<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/movieDetails.css" />
    <!-- <link rel="stylesheet" type="text/css" href="css/test2.css"> -->

</head>
<script>
//    var today = new Date();
//    var dd = String(today.getDate()).padStart(2, '0');
//    const month = today.toLocaleString('default', { month: 'long' })/January is 0!
document.addEventListener("DOMContentLoaded", function () {
    //Get the current date
    const currentDate = new Date();
    const datetimediv = document.getElementsByClassName("dateandtime");

    console.log("Number of elements with class 'dateandtime':", datetimediv.length);

    for (let i = 0; i < 7; i++) {

        const futureDate = new Date(currentDate);

        futureDate.setDate(currentDate.getDate() + i);
        console.log(formatDate(futureDate));
     
        const timeElement = document.createElement("div");
        timeElement.classList.add("dateandtimecontent");
        timeElement.innerHTML = formatDate(futureDate); // Assuming formatDate function is defined

        console.log(timeElement);
        datetimediv[i].appendChild(timeElement.cloneNode(true));

        // datetimediv.innerHTML = formatDate(nextDate)+' '
    }
    for (let j = 0; j < datetimediv.length; j++) {
        const clickedDate = convertDateForSQL(datetimediv[j].textContent.trim());

        // Add a click event listener to each date element
        datetimediv[j].addEventListener("click", function () {
        // Get the current URI
        let currentURI = window.location.href;

        // Remove existing clickedDate parameters
        currentURI = currentURI.replace(/(\?|&|#)clickedDate=[^&]+/g, "");

        // Check if the URI already has parameters
        const separator = currentURI.includes("?") ? "&" : "?";

        // Construct the URL with the clicked date
        const url = `${currentURI}${separator}clickedDate=${encodeURIComponent(clickedDate)}`;

        // Navigate to the new URL
        window.location.href = url;
        });
    }
});
    function convertDateForSQL(dateString) {
        // Assuming dateString is in the format "Nov 5"
        const [month, day] = dateString.split(' ');

        // Map month abbreviation to its numeric value (assuming English months)
        const monthMap = {
            'Jan': '01', 'Feb': '02', 'Mar': '03', 'Apr': '04', 'May': '05', 'Jun': '06',
            'Jul': '07', 'Aug': '08', 'Sep': '09', 'Oct': '10', 'Nov': '11', 'Dec': '12'
        };

        // Get current year as we don't have the year in the dateString
        const currentYear = new Date().getFullYear();

        // Format the date as "YYYY-MM-DD"
        const formattedDate = `${currentYear}-${monthMap[month]}-${day.padStart(2, '0')}`;

        return formattedDate;
    }

    function formatDate(date){
        const options = { day: 'numeric', month: 'short' };
        return new Intl.DateTimeFormat('en-US', options).format(date);
    }

    document.addEventListener("click", function (event) {
        if (event.target.classList.contains("dateandtime")) {
            // Retrieve the content (date) of the clicked link
            const clickedDate = event.target.textContent.trim();
            console.log("Clicked on link with date:", clickedDate);
        }
    });

    function selectTiming(screeningId){
        location.href = 'seatSelection.php?screeningId='+screeningId;
    }


</script>

<?php  

    if(isset($_POST['iwantko'])){
        $clickedDate = $_POST['iwantko'];
        echo "<script>console.log('Clicked date from php:', '$iwantko');</script>";
    }
    $locationsdata = null;
    if(isset($_GET['clickedDate'])&&isset($_GET['movieID'])){
        $movieID = $_GET['movieID'];
        $clickedDate = $_GET['clickedDate'];
        echo "<script>console.log('Clicked date from php:', '$clickedDate');</script>";

        $conn=mysqli_connect("localhost","root","" ,"IE4717_ainzs_theatres");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

        // get distinct loc
        $sql_select_dates = "SELECT DISTINCT location.id, location.name
        FROM screening
        JOIN location ON location.id = screening.locationId
        WHERE screening.movieId = ".$movieID." AND DATE(screening.timing) = '".$clickedDate."';";

        $locationsdata = $conn->query($sql_select_dates);

        // get distinct time from distinct loc
        // $sql_select_time="
        // SELECT DISTINCT(name), TIME_FORMAT(timing, '%H:%i') as timeatloc, timing 
        // FROM screening 
        // LEFT JOIN location ON location.id = screening.locationId 
        // WHERE screening.movieId = ".$movieID." AND DATE(timing) = '".$clickedDate."';";

        // $datedata = $conn->query($sql_select_time);
    }
    
    if(isset($_GET['movieID'])){
        $movieID = $_GET['movieID'];

    $conn=mysqli_connect("localhost","root","" ,"IE4717_ainzs_theatres");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }
   
    // $sql_select="select * 
    // from movie 
    // left join screening ON movie.id = screening.movieId
    // left join location on location.id = screening.locationId
    // left join review on movie.id = review.movieId
    // where screening.movieId = '$movieID'
    // LIMIT 1
    // ;";
 //   for movie details
    $sql_select="SELECT movie.title, movie.image, movie.duration, movie.viewerDiscretion, movie.viewerDiscretionDescription, movie.sypnosis, movie.director, movie.cast, movie.releaseDate, movie.genre, screening.id, screening.timing
    FROM movie 
    LEFT JOIN screening ON movie.id = screening.movieId
    WHERE movie.id = " . $movieID . "
    LIMIT 1;";

    // for location
    $sql_select_location="SELECT movie.title, movie.image, movie.duration, movie.viewerDiscretion, movie.viewerDiscretionDescription, movie.sypnosis, movie.director, movie.cast, movie.releaseDate, movie.genre, screening.id, screening.timing, location.name, location.address, location.image
    FROM movie
    LEFT JOIN screening ON movie.id = screening.movieId
    LEFT JOIN location ON location.id = screening.locationId
    WHERE screening.movieId = " . $movieID . ";";

    // for movie details avg rating
    $sql_select_avg_rating="select movieId, comment, rating, uplaodDateTime, avg(rating)
    from review
    where movieId = '$movieID';";

    //   for comment
    $sql_select_comment="select movieId, comment, rating, uplaodDateTime
    from review
    where movieId = '$movieID';";



    
    $alldata = $conn->query($sql_select);
    $locationdata = $conn->query($sql_select_location);
    $avgratingdata = $conn->query($sql_select_avg_rating);
    $commentdata = $conn->query($sql_select_comment);
   
  
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
    <section class="moviedetailpagecss">

<?php

$firstIteration  = true;
 $firstrow=mysqli_fetch_assoc($alldata);
 mysqli_data_seek($alldata, 0);
 
 while($row=mysqli_fetch_assoc($alldata)){
        if($firstIteration ){

?>
        <section class="moviedetails">
            <div class="movietitle">
                <h1><?php echo $row['title']?></h1>
                <p> <span class="discretion"><?php echo $row['viewerDiscretion']?></span><?php echo $row['viewerDiscretionDescription'] ?></p>

            </div>
            <div class="moviecontentandposter">
                <img src="image/movies/<?php echo $row['image'] ?>" class="movieposter">
                <div class="allcontent">
                    <div class="moviecontent">
                        <h3>Details</h3>
                        <div class="flextableanddiv">
                            <table>
                                <tbody>
                                    <tr class="table-row">
                                        <td class="heading">Cast: </td>
                                        <td class="content">
                                            <p><?php echo $row['cast'] ?></p>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="heading">Director: </td>
                                        <td class="content">
                                            <p><?php echo $row['director'] ?></p>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="heading">Genre: </td>
                                        <td class="content">
                                            <p><?php echo $row['genre'] ?> </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="movieinfo">
                                <div class="movieinfoparts">
                                    <p>Release Date: </p>
                                    <p>Running Time: </p>
                                    <p>Viewer Rating: </p>

                                </div>
                                <div class="movieinfoparts2">
                                    <p> <?php echo $row['releaseDate'] ?> </p>
                                    <p><?php echo $row['duration'] ?> Minutes </p>
                                    <p><?php
                                     while($row2 = $avgratingdata->fetch_assoc()){
                                        echo $row2['avg(rating)'];
                                     }
                                    ?> </p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="moviecontent">

                            <div class="synopsis">
                                <h3>Synopsis</h3>
                                <p><?php echo $row['sypnosis'] ?></p>
                            </div>
                        </div>
                    </div>




                </div>
        </section>

        <?php
        $firstIteration = false; // Set the flag to false to indicate that the first iteration has occurred
          }
          else{

        ?>
         <section class="moviedetails">
            <div class="movietitle">
                <h1>Oppenheiner</h1>
                <p> <span class="discretion">PG13</span>Violence </p>

            </div>
            <div class="moviecontentandposter">
                <img src="image/movies/disneysWish.jpg" class="movieposter">
                <div class="allcontent">
                    <div class="moviecontent">
                        <h3>Details</h3>
                        <div class="flextableanddiv">
                            <table>
                                <tbody>
                                    <tr class="table-row">
                                        <td class="heading">Cast: </td>
                                        <td class="content">
                                            <p>ixing Zhang 张艺兴, Gina Chen Jin 金晨, Chuanjun Wang 王传君, Mei Yong 咏梅, Darren
                                                Wang
                                                王大陆, Sunny
                                                Sun 孙阳, Zhou Ye 周也 </p>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="heading">Director: </td>
                                        <td class="content">
                                            <p>ixing Zhang 张艺兴, Gina Chen Jin 金晨, Chuanjun Wang 王传君, Mei Yong 咏梅, Darren
                                                Wang
                                                王大陆, Sunny
                                                Sun 孙阳, Zhou Ye 周也 </p>
                                        </td>
                                    </tr>
                                    <tr class="table-row">
                                        <td class="heading">Genre: </td>
                                        <td class="content">
                                            <p>Horror </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="movieinfo">
                                <div class="movieinfoparts">
                                    <p>Release Date: </p>
                                    <p>Running Time: </p>
                                    <p>Viewer Rating: </p>

                                </div>
                                <div class="movieinfoparts2">
                                    <p> Date </p>
                                    <p>130 Minutes </p>
                                    <p>Cast: </p>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="moviecontent">

                            <div class="synopsis">
                                <h3>Synopsis</h3>
                                <p> ixing Zhang 张艺兴, Gina Chen Jin 金晨, Chuanjun Wang 王传君, Mei Yong 咏梅, Darren Wang
                                    王大陆, Sunny Sun 孙阳,
                                    Zhou Ye 周也 ixing Zhang 张艺兴, Gina Chen Jin 金晨, Chuanjun Wang 王传君, Mei Yong 咏梅, Darren
                                    Wang
                                    王大陆,
                                    Sunny
                                    Sun 孙阳, Zhou Ye 周也ixing Zhang 张艺兴, Gina Chen Jin 金晨, Chuanjun Wang 王传君, Mei Yong 咏梅,
                                    Darren
                                    Wang
                                    王大陆, Sunny Sun 孙阳, Zhou Ye 周也ixing Zhang 张艺兴, Gina Chen Jin 金晨, Chuanjun Wang 王传君,
                                    Mei
                                    Yong
                                    咏梅,
                                    Darren Wang 王大陆, Sunny Sun 孙阳, Zhou Ye 周也ixing Zhang 张艺兴, Gina Chen Jin 金晨, Chuanjun
                                    Wang
                                    王传君,
                                    Mei
                                    Yong 咏梅, Darren Wang 王大陆, Sunny Sun 孙阳, Zhou Ye 周也</p>
                            </div>
                        </div>
                    </div>




                </div>
        </section>




        <?php



          }
        }
        // close bracket for first interation and while loop

        // while($row=mysqli_fetch_assoc($alldata))
        ?>

     
        <section>
            <div class="time">
                <h1>Choose Time</h1>
            </div>








            <article class="flexflex">


                <section class="flexarrow" id="leftarrow">
                    <p>
                        <svg class="arrowkey" xmlns="http://www.w3.org/2000/svg" width="43" height="8"
                            viewBox="0 0 43 8" fill="none">
                            <path
                                d="M0.646446 3.64645C0.451183 3.84171 0.451183 4.15829 0.646446 4.35355L3.82843 7.53553C4.02369 7.7308 4.34027 7.7308 4.53553 7.53553C4.7308 7.34027 4.7308 7.02369 4.53553 6.82843L1.70711 4L4.53553 1.17157C4.7308 0.976311 4.7308 0.659728 4.53553 0.464466C4.34027 0.269204 4.02369 0.269204 3.82843 0.464466L0.646446 3.64645ZM43 3.5H1V4.5H43V3.5Z"
                                fill="#FBCC97" />
                        </svg>


                    </p>
                </section>

              
                <section class="flexarrow" id="carou">
                    <div class="product">
                        <!-- <div  onclick="redirectToBackend(index.php)"> -->
                        <a class="dateandtime">
                          
                        </a>
                    </div>
                    <div class="product">
                        <a href="test2.html?vid_id='.$video_id;" class="dateandtime">
                           
                        </a>
                    </div>
                    <div class="product">
                        <a href="test2.html?vid_id='.$video_id;" class="dateandtime">
                           
                        </a>
                    </div>
                    <div class="product">
                        <a href="test2.html?vid_id='.$video_id;" class="dateandtime">
                           
                        </a>
                    </div>
                    <div class="product">
                        <a href="test2.html?vid_id='.$video_id;" class="dateandtime">
                           
                        </a>
                    </div>
                    <div class="product">
                        <a href="test2.html?vid_id='.$video_id;" class="dateandtime">
                            
                        </a>
                    </div>
                    <div class="product">
                        <a href="test2.html?vid_id='.$video_id;" class="dateandtime">
                            
                        </a>
                    </div>

                </section>
                <section class="flexarrow" id="rightarrow">
                    <p>

                        <svg class="arrowkey" xmlns="http://www.w3.org/2000/svg" width="43" height="8"
                            viewBox="0 0 43 8" fill="none">
                            <path
                                d="M42.3536 4.35355C42.5488 4.15829 42.5488 3.84171 42.3536 3.64645L39.1716 0.464466C38.9763 0.269204 38.6597 0.269204 38.4645 0.464466C38.2692 0.659728 38.2692 0.976311 38.4645 1.17157L41.2929 4L38.4645 6.82843C38.2692 7.02369 38.2692 7.34027 38.4645 7.53553C38.6597 7.7308 38.9763 7.7308 39.1716 7.53553L42.3536 4.35355ZM0 4.5H42V3.5H0V4.5Z"
                                fill="#FBCC97" />
                        </svg>
                    </p>
                </section>
            </article>

       
        </section>

        <!-- <form action="movieDetails.php" method="get"> -->
        <section class="locationandtimetablesection">
        <div class="locationandtimetable">
        <div class="table-heading">
            <h1 class="theatre">Theatres</h1>
            <h1 class="time">Timing</h1>
        </div>
        <div class="table-content">
        <?php if(!is_null($locationsdata) && $locationsdata instanceof mysqli_result && mysqli_num_rows($locationsdata) > 0){

        while($row2=mysqli_fetch_assoc($locationsdata)){ ?>
            <div class="table-row">
                <p class="row-head"><?php echo $row2["name"]?></p>
                <div class="boxes">
                    <?php 
                        $movieID = $_GET['movieID'];
                        $clickedDate = $_GET['clickedDate'];
                        $sql_select_time="
                        SELECT id, TIME_FORMAT(timing, '%H:%i') as timeatloc 
                        FROM screening WHERE locationId=".$row2["id"]." AND movieId = ".$movieID." AND DATE(timing) = '".$clickedDate."';";
                        $datedata = $conn->query($sql_select_time);

                        while($row3=mysqli_fetch_assoc($datedata)){ 
                            // echo $row3["timing"];
                    ?>
                                <input value="<?php echo $row3["timeatloc"]?>" id="iwantko" class="box" onclick="selectTiming('<?php echo $row3['id'] ?>');">
                    <?php
                        }
                    ?>
                  
                </div>
            </div>
            <?php }}else{?>
                <div class="table-row">
                <p class="row-head">No screening on this date</p>
                <div class="boxes">
                    <input type="submit" value="NA" class="box">
                </div>
                
            <?php }?>
            <!-- <div class="table-row">
                <p class="row-head">Location 2</p>
                <div class="boxes">
                    <input type="submit" value="11.25" class="box">                   
                </div>
            </div>
            <div class="table-row">
                <p class="row-head">Location 3</p>
                <div class="boxes">
                    <input type="submit" value="11.25" class="box">
                </div>
            </div>
            <div class="table-row">
                <p class="row-head">Location 9</p>
                <div class="boxes">
                    <input type="submit" value="11.25" class="box">
                    <input type="submit" value="11.25" class="box">
                    <input type="submit" value="11.25" class="box">
                    <input type="submit" value="11.25" class="box">
                    <input type="submit" value="11.25" class="box">
          
                    <input type="submit" value="11.25" class="box">
                    <input type="submit" value="11.25" class="box">
                    <input type="submit" value="11.25" class="box">
                </div>
            </div>
            <div class="table-row">
                <p class="row-head">Location 10</p>
                <div class="boxes">
                    <input type="submit" value="11.25" class="box">
                    <input type="submit" value="11.25" class="box">
                    <input type="submit" value="11.25" class="box">
                </div>
            </div>
        </div> -->
    </div>
    </section>
            <!-- </form> -->
   

    <section class="comment">


    </section>

    <?php

} 
// this close bracket is from if(isset($_GET['movieID'])) to check if movieID is taken from index.php or not   
else{
    header("Location: index.php");
}
?>


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
<script type="text/javascript" src="js/test2.js"></script>
<script>
    // JavaScript function to handle the click event and redirect to the backend with the ID
    function redirectToBackend(id) {
        // You can use AJAX to send the ID to the backend
        // For simplicity, let's use fetch to send the ID to a PHP script
        fetch('backend.php?id=' + id)
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
    }
</script>


</html>