<?php
$userid = $_GET['userid'] ;
$concertid = $_GET['concertid'] ;
$performer = $_GET['performer'] ;
$date = $_GET['date'] ;
$venue = $_GET['venue'] ;
$price = $_GET['price'] ;
$available = $_GET['available'] ;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $quantityErr = "";
    $quantity = "";
    if (empty($_POST["quantity"])) {
        $quantityErr = "Quantity is required";
    } else {
        $quantity = test_input($_POST["quantity"]);
        if ($quantity > $available OR $quantity < 0) {
            $quantityErr = "Please enter a valid quantity (more than zero and less than or equal the number of available tickets)";
        }
    }

    if ($quantityErr == "") {
        header('Location: confirmPurchase.php?userid='.$userid.'&concertid='.$concertid.'&quantity='.$quantity.'&price='.$price); 
    } else {
        header('Location: BuyTickets.php?quantityErr='.$quantityErr.'&userid='.$userid.'&concertid='.$concertid.'&performer='.$performer.'&date='.$date.'&venue='.$venue.'&price='.$price.'&available='.$available);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}