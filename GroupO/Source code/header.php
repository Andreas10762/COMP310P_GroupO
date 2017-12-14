<header>
            <?php
            //header that is included in all pages
            
            //requires the connect.php to connect to the database
            require'connect.php';
            $connection = connect();
            $userid = $_GET['userid'] ;
            $select = "SELECT first_name, last_name FROM customer_information WHERE customer_id='$userid'";
            $result = mysqli_query($connection,$select) ;
            $row = mysqli_fetch_array($result);
            $name = $row['first_name'] ;
            $surname = $row['last_name'] ;
            mysqli_free_result($result);
            mysqli_close($connection);
            ?>
            <p class="loggedinas">Logged in as <?php echo "$name $surname" ?> 
                <a href="index.php">Log Out</a>
            </p>
            
            <h1 class="company">Curly Boyz Events</h1>
            
            <?php
            $homeurl = "Home.php?userid=$userid" ;
            $findeventsurl = "findEvents.php?userid=$userid" ;
            $createeventurl = "createEvent.php?userid=$userid" ;
            $eventsattendingurl = "attendingEvents.php?userid=$userid" ;
            $eventshostingurl = "EventsHosting.php?userid=$userid" ;
            $eventshostedurl = "EventsHosted.php?userid=$userid" ;
            $eventsAttendedurl = "eventsAttended.php?userid=$userid" ;
            ?>
            
            <ul>
                <li><a href="<?php echo $homeurl ?>">Home</a></li>
                <li><a href="<?php echo $findeventsurl ?>">Find Events</a></li>
                <li><a href="<?php echo $createeventurl ?>">Create Event</a></li>
                <li><a href="<?php echo $eventsattendingurl ?>">My Tickets</a></li>
                <li><a href="<?php echo $eventshostingurl ?>">Events Hosting</a></li>
                <li><a href="<?php echo $eventshostedurl ?>">Events Hosted</a></li>
                <li><a href="<?php echo $eventsAttendedurl ?>">Events Attended</a></li>
            </ul>
            
            
</header>