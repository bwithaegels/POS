<?php

session_start();

require "../config.php";

/*
   This if block here detects if the request is sent through AJAX,
   it's not necessary but use this if you want to prevent direct access
   to this PHP file and allow it ONLY through AJAX.
*/
if ( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' )
{

mb_internal_encoding("UTF-8");
$output = '';
$output2 = '';
$id = $_POST['id'];
$year = date("y");

if (isset($_POST['id']))
{
    if (!$_POST['id'] = '')
    {
        $sql = mysqli_query($mysqli, "Select * from verkopen where KlantID='$id' order by Datum DESC Limit 10");
        $sql2 = mysqli_query($mysqli, "SELECT COUNT(Id) from verkopen WHERE KlantID='$id'");
        $sql3 = mysqli_query($mysqli, "SELECT SUM(transTotal) FROM klantOmzet WHERE klantId='$id'");
        if((!$sql) || (!$sql2)) {
            printf("Error: %s\n", mysqli_error($mysqli));
            exit();
        }
        $output2 = mysqli_fetch_assoc($sql2);
        $output = mysqli_fetch_assoc($sql3);
        
        echo '<div class="form-row cSalInfo my-5">';
        echo    '<div class="col-6 text-center"> <h4>Totaal aantal transacties: <span class="tot-trans">' .$output2['COUNT(Id)'].'</span></h4></div>';
        echo    '<div class="col-6 text-center"> <h4>Totale omzet voor '.date("Y").' bedraagt: <span class="tot-omzet">€ '.$output['SUM(transTotal)'].'</span></h4></div>';
        echo '</div>';
        echo '<div class="form-row mt-5">';
        echo    '<div class="col-1"></div>';
        echo    '<div class="col-10">';
        echo        '<table id="cSalHist" class="table table-hover table-sm">';
        echo            '<thead class="thead-dark">';
        echo                '<tr>';
        echo                    '<th scope="col">Datum</th>';
        echo                    '<th scope="col">Behandeling</th>';
        echo                    '<th scope="col">Prijs</th>';
        echo                '</tr>';
        echo            '</thead>';
        echo            '<tbody class="cSalHist">';

        while($row = mysqli_fetch_array($sql))
        {
        echo                '<tr>';
        echo                    '<td>' . $row['Datum'] . '</td>';
        echo                    '<td>' . $row['Behandeling'] . '</td>';
        echo                    '<td>' . $row['Prijs'] . '</td>';
        echo                '</tr>';
        }
        echo            '</tbody>';                
        echo        '</table>';
        echo    '</div>';
        echo    '<div class="col-1"></div>';
        echo '</div>';
        
    }

}


}

mysqli_close($mysqli);
?>