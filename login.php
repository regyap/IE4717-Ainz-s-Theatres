    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Ainz's Theatres</title>
        <meta charset="utf-8" / >
        <link rel="stylesheet" href="css/global.css" />
        <link rel="stylesheet" href="css/login.css" />
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
                        // if(isset($_SESSION['notsignedinfromcontact'])){

                        //     if($_SESSION['notsignedinfromcontact']==true){
                        //         echo "Sign in before you feedback";
                        //         //                unset($_SESSION['notsignedinfromcontact']);
                        //     }
                        // }
                        ?>
                    <input type="submit" name="submit" value="login">
                </form><br>
                <p>
                    Don't have an account? <br />
                    Create one
                    <a href="signup.php">here</a>
                </p>

            </div>


        </section>



    </body>

    </html>