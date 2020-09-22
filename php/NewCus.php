<?php

session_start();

include ('../config.php');


mb_internal_encoding("UTF-8");
//$error=''; // Variable To Store Error Message
//echo "Connected!!!";


if (isset($_POST['cFirstName']) && isset($_POST['cLastName']) && isset($_POST['cPhone']))  {
    
    $voornaam = $_POST['cFirstName'];
    $achternaam = $_POST['cLastName'];
    $email = $_POST['cEmail'];
    $telefoon = $_POST['cPhone'];
    $gebdat = $_POST['cDoB'];
    //$info = $_POST[Info];
    
    $result = mysqli_query($mysqli, "select * from klanten where Voornaam='".$voornaam."' AND Achternaam='".$achternaam."'");
    
    
    
        if (mysqli_num_rows($result) === 0 ){
            $sql =  "INSERT INTO klanten (Voornaam, Achternaam, Email, Telefoon, Geboorte_Datum, Datum_Aangemaakt)
                    Values ('".$voornaam."', '".$achternaam."', '".$email."', '".$telefoon."', '".$gebdat."', '".date("Y-m-d")."')";
            if(mysqli_query($mysqli, $sql))
            {
               header('location: ../pos.php');
            }
    
            else {
                    die("Error: " .$sql . "<br>" . $mysqli->error);
                    header("Location: ..pos/php");
            }
        }
        else {
            header("Location: ../pos.php");
        }
    
    }
        

    
$mysqli->close;




?>