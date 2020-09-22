<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
include('config.php');

session_start();// Starting Session

// Selecting Database

//Function to get Ip address of Client

function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


// Store some stuff...
$_SESSION['ip'] = $ipaddress;
// Storing Session
$user_check = $_SESSION['login_user'];
// SQL Query To Fetch Complete Information Of User
$ses_sql = "select username from login where username='$user_check'";

$result = mysqli_query($mysqli, $ses_sql);

$row = mysqli_fetch_assoc($result);

$login_session = $row['username'];
$_SESSION['login_usr'] = $login_session;

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 25200)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    header('Location: http://pos.exzellence.be/index.php');
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
if(!isset($login_session)){
mysqli_close($mysqli); // Closing Connection
header('Location: http://pos.exzellence.be/index.php'); // Redirecting To Home Page
die();
}

?>