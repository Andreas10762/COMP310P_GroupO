<html>
    <head>
        <title>Curly Boyz Events - Participants</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Header.css">
        <link rel="stylesheet" type="text/css" href="Errors.css">
        <link rel="stylesheet" type="text/css" href="body.css">
    </head>
    
    <body>
        <?php include 'header.php';
        $userid = $_GET['userid'] ;
        $concertid = $_GET['concert_id'] ;
        $date = $_GET['date'] ;
        $venue = $_GET['venue'] ;
        $performer = $_GET['performer'] ;
        ?>
        
        <div>
            <h2>Participants of <?php echo $performer?> concert at <?php echo $venue?> on <?php echo $date?> </h2>

            <?php        
            $connection = connect(); 

            $participants = "SELECT DISTINCT t.customer_id, ci.first_name, ci.last_name FROM tickets t JOIN customer_information ci ON t.customer_id = ci.customer_id WHERE t.concert_id = '$concertid'";
            $participantsresult = mysqli_query($connection,$participants) ; ?>
            <table border="1" class="fullwidth">
                  <thead>
                        <tr>
                          <th>First Name</th>
                          <th>Last Name</th>
                          <th>Tickets bought</th>
                        </tr>
                  </thead>
                  
                  <tbody>
                      <?php
                        while ($row = mysqli_fetch_array($participantsresult, MYSQLI_ASSOC)) {
                            $firstname   = $row['first_name'];
                            $lastname = $row['last_name'];
                            $customer = $row['customer_id'];
                            
                            $ticketssql = "SELECT COUNT(ticket_no) AS ticketsbought FROM tickets WHERE customer_id = '$customer' AND concert_id = '$concertid'";
                            $ticketsresult = mysqli_query($connection,$ticketssql) ;
                            $ticketsrow = mysqli_fetch_array($ticketsresult) ;
                            $tickets = $ticketsrow['ticketsbought'] ;

                            echo "<tr><td>".$firstname."</td><td>".$lastname."</td><td class=\"centred\">".$tickets."</td></tr>";
                        } 
                        ?>
                  </tbody> 
            </table>
        </div>
        
        <?php
        include 'footer.php';
        mysqli_close($connection);?>
    </body>
</html>
    


