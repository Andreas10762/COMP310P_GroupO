<?php
//function that connects to the MySQL database with the specified credentials
function connect() {
    $dbuser = 'nickyRay';
    $dbpass = '1234';
    $dbname = 'concert_management';
    $dbhost = 'localhost';

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$connection) {
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    
    return $connection;
}

?>