<!DOCTYPE HTML>
<html>
    <head>
        <title>Curly Boyz Events - Events</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Header.css">
        <link rel="stylesheet" type="text/css" href="Errors.css">
        <link rel="stylesheet" type="text/css" href="body.css">
    </head>
    
    <body>
        <?php include 'header.php'; ?>
        
        <div>
            <h2>Available Events</h2>

            <?php
            $userid = $_GET['userid'] ;
            $connection = connect();
            $dateFromErr = "" ; $dateToErr = "" ; $genreErr = "" ;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                $dateFrom = test_input($_POST["dateFrom"]);

                $dateTo = test_input($_POST["dateTo"]);
                if (!empty($dateTo) AND $dateTo < $dateFrom) {
                    $dateToErr = "Date To should be later than Date From";
                }


                $performername = test_input($_POST["performer"]);
                $genre = test_input($_POST["genre"]);

                if (!empty($performername) AND !empty($genre)) {
                    $genreErr = "Please enter EITHER a performer name OR a genre, not both";
                }

                if($dateToErr != "" OR $genreErr != "") {
                    header('Location: findEvents.php?dateFromErr='.$dateFromErr.'&dateToErr='.$dateToErr.'&genreErr='.$genreErr.'&userid='.$userid) ;
                }

                $pricehigh = test_input($_POST["pricehigh"]);
                $pricelow = test_input($_POST["pricelow"]);
                $sort = test_input($_POST["sort"]);

                if (empty($performername) && empty($genre) && empty($dateFrom) && empty($dateTo) && empty($pricelow) && empty($pricehigh)) {
                    header('Location: eventlist.php?userid='.$userid) ;
                }

                if ($sort == "lowprice") {
                    $sort = "ci.price ASC" ;
                }

                if ($sort == "highprice") {
                    $sort = "ci.price DESC" ;
                }

                if ($sort == "performer") {
                    $sort = "pi.performer_name ASC" ;
                }

                if ($sort == "date") {
                    $sort = "ci.date ASC" ;
                }

                $performerConstraint="pi.performer_name='$performername'" ;
                $genreConstraint="g.genre = '$genre'" ;
                $dateFromConstraint="ci.date >= '$dateFrom'" ;
                $dateToConstraint="ci.date <= '$dateTo'" ;
                $priceLowConstraint="ci.price >= '$pricelow'" ;
                $priceHighConstraint="ci.price <= '$pricehigh'" ;

                $firstAnd = "AND" ;
                $secondAnd = "AND" ;
                $thirdAnd = "AND" ;
                $fourthAnd = "AND" ;
                $fifthAnd = "AND" ;

                if (empty($performername)) {
                    $performerConstraint="" ;
                    $firstAnd = "" ;
                }

                if (empty($genre)) {
                    $genreConstraint="" ;
                    $secondAnd = "" ;
                }

                if (empty($dateFrom)) {
                    $dateFromConstraint="" ;
                    $thirdAnd = "" ;
                }

                if (empty($dateTo)) {
                    $dateToConstraint="" ;
                    $fourthAnd = "" ;
                }

                if (empty($pricelow)) {
                    $priceLowConstraint="" ;
                    $fifthAnd = "" ;
                }

                if (empty($pricehigh)) {
                    $fifthAnd = "" ;
                    $priceHighConstraint="" ;
                }

                if (empty($genre) && empty($dateFrom) && empty($dateTo) && empty($pricelow) && empty($pricehigh)) {
                    $firstAnd = "" ;
                }

                if (empty($dateFrom) && empty($dateTo) && empty($pricelow) && empty($pricehigh)) {
                    $secondAnd = "" ;
                }

                if (empty($dateTo) && empty($pricelow) && empty($pricehigh)) {
                    $thirdAnd = "" ;
                }

                if (empty($pricelow) && empty($pricehigh)) {
                    $fourthAnd = "" ;
                }

                $findsql = "SELECT ci.concert_id, pi.performer_name, g.genre, ci.date, vi.venue_name, ci.price, ci.capacity 
                            FROM concert_information ci JOIN performer_information pi ON ci.performer_id = pi.performer_id
                            JOIN genre g ON pi.genre_id = g.genre_id JOIN venue_information vi ON ci.venue_id = vi.venue_id WHERE
                            $performerConstraint
                            $firstAnd
                            $genreConstraint
                            $secondAnd
                            $dateFromConstraint
                            $thirdAnd
                            $dateToConstraint
                            $fourthAnd
                            $priceLowConstraint
                            $fifthAnd
                            $priceHighConstraint
                            ORDER BY $sort";

                $result = mysqli_query($connection, $findsql) ;
                ?>

                <table border ="1">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Venue</th>
                            <th>Performer</th>
                            <th>Genre</th>
                            <th>Price</th>
                            <th>Capacity</th>
                            <th>Available Tickets</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($result)) {
                        $performer = $row['performer_name'] ;
                        $genreresult = $row['genre'] ;
                        $date = $row['date'] ;
                        $venue = $row['venue_name'] ;
                        $price = $row['price'] ;
                        $capacity = $row['capacity'] ;
                        $concertid = $row['concert_id'] ;

                        $countsql= "SELECT (ci.capacity-COUNT(t.ticket_no))AS available FROM concert_information ci 
                        JOIN tickets t ON t.concert_id=ci.concert_id WHERE t.concert_id='$concertid' ";

                        $countresult = mysqli_query($connection,$countsql) ;
                        $countrow = mysqli_fetch_array($countresult) ;

                        $available = $countrow['available'] ;
                        if($date < date("Y-m-d h:i:s")) {
                            $button = "<td class=\"noborder\"><a href='hostedFeedback.php?userid=$userid"."&concert_id=$concertid"."&performername=$performer"."&venuename=$venue"."&date=$date'>"
                            . "<button>Show Feedback</button></a></td></tr>" ;
                        }
                        
                        if($date > date("Y-m-d h:i:s")) {
                            $button = "<td><a href='BuyTickets.php?userid=$userid"."&concertid=$concertid"."&performer=$performer"."&date=$date"."&venue=$venue"."&price=$price"."&available=$available'>"
                                . "<button>Buy Tickets</button></a></td></tr>" ;
                        }
                        
                        echo "<tr><td class=\"date\">".$date."</td><td>".$venue."</td><td>".$performer."</td><td>".$genreresult."</td>"
                                . "<td class=\"money\">£ ".$price."</td><td class=\"centred\">".$capacity."</td><td class=\"centred\">".$available."</td>".$button ;
                        } ?>
                    </tbody> 
                </table>
        
        <?php
        }


if ($_SERVER["REQUEST_METHOD"] == "GET") {
//if this page is accessed by the GET method, i.e. through url redirection, which happens when the show all events button is pressed the following code is executed, instead of the POST method above

            $findsql = "SELECT ci.concert_id, pi.performer_name, g.genre, ci.date, vi.venue_name, ci.price, ci.capacity 
                        FROM concert_information ci JOIN performer_information pi ON ci.performer_id = pi.performer_id
                        JOIN genre g ON pi.genre_id = g.genre_id JOIN venue_information vi ON ci.venue_id = vi.venue_id ORDER BY ci.date ASC";

            $result = mysqli_query($connection, $findsql) ;
            ?>

            <table border ="1">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Performer</th>
                        <th>Genre</th>
                        <th>Price</th>
                        <th>Capacity</th>
                        <th>Available Tickets</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                    $performer = $row['performer_name'] ;
                    $genreresult = $row['genre'] ;
                    $date = $row['date'] ;
                    $venue = $row['venue_name'] ;
                    $price = $row['price'] ;
                    $capacity = $row['capacity'] ;
                    $concertid = $row['concert_id'] ;
                    
                    $countsql= "SELECT (ci.capacity-COUNT(t.ticket_no))AS available FROM concert_information ci 
                    JOIN tickets t ON t.concert_id=ci.concert_id WHERE t.concert_id='$concertid' ";
                    
                    $countresult = mysqli_query($connection,$countsql) ;
                    $countrow = mysqli_fetch_array($countresult) ;
                    
                    $available = $countrow['available'] ;
                    if($date < date("Y-m-d h:i:s")) {
                            $button = "<td class=\"noborder\"><a href='hostedFeedback.php?userid=$userid"."&concert_id=$concertid"."&performername=$performer"."&venuename=$venue"."&date=$date'>"
                            . "<button>Show Feedback</button></a></td></tr>" ;
                        }
                        
                        if($date > date("Y-m-d h:i:s")) {
                            $button = "<td><a href='BuyTickets.php?userid=$userid"."&concertid=$concertid"."&performer=$performer"."&date=$date"."&venue=$venue"."&price=$price"."&available=$available'>"
                                . "<button>Buy Tickets</button></a></td></tr>" ;
                        }
                        
                        echo "<tr><td class=\"date\">".$date."</td><td>".$venue."</td><td>".$performer."</td><td>".$genreresult."</td>"
                                . "<td class=\"money\">£ ".$price."</td><td class=\"centred\">".$capacity."</td><td class=\"centred\">".$available."</td>".$button ;
                    } ?>
                </tbody> 
            </table>
        </div>
        <?php
        }        
        
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        
        include 'footer.php';
        ?>
     
    </body>
</html>