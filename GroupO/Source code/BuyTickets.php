<!DOCTYPE HTML>
<html>
    <head>
        <title>Curly Boyz Events - Buy Tickets</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="Header.css">
        <link rel="stylesheet" type="text/css" href="Errors.css">
        <link rel="stylesheet" type="text/css" href="body.css">
    </head>
    
    <body>
        <?php
        //including the header page (same on every page, will not be commented again)
        include 'header.php'; 
        //getting the variables from the url (same on every page applicable, will not be commented again)
        $userid = $_GET['userid'] ;
        $concertid = $_GET['concertid'] ;
        $performer = $_GET['performer'] ;
        $date = $_GET['date'] ;
        $venue = $_GET['venue'] ;
        $price = $_GET['price'] ;
        $available = $_GET['available'] ;
        ?>
        <div>
            <h2>Buy Tickets</h2>

            <?php
            //string variable with the location the form will be posted to
            $formaction = 'quantityValid.php?userid='.$userid.'&concertid='.$concertid.'&price='.$price.'&available='.$available.'&performer='.$performer.'&date='.$date.'&venue='.$venue ;
            ?>

            <table border ="1">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Price</th>
                            <th>Available Tickets</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td><?php echo $performer?> concert at <?php echo $venue?> on <?php echo $date?></td>
                            <td>£<?php echo $price?></td>
                            <td class="centred"><?php echo $available?></td>
                            <td id='buy'>
                                <form method="post" action="<?php echo $formaction ?>">
                                    <input type="number" name="quantity" id="quantity">
                                    </td><input id='proceed' type="submit" name="proceed" value="Proceed to Payment">
                                </form>
                        </tr>
                    </tbody> 
                </table>
            <span class="error"> <?php echo $_GET['quantityErr'];?></span>
        </div>
        
        <?php        
        include 'footer.php';
        ?>

    </body>
</html>