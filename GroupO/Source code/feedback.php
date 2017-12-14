<html>
    <head>
        <meta charset="UTF-8">
        <title>Curly Boyz Events - Leave Feedback</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Header.css">
        <link rel="stylesheet" type="text/css" href="Errors.css">
        <link rel="stylesheet" type="text/css" href="body.css">
    </head>
    <body>
        <?php
        include 'header.php';
        $userid = $_GET['userid'] ;
        $concertid = $_GET['concertid'] ;
        $performer = $_GET['performername'] ;
        $venue = $_GET['venuename'] ;
        $date = $_GET['date'] ;
        $feedbacksent = "feedbacksent.php?userid=$userid"."&concertid=$concertid" ;
        ?>
        <div>
            <h2>Feedback for <?php echo $performer?> concert at <?php echo $venue?> on <?php echo $date?> </h2>
            
            <form name="feedbackform" action="<?php echo $feedbacksent ?>" method="post">
                Feedback: <br><textarea name='feedback' cols='20' rows="5" placeholder="Write your feedback here"></textarea><br/>
                Overall Rating: <br/>
                    <input type="radio" name="rating" value="1"> 1 Star<br>
                    <input type="radio" name="rating" value="2"> 2 Star<br>
                    <input type="radio" name="rating" value="3"> 3 Star<br>
                    <input type="radio" name="rating" value="4"> 4 Star<br>
                    <input type="radio" name="rating" value="5"> 5 Star<br>
                    <input type="submit">
            </form>
        </div>
        <?php
        include 'footer.php';
        ?>

    </body>
</html>

