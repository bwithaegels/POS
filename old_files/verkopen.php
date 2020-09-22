
<?php
//Open a new connection to the MySQL server
//include('session.php');
session_start();

require 'config.php';
    
    //Create Connection


mb_internal_encoding("UTF-8");

//Unescape the string values in the JSON array
//$tableData = stripcslashes($_GET['id']);
$tableData = $_POST['id'];

// Decode the JSON array
//$tableData = json_decode($tableData, TRUE);

echo "-".$tableData[0]."-<br>";
print_r($tableData);
if (is_array($tableData) || is_object($tableData))
{
foreach ($tableData as $value) {
    
$value = str_replace(",","','",$value);
$value = str_replace("(","('",$value);
$value = str_replace(")","')",$value);

$sql = "INSERT INTO verkopen (KlantID, Datum, Tijd, Behandeling, Prijs, Jaar)
        VALUES $value"; 
    
if ($mysqli->query($sql)===TRUE){
    echo "Records succesvol toegevoegd";
} else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}
    
}
}



    
$mysqli->close;
    


?>
