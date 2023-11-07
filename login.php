    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Ainz's Theatres</title>
        <meta charset="utf-8" />
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

    <body>
        <nav class="navbar">
            <a href="#" class="user"><img src="image/login.png">Hello, Ainz</a>
            <br>
            <a href="#" class="navlinks">NOW SHOWING</a>
            <a href="#" class="navlinks">COMING SOON</a>
            <a href="#" id="logo"><img src="image/Asset 1@4x.png"></a>
            <a href="#" class="navlinks">LOCATION</a>
            <a href="#" class="navlinks">ABOUT US</a>
            <br>
            <input type="submit" value="FAST BOOKING" class="lol">
        </nav>

        <section class="boxbg">
            <div class="box">
                <div id="profileimg"><img src="image/login.png"></div> <br>
                <h2>Sign In</h2>

                <form action="signin_process.php" method="post">


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
                    <a href="signup.html">here</a>
                </p>

            </div>


        </section>



    </body>

    </html>