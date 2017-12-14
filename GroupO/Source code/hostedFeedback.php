<html>
    <head>
        <title>Curly Boyz Events - Feedback</title>
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
        $performer = $_GET['performername'] ;
        $venue = $_GET['venuename'] ;
        $date = $_GET['date'] ;
        ?>
        
        <div>
            <h2>Feedbacks for <?php echo $performer?> concert at <?php echo $venue?> on <?php echo $date?> </h2>

            <?php        
            $connection = connect(); 

            $feedbackhosted = "SELECT pi.performer_name, f.feedback, f.rating FROM performer_information pi 
                               JOIN concert_information ci ON pi.performer_id=ci.performer_id JOIN feedback f ON 
                               ci.concert_id=f.concert_id WHERE ci.concert_id='$concertid'";
            $feedbackhostedresult = mysqli_query($connection,$feedbackhosted) ; ?>
            <table border="1" class="fullwidth">
                  <thead>
                        <tr>
                          <th>Performer Name</th>
                          <th>Feedback</th>
                          <th>Rating</th>
                        </tr>
                  </thead>
                  
                  <tbody>
                      <?php
                        while ($row = mysqli_fetch_array($feedbackhostedresult, MYSQLI_ASSOC)) {
                            $performer   = $row['performer_name'];
                            $feedback = $row['feedback'];
                            $rating = $row['rating'];

                            echo "<tr><td>".$performer."</td><td>".$feedback."</td><td class=\"centred\">".$rating."/5</td></tr>";
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
    


