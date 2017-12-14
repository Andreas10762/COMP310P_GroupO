<!DOCTYPE html>
<html>
    <head>
        <title>Curly Boyz Events - My Tickets</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Header.css">
        <link rel="stylesheet" type="text/css" href="Errors.css">
        <link rel="stylesheet" type="text/css" href="body.css">
    </head>
    <body>
        <?php include 'header.php'; ?>
        
        <div id="mytickets">
            <h2>My Tickets</h2>
            <?php

            $userid = $_GET['userid'] ;
            $connection = connect();     

            $emailsql = "SELECT email FROM customer_information WHERE customer_id='$userid'";
            $emailresult = mysqli_query($connection,$emailsql) ;
            $emailrow = mysqli_fetch_array($emailresult) ;
            $email = $emailrow['email'] ;

            $sql = "SELECT t.ticket_no, ci.date,vi.venue_name, pi.performer_name FROM concert_information
                    ci JOIN venue_information vi ON ci.venue_id=vi.venue_id JOIN performer_information
                    pi ON ci.performer_id=pi.performer_id JOIN tickets t ON t.concert_id=ci.concert_id WHERE ci.date >= CURRENT_TIMESTAMP() && t.customer_id='$userid'";

            $result = mysqli_query($connection,$sql) ;
            ?>

            <table border ="1">
                <thead>
                    <tr>
                        <th>Ticket Number</th>
                        <th>Date</th>
                        <th>Venue</th>
                        <th>Performer</th>

                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $date   = $row['date'];
                    $venue = $row['venue_name'];
                    $performer = $row['performer_name'];
                    $ticketno = $row['ticket_no'] ;
                    echo "<tr><td class=\"centred\">$ticketno</td><td class=\"date\">$date</td><td>$venue</td><td>$performer</td><td><a href=\"myticket.php?id=$ticketno&userid=$userid\" target=\"blank\"><button>Download ticket</button></a></td>
                          <td class=\"reminder\">You will receive an email reminder for this event 24 hours before $date on $email</td></tr>";
                    } ?>
                </tbody> 
            </table>                
        </div>

        <?php
        include 'footer.php';
        ?>
     
    </body>
</html>


