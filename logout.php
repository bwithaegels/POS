<?php
session_start();
session_destroy();

if( isset($_COOKIE["user"]) AND isset($_COOKIE["ip"])){
    unset($_cookie["user"]);
    unset($_cookie["ip"]);
}

header('Location:index.php'); 

?>