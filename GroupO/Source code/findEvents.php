<!DOCTYPE html>
<html>
    <head>
        <title>Curly Boyz Events - Find Event</title>
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
        $formaction = "eventlist.php?userid=$userid" ;
        $alleventsurl = "eventlist.php?userid=$userid" ;
        ?>

        <div>
            <h2>Find events</h2>
            <p><a href="<?php echo $alleventsurl ?>"><button name="allEvents" id="allEvents" value="All Events">Show all events</button></a> OR enter search terms below:</p>
            
            <form name="eventsearch" action="<?php echo $formaction ?>" method="post">
                Performer:  <input type="text" name="performer" placeholder="Performer"> OR 
                Genre:  <select name="genre">
                            <option value="" name=""></option>
                            <option value="Rock" name="Rock">Rock</option>
                            <option value="Pop" name="Pop">Pop</option>
                            <option value="Hip Hop" name="Hip Hop">Hip Hop</option>
                            <option value="Jazz" name="Jazz">Jazz</option>
                            <option value="Rap" name="Rap">Rap</option>
                        </select><br/><span class="error"> <?php echo $_GET['genreErr'];?></span><br/>
                Date from:  <input type="date" name="dateFrom"><span class="error"> <?php echo $_GET['dateFromErr'];?></span> Date to:  <input type="date" name="dateTo"><br/><span class="error"> <?php echo $_GET['dateToErr'];?></span><br/>
                Price Range:  £<input type="text" name="pricelow" placeholder="0.00" pattern="^([0-9]+)((\.[0-9]{2,2})?)$" title="0.00">to £<input type="text" name="pricehigh" placeholder="0.00" pattern="^([0-9]+)((\.[0-9]{2,2})?)$" title="0.00"><br/>
                Sort by:  <select  name="sort">
                            <option value="lowprice">Price - low to high</option>
                            <option value="highprice">Price - high to low</option>
                            <option value="performer">Performer's name</option>
                            <option value="date">Date</option>
                          </select><br/>
                <input type=submit name='search' value='Search'>
            </form>
        </div>
        
        <?php
        include 'footer.php';
        ?>
        
    </body>
</html>
