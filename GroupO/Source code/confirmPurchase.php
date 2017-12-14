<!DOCTYPE HTML>
<html>
    <head>
        <title>Curly Boyz Events - Confirm Purchase</title>
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
        $concertid = $_GET['concertid'] ;
        $quantity = $_GET['quantity'] ;
        $price = $_GET['price'] ;
        $totalprice = $price * $quantity ;
        $formaction = 'payment.php?userid='.$userid.'&concertid='.$concertid.'&quantity='.$quantity.'&price='.$price ;
        ?>
        
        <div>
            <h2>Total amount to pay: £<?php echo number_format((float)$totalprice, 2, '.', '')?></h2>

            <h3>Enter your card details and confirm payment</h3>

            <form method="post" action="<?php echo $formaction ?>">
                Card Number: <input type="text" name="cardno"><span class="error"> <?php echo $_GET['cardnoErr'];?></span><br/>
                CVV2: <input type="text" name="cvv"><span class="error"> <?php echo $_GET['cvvErr'];?></span><br/>
                <input type="submit" value="Pay">
            </form>
        </div>
        
        <?php
        include 'footer.php';
        ?>     
        
    </body>
</html>

