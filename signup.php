<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ainz's Theatres</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/signup.css" />
</head>
<script>
        function validateEmail() {
        const emailInput = document.getElementById("emailInput").value;
        console.log(emailInput)
        const resultMessage = document.getElementById("resultMessage");
        const pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        console.log("Pattern test result:", pattern.test(emailInput));

        if (pattern.test(emailInput)) {
            console.log("Email is valid")
            resultMessage.innerHTML = "Email is valid";
        } else {
            resultMessage.innerHTML = "Email is not valid";
        }
        }
        function signup_validate()
            {
                var pw = document.getElementById('password');
                var cfpw = document.getElementById('confirmpassword');

                if(pw.value != cfpw.value)
                {
                    resultMessage.innerHTML = "Password Not Matched";
                    return false;
                }
                else
                {
                    return true;

                }
            }

        
    </script>
    <script src="js/global.js"></script>
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
            <form action="login" method="post">


                <div>
                    <input type="text" name="email" pattern=".{3,}" required autofocus oninput="validateEmail()" id="emailInput">
                    <label> Email: </label>
                </div>
                <div>
                    <input type="text" name="name" pattern=".{3,}" required autofocus id="nameInput">
                    <label> Name: </label>
                  
                </div>
                <div>  <input type="text" name="contactno" pattern=".{3,}" required autofocus  id="contactnoInput">
                    <label> Contact Number: </label>
                 
                </div>
                <div>
                    <input type="password" name="pass" pattern=".{3,}" required autofocus id="password">
                    <label> Enter Password: </label>
                </div>
                <div>
                    <input type="password" name="confirmpass" pattern=".{3,}" required autofocus id="confirmpassword">
                    <label> Confirm Password: </label>
                </div>


                <div id="resultMessage"></div>
                <input type="submit" value="register">
            </form><br>
        
        </div>


    </section>



</body>

</html>