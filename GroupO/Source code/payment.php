<?php
$userid = $_GET['userid'] ;
$concertid = $_GET['concertid'] ;
$quantity = $_GET['quantity'] ;
$price = $_GET['price'] ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $cardnoErr = ""; $cvvErr = "";
    $cardno = ""; $cvv = "";
    if (empty($_POST["cardno"])) {
        $cardnoErr = "Card number is required";
    } else {
        $cardno = test_input($_POST["cardno"]);
        if (!preg_match("/^([0-9]{16,16})$/",$cardno)) {
            $cardnoErr = "Please enter a valid card number";
        }
    }
    
    if (empty($_POST["cvv"])) {
        $cvvErr = "CVV2 is required";
    } else {
        $cvv = test_input($_POST["cvv"]);
        if (!preg_match("/^([0-9]{3,3})$/",$cvv)) {
            $cvvErr = "Please enter a valid CVV2";
        }
    }

    if ($cardnoErr == "" AND $cvvErr == "") {
        require 'connect.php' ;
        $connection = connect();
        
        for ($i = 1; $i <= $quantity; $i++) {
            $addticket = "INSERT INTO tickets (customer_id, concert_id)". "VALUES('$userid','$concertid')";
            $result = mysqli_query($connection,$addticket) ;
            mysqli_free_result($result);
        }
        
        mysqli_close($connection);
        
        $purchased = true ;
        header('Location: Home.php?userid='.$userid.'&purchased='.$purchased);
    } else {
        header('Location: confirmPurchase.php?userid='.$userid.'&concertid='.$concertid.'&quantity='.$quantity.'&price='.$price.'&cardnoErr='.$cardnoErr.'&cvvErr='.$cvvErr);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}