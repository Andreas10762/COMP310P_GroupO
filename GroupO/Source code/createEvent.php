<!DOCTYPE html>
<html>
    <head>
        <title>Curly Boyz Events - Create Event</title>
        <meta charset="UTF-8">
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
        $formaction = "createEventSql.php?userid=$userid" ;
        ?>
        
        <div>
            <h2>Create an event</h2>
            <form name="eventinfo" action="<?php echo $formaction ?>" method="post">
                Event Date:  <input type="datetime-local" name="eventdate"><span class="error"> <?php echo $_GET['eventdateErr'];?></span><br/>
                Capacity:  <input type="number" name="capacity" placeholder="0" min="0"><span class="error"> <?php echo $_GET['capacityErr'];?></span><br/>
                Ticket Price:  £<input type="text" name="price" placeholder="0.00"><span class="error"> <?php echo $_GET['priceErr'];?></span><br/>                
                Venue name:  <input type="text" name="venuename"><span class="error"> <?php echo $_GET['venuenameErr'];?></span><br/>
                Venue Address:  <input type="text" name="venueaddress" size="50"><span class="error"> <?php echo $_GET['venueaddressErr'];?></span><br/>
                Contact No:  <input type="text" name="contactno"><span class="error"> <?php echo $_GET['contactnoErr'];?></span><br/>
                Performer Name:  <input type="text" name="performername"><span class="error"> <?php echo $_GET['performernameErr'];?></span><br/>
                Genre:  <select name="genre">
                            <option name="Rock" value="Rock">Rock</option>
                            <option name="Rap" value="Rap">Rap</option>
                            <option name="Jazz" value="Jazz">Jazz</option>
                            <option name="Hip Hop" value="Hip Hop">Hip Hop</option>
                            <option name="Pop" value="Pop">Pop</option>                      
                        </select><span class="error"> <?php echo $_GET['genreErr'];?></span><br/>
                <input type="submit" name="createEvent" value="Create Event!">
            </form>
        </div>
        
        <?php
        include 'footer.php';
        ?>
    </body>
</html>
