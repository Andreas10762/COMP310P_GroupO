<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Header.css">
        <link rel="stylesheet" type="text/css" href="Errors.css">
        <link rel="stylesheet" type="text/css" href="body.css">
        <title>Curly Boyz Events - Home</title>
    </head>
    <body>
        <?php
        include 'header.php';
        $userid = $_GET['userid'] ;
        $findeventsurl = "findEvents.php?userid=$userid" ;
        $createeventurl = "createEvent.php?userid=$userid" ;
        $eventsattendingurl = "attendingEvents.php?userid=$userid" ;
        $eventshostingurl = "EventsHosting.php?userid=$userid" ;
        $eventshostedurl = "EventsHosted.php?userid=$userid" ;
        $eventsAttendedurl = "eventsAttended.php?userid=$userid" ;
        ?>
        
            <div>
                <h2>Home</h2>
                <a href="<?php echo $findeventsurl ?>"><button name="findEvents" id="findEvents" value="Find Events">Find Events</button></a>
                <a class="host" href="<?php echo $createeventurl ?>"><button name="createEvent" id="createEvent" value="Create Event">Create Event</button></a><br><br>
                <a href="<?php echo $eventsattendingurl ?>"><button name="EventsAtt" id="EventsAtt" value="EventsAtt">My Tickets</button></a>
                <a class="host" href="<?php echo $eventshostingurl ?>"><button name="EventsHosting" id="EventsHosting" value="EventsHosting">Events Hosting</button></a><br><br>
                <a href="<?php echo $eventsAttendedurl ?>"><button name="eventsAttended" id="eventsAttended" value="eventsAttended">Events Attended</button></a>
                <a class="host" href="<?php echo $eventshostedurl ?>"><button name="EventsHosted" id="EventsHosted" value="EventsHosted">Events Hosted</button></a><br><br>
            </div>
        
        <script>
            //function to create alert when an event is created (would not work as external JS because of the PHP variables)
            (function() {
                var created = <?php echo $_GET['created'];?> ;
                if (created == 1) {
                    alert("Event created!") ;
                }
            })();
        </script>
        
        <script>
            //function to create alert when tickets are purchased (would not work as external JS because of the PHP variables)
            (function() {
                var purchased = <?php echo $_GET['purchased'];?> ;
                if (purchased == 1) {
                    alert("Tickets purchased!") ;
                }
            })();
        </script>
    </body>
</html>

<?php
include 'footer.php';
?>