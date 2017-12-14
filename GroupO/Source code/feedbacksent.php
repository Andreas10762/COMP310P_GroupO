<?php
$userid = $_GET['userid'] ;
$concertid = $_GET['concertid'] ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'connect.php' ;
    $connection = connect(); 
    $feedback = test_input($_POST["feedback"]);

    $rating = test_input($_POST["rating"]);

    $feedbackinsert = "INSERT INTO feedback (customer_id, concert_id, feedback, rating) VALUES('$userid','$concertid','$feedback','$rating')";
    $feedbackresult = mysqli_query($connection,$feedbackinsert) ;
    mysqli_free_result($feedbackresult);

    mysqli_close($connection);

    $sent = true ;
    header('Location: eventsAttended.php?userid='.$userid.'&sent='.$sent);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

