<!DOCTYPE html>
<html>
    <head>
        <title>Curly Boyz Events - Events Hosting</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Header.css">
        <link rel="stylesheet" type="text/css" href="Errors.css">
        <link rel="stylesheet" type="text/css" href="body.css">
    </head>
    
    <body>
        <?php include 'header.php';?>
        
        <div>
            <h2>Events Hosting</h2>

            <?php
            $userid = $_GET['userid'] ;
            $connection = connect();     

            $sql1 = "SELECT ci.date,vi.venue_name, pi.performer_name, ci.concert_id FROM concert_information ci
                    JOIN venue_information vi ON ci.venue_id=vi.venue_id JOIN performer_information pi
                    ON ci.performer_id=pi.performer_id WHERE ci.host_id= '$userid' AND ci.date >= CURRENT_TIMESTAMP()" ;

            $result1 = mysqli_query($connection,$sql1) ;


            ?>

            <table border="1">  
                <thead>
                    <tr>
                      <th>Date</th>
                      <th>Venue</th>
                      <th>Performer</th>
                      <th>Tickets Sold</th>
                      <th>Tickets Left</th>
                      <th>Income</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
                    $date   = $row1['date'];
                    $venue = $row1['venue_name'];
                    $performer = $row1['performer_name'];
                    $concert_id = $row1['concert_id'];

                    $sql2= "SELECT COUNT(t.ticket_no), (ci.capacity-COUNT(t.ticket_no))AS ticketsLeft , 
                            (COUNT(t.ticket_no)*ci.price) AS income FROM concert_information ci 
                            JOIN tickets t ON t.concert_id=ci.concert_id WHERE t.concert_id='$concert_id' ";
                    $result2 = mysqli_query($connection,$sql2) ;
                    $row2 = mysqli_fetch_array($result2) ;

                    $ticketsSold = $row2['COUNT(t.ticket_no)'];
                    $ticketsLeft = $row2['ticketsLeft'];
                    $income = $row2['income'];
                    echo "<tr><td class=\"date\">".$date."</td><td>".$venue."</td><td>".$performer."</td><td class=\"centred\">".$ticketsSold."</td><td class=\"centred\">".$ticketsLeft."</td><td class=\"money\">£ ".$income."</td>"
                            . "<td><a href='participants.php?userid=$userid"."&concert_id=$concert_id"."&performer=$performer"."&venue=$venue"."&date=$date'><button>Participants</button></a></td></tr>";
                    } ?>   
                </tbody>
            </table>
        </div>   
            <?php
            include 'footer.php';
            ?>
     
    </body>
</html>
