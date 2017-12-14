<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Header.css">
        <link rel="stylesheet" type="text/css" href="Errors.css">
        <link rel="stylesheet" type="text/css" href="body.css">
        <title>Curly Boyz Events - Events Hosted</title>
    </head>
    
    <body>
        <?php include 'header.php';?>
        
        <div>
            <h2>Events Hosted</h2>

            <?php
            $userid = $_GET['userid'] ;

            //connecting to the database, the connect.php page is required in the header (same on every page that connects to the database, will not be commented again)
            $connection = connect();     

            //sql query string to find the events hosted (similar on every page with an sql query, will not be commented again)
            $sql1 = "SELECT ci.date,vi.venue_name, pi.performer_name, ci.concert_id FROM concert_information ci
                    JOIN venue_information vi ON ci.venue_id=vi.venue_id JOIN performer_information pi
                    ON ci.performer_id=pi.performer_id WHERE ci.host_id= '$userid' AND ci.date <= CURRENT_TIMESTAMP()" ;

            //sql result (similar on every page with an sql query, will not be commented again)
            $result1 = mysqli_query($connection,$sql1) ;


            ?>

            <table border="1" class="norightborder">  
                <thead>
                    <tr>
                      <th>Date</th>
                      <th>Venue</th>
                      <th>Performer</th>
                      <th>Tickets Sold</th>
                      <th>Tickets Remained</th>
                      <th>Income</th>
                      <th>Overall Rating</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    //while loop to iterate through all the rows in the sql query result and create a table (similar on every page that has this iteration, will not be commented again)
                    while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                    $date   = $row1['date'];
                    $venue = $row1['venue_name'];
                    $performer = $row1['performer_name'];
                    $concertid = $row1['concert_id'];

                    $sql2= "SELECT COUNT(t.ticket_no), (ci.capacity-COUNT(t.ticket_no))AS ticketsLeft , 
                            (COUNT(t.ticket_no)*ci.price) AS income FROM concert_information ci 
                            JOIN tickets t ON t.concert_id=ci.concert_id WHERE t.concert_id='$concertid' ";
                    $result2 = mysqli_query($connection,$sql2) ;
                    $row2 = mysqli_fetch_array($result2) ;

                    $ticketsSold = $row2['COUNT(t.ticket_no)'];
                    $ticketsLeft = $row2['ticketsLeft'];
                    $income = $row2['income'];

                    $sql3= "SELECT AVG(f.rating)  FROM concert_information ci 
                            JOIN feedback f ON ci.concert_id=f.concert_id 
                            WHERE f.concert_id='$concertid'";
                    $result3 = mysqli_query($connection,$sql3) ;
                    $row3 = mysqli_fetch_array($result3) ;

                    $rating = (int)$row3['AVG(f.rating)'];

                    echo "<tr><td class=\"date\">".$date."</td><td>".$venue."</td><td>".$performer."</td><td class=\"centred\">"
                            .$ticketsSold."</td><td class=\"centred\">".$ticketsLeft."</td><td class=\"money\">£ ".$income.
                            "</td><td class=\"centred\">".$rating."/5</td><td class=\"noborder\"><a href='hostedFeedback.php?userid=$userid"."&concert_id=$concertid"."&performername=$performer"."&venuename=$venue"."&date=$date'>"
                            . "<button>Show Feedback</button></a></td></tr>";

                    } ?>   
                </tbody>
            </table>
        </div>
                
            <?php
            include 'footer.php';
            ?>
     
    </body>
</html>
