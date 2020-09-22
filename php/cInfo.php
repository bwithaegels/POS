
<?php
//Open a new connection to the MySQL server
//include('../session.php');


include('../config.php');
    
    //Create Connection


mb_internal_encoding("UTF-8");

//Unescape the string values in the JSON array
//$tableData = stripcslashes($_GET['id']);
$id = $_POST['id'];

// Decode the JSON array
//$tableData = json_decode($tableData, TRUE);

//echo "-".$tableData[0]."-<br>";
//print_r($tableData);

$sql = mysqli_query($mysqli, "Select * from klanten where ID = '".$id."'");
    
/*if ($sql===TRUE){*/
    while($row=mysqli_fetch_array($sql)){
        echo '  <div class="col-3">
                    <label for="cEmail">Email</label>
                    <input type="email" id="cEmail" class="form-control" placeholder="mailadres" value="'.$row['Email'].'">
                </div>
                <div class="col-3">
                    <label for="cPhone">Telefoon</label>
                    <input type="tel" id="cPhone" class="form-control" placeholder="Telefoonnummer" value="'.$row['Telefoon'].'">
                </div>
                <div class="col-3">
                    <label for="cDoB">Geboorte Datum</label>
                    <input type="date" id="cDoB" class="form-control" placeholder="Geboorte datum" value="'.$row['Geboorte_Datum'].'">
                </div>
                <div class="col-1">     
                </div>
                <div class="col-2 text-center d-flex">
                    <button class="btn btn-lg btn-warning">Update</button>
                </div>';
        
    }
/*} else {
    echo "Error: " .$sql . "<br>" . $conn->error;
}*/
    
$mysqli->close;
    


?>
