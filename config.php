<?php
define('DB_SERVER' , 'exzellence.be.mysql:3306');
define('DB_USERNAME', 'exzellence_be_company');
define('DB_PASSWORD', 'PecXRr03vkcQ!');
define('DB_DATABASE', 'exzellence_be_company');

$mysqli =new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);

}
?>
