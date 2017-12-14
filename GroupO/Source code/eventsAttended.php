<!DOCTYPE html>
<html>
    <head>
        <title>Curly Boyz Events - Events Attended</title>
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
            <h2>Events Attended</h2>
            <?php
            $userid = $_GET['userid'] ;
            $connection = connect();     

            $sql = "SELECT DISTINCT ci.date,vi.venue_name, ci.concert_id, pi.performer_name FROM concert_information
                    ci JOIN venue_information vi ON ci.venue_id=vi.venue_id JOIN performer_information
                    pi ON ci.performer_id=pi.performer_id JOIN tickets t ON t.concert_id=ci.concert_id WHERE ci.date <= CURRENT_TIMESTAMP() && t.customer_id='$userid'";

            $result = mysqli_query($connection,$sql) ;
            ?>

            <table border="1" class="norightborder">
                <thead>
                    <tr>
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
                        $concertid = $row['concert_id'];

                        $feedbacksql = "SELECT f.feedback_id FROM concert_information ci JOIN feedback f ON ci.concert_id = f.concert_id
                                        WHERE f.concert_id ='$concertid' AND f.customer_id='$userid'";

                        $feedbackresult = mysqli_query($connection,$feedbacksql) ;
                        $feedbackrow = mysqli_fetch_array($feedbackresult) ;
                        $feedback = $feedbackrow['feedback_id'];
                        if ($feedback != "") {
                            echo "<tr><td>".$date."</td><td>".$venue."</td><td>".$performer."</td><td>Feedback already submitted for this event</td></tr>";                  
                        } else {
                            echo "<tr><td class=\"date\">".$date."</td><td>".$venue."</td><td>".$performer."</td><td class=\"centred\">
                                  <a href='feedback.php?userid=$userid"."&concertid=$concertid"."&performername=$performer"."&venuename=$venue"."&date=$date'>
                                  <button>Feedback</button></a></td></tr>";                
                        }
                    }
                    ?>
                </tbody>
              </table>
        </div>
        
        <?php
        include 'footer.php';
        ?>
     
        <script>
            //function to create alert when feedback is submitted (would not work as external JS because of the PHP variable)
            (function() {
            var sent = <?php echo $_GET['sent'];?> ;
            if (sent == 1) {
                alert("Feedback submitted successfully!") ;
            }
            })();
        </script>
      </body>
    </html>


