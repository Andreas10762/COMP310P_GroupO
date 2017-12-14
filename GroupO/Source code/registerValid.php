<?php

$emailErr = ""; $nameErr = ""; $surnameErr = ""; $passErr = ""; $verPassErr = "" ; $usernameErr = "" ;
$email = ""; $name = ""; $surname = ""; $password = ""; $verPass = "" ; $username = "" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require 'connect.php' ;
    $connection = connect();
    
    
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }
    if ($emailErr == "") {
        $emailquery = "SELECT customer_id FROM customer_information WHERE email='$email'";
        $emailresult = mysqli_query($connection,$emailquery) ;
        if (mysqli_num_rows($emailresult) > 0) {
            $emailErr = "A user already exists with this email address";
        }
        mysqli_free_result($emailresult);
    }

    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed"; 
        }
    }
    
    if (empty($_POST["surname"])) {
        $surnameErr = "Surname is required";
    } else {
        $surname = test_input($_POST["surname"]);
        if (!preg_match("/^[a-zA-Z ]*$/",$surname)) {
        $surnameErr = "Only letters and white space allowed";
        }
    }
    
    if (empty($_POST["password"])) {
        $passErr = "Password is required";
    } else {
        $password = test_input($_POST["password"]);
        if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,20}$/",$password)) {
        $passErr = "Invalid format"; 
        }
    }
    
    if (empty($_POST["verPass"])) {
        $verPassErr = "Please re-enter your password";
    } else {
        $verPass = test_input($_POST["verPass"]);
        if ($verPass != $password) {
        $verPassErr = "Passwords do not match."; 
        }
    }
    
    if (empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["username"]);
        if (!preg_match("/^[A-Za-z0-9]+(?:[_-][A-Za-z0-9]+)*$/",$username)) {
        $usernameErr = "Only letters, digits, hyphens and underscores are allowed, with no two hyphens or underscores in a row. Username has to start and end with a letter or digit"; 
        }
    }
    
    if ($usernameErr == "") {
        $usernamequery = "SELECT customer_id FROM customer_information WHERE username='$username'";
        $userresult = mysqli_query($connection,$usernamequery) ;
        if (mysqli_num_rows($userresult) > 0) {
            $usernameErr = "A user already exists with this username";
        }
        mysqli_free_result($userresult);
    }

    if ($emailErr == "" && $nameErr == "" && $surnameErr == "" && $passErr == "" && $verPassErr == "" && $usernameErr == "") {
        $createuser = "INSERT INTO customer_information (username, first_name, last_name, email, password)". "VALUES('$username','$name','$surname','$email','$password')";
        $result = mysqli_query($connection,$createuser) ;
        mysqli_free_result($result);
        $alert = true ;
        header('Location: index.php?correctusername='.$username.'&alert='.$alert);
    } else {
        header('Location: index.php?emailErr='.$emailErr.'&nameErr='.$nameErr.'&surnameErr='.$surnameErr.'&passErr='.$passErr.'&verPassErr='.$verPassErr.'&usernameErr='.$usernameErr
                .'&email='.$email.'&name='.$name.'&surname='.$surname.'&username='.$username);
    }
    
    mysqli_close($connection);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
