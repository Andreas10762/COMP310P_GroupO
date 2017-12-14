<?php

$usernameErr = ""; $passErr = "";
$password = ""; $username = "" ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require("connect.php");
    $connection = connect();
    
    if (empty($_POST["loginusername"])) {
        $usernameErr = "Username is required";
    } else {
        $username = test_input($_POST["loginusername"]);        
        $usernamequery = "SELECT password FROM customer_information WHERE username='$username'";
        $userresult = mysqli_query($connection,$usernamequery) ;
        if (mysqli_num_rows($userresult) == 0) {
            $usernameErr = "Sorry, this username doesn't exist";
        } else {
            $userrow = mysqli_fetch_array($userresult);
        }
    }
    
    if (empty($_POST["loginpassword"])) {
        $passErr = "Password is required";
    } else {
        $password = test_input($_POST["loginpassword"]);
        if ($password != $userrow['password']) {
            $passErr = "Password is incorrect" ;
        }    
    }
    
    if ($passErr == "" && $usernameErr == "") {
        $getuser = "SELECT * FROM customer_information WHERE username='$username'";
        $result = mysqli_query($connection,$getuser) ;
        $row = mysqli_fetch_array($result);
        $name = $row['first_name'] ; $surname = $row['last_name'] ; $userid = $row['customer_id'] ;
        mysqli_free_result($result);
        header('Location: Home.php?&userid='.$userid);
    } else {
        header('Location: index.php?loginPassErr='.$passErr.'&loginUsernameErr='.$usernameErr);
    }
    
    mysqli_close($connection);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
