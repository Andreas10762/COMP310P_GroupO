<!DOCTYPE html>
<html>
    <head>
        <title>Curly Boyz Events - Login/Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Errors.css">
        <link rel="stylesheet" type="text/css" href="Header.css">
        <link rel="stylesheet" type="text/css" href="index.css">
    </head>
    
    <body>
        <header>
        <h1 class="company">Curly Boyz Events</h1>
        </header>
        
        <div id="about">
            <h2>About Us</h2>
            <p>
                Curly Boyz Events is an up and coming musical concert events 
                management website that has adapted the technology for any 
                person to book, manage or create an event from their own comfort
                zone.<br/>
                We hope you enjoy using our services
            <p>
        </div>
        
        <h2 id='indextitle'>Login/Register</h2>
        <div id="loginform">
            <h3>Already an existing user? Log in:</h3>
            <form name="login" action="loginValid.php" method="post">
                Username: <input type="text" name="loginusername" placeholder="Username" value="<?php echo $_GET['correctusername'];?>"><br/><span class="error"> <?php echo $_GET['loginUsernameErr'];?></span><br/>
                Password: <input type="password" name="loginpassword" placeholder="password" id="loginpassword"><input type="checkbox" id="loginshow">Show Password<br/><span class="error"> <?php echo $_GET['loginPassErr'];?></span><br/>
                <input type="submit" name="submit" value="Log In">
            </form>
            <a href="forgotpass.php">Forgot password</a>
        </div>
        
        <div id="registerform">
            <h3>Register to use our services:</h3>
            <form name="register" action="registerValid.php" method="post">
                First Name: <input type="text" name="name" placeholder="Name" value="<?php echo $_GET['name'];?>"><br/><span class="error"> <?php echo $_GET['nameErr'];?></span><br/>
                Surname: <input type="text" name="surname" placeholder="Surname" value="<?php echo $_GET['surname'];?>"><br/><span class="error"> <?php echo $_GET['surnameErr'];?></span><br/>
                Email Address: <input type="email" name="email" placeholder="curly@boyz.com" value="<?php echo $_GET['email'];?>"><br/><span class="error"> <?php echo $_GET['emailErr'];?></span><br/>
                Username: <input type="text" name="username" placeholder="Username" value="<?php echo $_GET['username'];?>"><br/><span class="error"> <?php echo $_GET['usernameErr'];?></span><br/>
                <span id="passwordformat">Password must be at least 6 characters, no more than 20 characters, and must include at least one upper case letter, one lower case letter, and one numeric digit</span><br/>
                Password: <input type="password" name="password" id="password" placeholder="password" value="<?php echo $_GET['password'];?>"><input type="checkbox" id="show">Show Password<br/><span class="error" id="passError"> <?php echo $_GET['passErr'];?></span><br/>
                Verify Password: <input type="password" name="verPass" id="verpassword" placeholder="verify password"><input type="checkbox" id="showver">Show Password<br/><span class="error"> <?php echo $_GET['verPassErr'];?></span><br/>
                <input type="submit" name="submit" value="Create Account">
            </form>
        </div>
        
        <?php
        include 'footer.php';
        ?>
        
        <script src="login.js"></script>
        <script src="register.js"></script>
                
        <script>
            //function to generate an alert and hide the register form when an account is created successfully
            (function() {
                var created = <?php echo $_GET['alert'];?> ;
                var registerdiv = document.getElementById("registerform") ;
                
                if (created == 1) {
                    window.onload=function(){hideregister()} ;
                    alert("You have successfully created an account! Please log in") ;
                }
                
                function hideregister() {
                    registerdiv.style.display = "none" ;
                }
            })();
        </script>
    </body>
</html>