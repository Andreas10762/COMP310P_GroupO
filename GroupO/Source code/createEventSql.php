<?php
$userid = $_GET['userid'] ;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//the following code will be executed only when this page is reached by the POST method (same for every page that follows a form, will not be commented again)

    //empty string variables for the data and for the errors (similar for every page that follows a form, will not be commented again)
    $eventdateErr = ""; $capacityErr = ""; $priceErr = ""; $venuenameErr = ""; $venueaddressErr = ""; $contactnoErr = ""; $performernameErr = ""; $genreErr = "" ;
    $eventdate = ""; $capacity = ""; $price = ""; $venuename = ""; $venueaddress = ""; $contactno = ""; $performername = ""; $genre = "" ;
   
    //validation for all the fileds posted )similar on every field and every page that follows a form, will not be commented again)
    if (empty($_POST["eventdate"])) {
        $eventdateErr = "Event date is required";
    } else {
        $eventdate = test_input($_POST["eventdate"]);
    }
    
    if (empty($_POST["capacity"])) {
        $capacityErr = "Capacity is required";
    } else {
        $capacity = test_input($_POST["capacity"]);
    }
    
    if (empty($_POST["price"])) {
        $priceErr = "Price is required";
    } else {
        $price = test_input($_POST["price"]);
        if (!preg_match("/^([0-9]+)((\.[0-9]{2,2})?)$/",$price)) {
            $priceErr = "Invalid format. Please enter only valid numbers and decimals of the format 00.00, and without the £ sign." ;
        }
    }
    
    if (empty($_POST["venuename"])) {
        $venuenameErr = "Venue name is required";
    } else {
        $venuename = test_input($_POST["venuename"]);
    }
    
    if (empty($_POST["venueaddress"])) {
        $venueaddressErr = "Venue address is required";
    } else {
        $venueaddress = test_input($_POST["venueaddress"]);
    }
    
    if (empty($_POST["contactno"])) {
        $contactnoErr = "Contact number is required";
    } else {
        $contactno = test_input($_POST["contactno"]);
    }
    
    if (empty($_POST["performername"])) {
        $performernameErr = "Peformer name is required";
    } else {
        $performername = test_input($_POST["performername"]);
    }
    
    if (empty($_POST["genre"])) {
        $genreErr = "Genre is required";
    } else {
        $genre = test_input($_POST["genre"]);
    }

    //performing queries only if all the errors are empty, i.e. all the data input is valid (similar for every validation page, will not be commented again)
    if ($eventdateErr == "" && $capacityErr == "" && $priceErr == "" && $venuenameErr == "" && $venueaddressErr == "" && $contactnoErr == "" && $performernameErr == ""&& $genreErr == "") {
        require 'connect.php' ;
        $connection = connect();     
        
        //if the performer already exists, it will be selected, if not, it will be inserted into the database as a new performer
        $isperformer = "SELECT performer_id FROM performer_information WHERE performer_name='$performername'";
        $isperformerresult = mysqli_query($connection,$isperformer) ;
        if (mysqli_num_rows($isperformerresult) == 0) {
            
            $selectgenre = "SELECT genre_id FROM genre WHERE genre='$genre'";
            $genreresult = mysqli_query($connection,$selectgenre) ;
            $genrerow = mysqli_fetch_array($genreresult);
            $genreid = $genrerow['genre_id'] ;        
            mysqli_free_result($genreresult);
        
            $addperformer = "INSERT INTO performer_information (performer_name, genre_id)". "VALUES('$performername','$genreid')";
            $performerresult = mysqli_query($connection,$addperformer) ;
            mysqli_free_result($performerresult);
        }
        
        //if the venue already exists, it will be selected, if not, it will be inserted into the database as a new venue
        $isvenue = "SELECT venue_id FROM venue_information WHERE venue_address='$venueaddress'";
        $isvenueresult = mysqli_query($connection,$isvenue) ;
        if (mysqli_num_rows($isvenueresult) == 0) {
            
            $addvenue = "INSERT INTO venue_information (venue_name, contact_number, venue_address)". "VALUES('$venuename','$contactno','$venueaddress')";
            $venueresult = mysqli_query($connection,$addvenue) ;
            mysqli_free_result($venueresult);
        }
        
        $selectvenue = "SELECT venue_id FROM venue_information WHERE venue_address='$venueaddress'";
        $venueidresult = mysqli_query($connection,$selectvenue) ;
        $venuerow = mysqli_fetch_array($venueidresult);
        $venueid = $venuerow['venue_id'] ;        
        mysqli_free_result($venueidresult);
        
        $selectperformer = "SELECT performer_id FROM performer_information WHERE performer_name='$performername'";
        $performeridresult = mysqli_query($connection,$selectperformer) ;
        $performerrow = mysqli_fetch_array($performeridresult);
        $performerid = $performerrow['performer_id'] ;        
        mysqli_free_result($performeridresult);
        
        $addevent = "INSERT INTO concert_information (venue_id, performer_id, date, price, capacity, host_id)". "VALUES('$venueid','$performerid','$eventdate','$price','$capacity','$userid')";
        $eventresult = mysqli_query($connection,$addevent) ;
        mysqli_free_result($eventresult);

        mysqli_close($connection);
        
        $created = true ;
        //redirecting to the homepage if the event is created successfully, and passing the created variable as true for the JS alert to be generated (similar for other pages that redirect after their successful completion, will not be commented again)
        header('Location: Home.php?userid='.$userid.'&created='.$created); 
    } else {
        //redirects back to the form page if there are any errors (similar for all validation pages which redirect back to the form if there are errors, will not be commented again)
        header('Location: createEvent.php?eventdateErr='.$eventdateErr.'&capacityErr='.$capacityErr.'&priceErr='.$priceErr.'&venuenameErr='.$venuenameErr.'&venueaddressErr='.$venueaddressErr.'&contactnoErr='.$contactnoErr
                .'&performernameErr='.$performernameErr.'&genreErr='.$genreErr.'&userid='.$userid);
    }
}

//function that filters the data input by trimming whitespaces, removes slashes, and neutralises html special characters (same on all pages that follow a form, will not be commented again) 
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}