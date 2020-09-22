
<?php
//Open a new connection to the MySQL server

include('../config.php');
    
    //Create Connection


mb_internal_encoding("UTF-8");

//Unescape the string values in the JSON array
//$tableData = stripcslashes($_GET['id']);
$tableData = $_POST['id'];
$klantId = $_POST['klantid'];
$transDate = $_POST['date'];
$transTotal = $_POST['sum'];
$transYear = $_POST['year'];
$periode = $_POST['periode'];
$btw = $_POST['btw'];
$omzet = $_POST['omzet'];

$sql = "INSERT INTO btw_per_periode (Periode, Omzet, BTW)
VALUES ('$periode', '$omzet', '$btw')";

if($mysqli->query($sql)===true){
    

$sql2 = "INSERT INTO klantOmzet (klantId, transDate, transTotal, transYear)
VALUES ('$klantId', '$transDate', '$transTotal', '$transYear')";

if($mysqli->query($sql2)===true){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                    Deze transactie werd succesvol toegevoegd
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
}else {
    echo "Error: " .$sql2 . "<br>" . $conn->error;
}
// Decode the JSON array
//$tableData = json_decode($tableData, TRUE);

//echo "-".$tableData[0]."-<br>";
//print_r($tableData);
if (is_array($tableData) || is_object($tableData))
{
foreach ($tableData as $value) {
    
$value = str_replace(",","','",$value);
$value = str_replace("(","('",$value);
$value = str_replace(")","')",$value);

$sql = "INSERT INTO verkopen (KlantID, Datum, Tijd, Behandeling, Prijs, Jaar, soort)
        VALUES $value"; 
    
if (!($mysqli->query($sql)===TRUE) ){
    echo "Error: " .$sql . "<br>" . $conn->error;
} 
    
}
}
}



    
$mysqli->close;
    


?>
