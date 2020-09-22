<?php include('config.php');?>
<?php



// function addProduct() {
//     global $mysqli;
//     if(!empty($_POST['productId']) and !empty($_POST['productName']) and !empty($_POST['purchasePrice'])){
//         $prodId = $_POST['productId'];
//         $prodName = $_POST['productName'];
//         $prodBuyPrice = $_POST['purchasePrice'];
//         $prodSalPrice = $prodBuyPrice * 2.21;
//         $prodCat = $_POST['prodCat'];
//         $prodInfo = $_POST['productInfo'];
//         function rndfunc($x){
//             return round($x * 2, 1) / 2;
//         }
        
       
        
//         // Zoek waarde van array (tabelrij)
        
//         $totchr = strlen($prodCat);
        
//         $cat = $prodCat[0];
        
//         $catName = substr($prodCat, 1, $totchr);
        
//         // Selecteer 3e kolom van rij met waarde $key
        
//         $arrCat= $arr_sub_cat[$key][2];
        
//         $prodSalPrice = rndfunc($prodSalPrice);
        
//         // check if Product excists
        
//         $checkq = "SELECT * FROM producten WHERE prodId='$prodId'";
//         $checkr = mysqli_query($mysqli, $checkq);
        
//         // if Product doesn't excists add it
        
//         if(mysqli_num_rows($checkr) === 0){
            
//             $Sales = ( isset($_POST['SaleProd']) ? "Ja" : "Nee" );
            
//             $query = "INSERT INTO producten(prodId, prodName, prodBuyPrice, prodSalPrice, prodInfo, salInfo ) ";
//             $query .= "VALUES ('$prodId', '$prodName', '$prodBuyPrice', '$prodSalPrice', '$catName', '$Sales')";
            
//             $result = mysqli_query($mysqli, $query);
            
//             if(isset($_POST['SaleProd'])){
                
               
//                 $query = "INSERT INTO behandelingen (ser_Id, beh_Naam, beh_Prijs, beh_Info) ";
//                 $query .= "VALUES ('$cat', '$prodName', '$prodSalPrice', '$prodId-$prodName')";
                
//                 $result = mysqli_query($mysqli, $query);
                
//             }
            
//             if(!$result) {
                
//                 die("Error: " .$query . "<br>" . $mysqli->error);
                    
//             }
            
//         } 
        
//         else {
            
//             echo "<p></p><p></p><p></p><p></p><p>Productnummer bestaat reeds</p>";
//         }
    
//     }
    
// }

function addProduct() {
    global $mysqli;
    if(!empty($_POST['productId']) and !empty($_POST['productName']) and !empty($_POST['purchasePrice'])){
        $prodId = $_POST['productId'];
        $prodName = $_POST['productName'];
        $prodBuyPrice = $_POST['purchasePrice'];
        $prodSalPrice = $prodBuyPrice * 2.21;
        $prodCat = $_POST['prodCat'];
        $prodInfo = $_POST['productInfo'];
        function rndfunc($x){
            $n = $x;
            $whole = floor($n);
            $fraction = $n - $whole;
            
            if ($fraction <= .50){
            return $whole + .49;
        } else {
            return $whole + .95;
        }
        }
        
       
        
        // Zoek waarde van array (tabelrij)
        
        $totchr = strlen($prodCat);
        
        $cat = substr($prodCat,0,2);
        
        $colorcode = $prodCat;
        
        // Selecteer 3e kolom van rij met waarde $key
        
        $arrCat= $arr_sub_cat[$key][2];
        
        $prodSalPrice = rndfunc($prodSalPrice);
        
        // check if Product excists
        
        $checkq = "SELECT * FROM producten WHERE prodId='$prodId'";
        $checkr = mysqli_query($mysqli, $checkq);
        
        // if Product doesn't excists add it
        
        if(mysqli_num_rows($checkr) === 0){
            
            $Sales = ( isset($_POST['SaleProd']) ? "Ja" : "Nee" );
            
            $query = "INSERT INTO producten(prodId, SubCatId, prodName, prodBuyPrice, prodSalPrice, prodInfo, salInfo ) ";
            $query .= "VALUES ('$prodId', '$colorcode', '$prodName', '$prodBuyPrice', '$prodSalPrice', '$prodInfo', '$Sales')";
            
            $result = mysqli_query($mysqli, $query);
            
            // if(isset($_POST['SaleProd'])){
                
               
            //     $query = "INSERT INTO  behandelingen (ser_Id, beh_Naam, beh_Prijs, beh_Info) ";
            //     $query .= "VALUES ('$colorcode', '$prodName', '$prodSalPrice', '$prodId-$prodName')";
                
            //     $result = mysqli_query($mysqli, $query);
                
            // }
            
            if(!$result) {
                
                die("Error: " .$query . "<br>" . $mysqli->error);
                    
            }
            
        } 
        
        else {
            
            echo "<p></p><p></p><p></p><p></p><p>Productnummer bestaat reeds</p>";
        }
    
    }
    
}


function addPurchase() {
     global $mysqli;
    

    if(isset($_POST['submit'])){
       
        $datum = $_POST["FactDate"];
        $bedrag = $_POST["FactMvh"];
        $btw = $_POST["FactBtw"];
        $totaal = $bedrag - $btw;
        $omschrijving = $_POST["Omschrijving"];
        $counter = $_POST["counter"];
        
        $type=(isset($_POST["aankooptype"]) ? "F" : "O" );

        // Toevoegen OnkostenNota
        // Checkbox is LEEG

        if( $type === "O" ) {

            //$q_count = "SELECT COUNT(Type) + 1 FROM aankopen where Type= 'O' ";

            //$counter =  (mysqli_query($mysqli, $q_count) + 1);

            $lev = "Algemene Onkosten";


            $query = "INSERT INTO aankopen(Type, Datum, Bedrag, Btw, Totaal, Omschrijving, Leverancier, Referte) ";
            $query .= "Values('$type','$datum','$totaal','$btw','$bedrag','$omschrijving','$lev','$counter')";

            $result = mysqli_query($mysqli, $query); 

            if(!$result){

               die("Toevoegen Factuur gefaald: <br>" .$mysqli->error);
            } else {
                
                header('Location: purchaseAdd.php');
                
            }

        } else {

            // Toeveogen Factuur
            // Checkbox is AANGEVINKT

            $lev = $_POST["LevId"];
            $ref = $_POST["FactNr"];


            $query = "INSERT INTO aankopen(Type, Datum, Bedrag, Btw, Totaal, Omschrijving, Leverancier, Referte) ";
            $query .= "Values('$type','$datum','$totaal','$btw','$bedrag','$omschrijving','$lev','$ref')";

            $result = mysqli_query($mysqli, $query);

            if(!$result){

                die("Toevoegen Onkostennota gefaald: <br>" .$mysqli->error);

            } else {
                
                header('Location: purchaseAdd.php');
            }

        }  
    
        
        
    }   
}


function allPurData(){
    global $mysqli;
    
    $sql = mysqli_query($mysqli, "SELECT * From  aankopen 
                    WHERE DATE_FORMAT(aankopen.Datum, '%Y') = DATE_FORMAT( CURDATE( ) ,  '%Y' ) 
                    ORDER BY Datum ASC");
    
   while($row = mysqli_fetch_array($sql)){
        echo '<tr>
                <td class="d-none">'.$row['Type'].'</td>
                <td>'.$row['Datum'].'</td>
                <td>'.$row['Leverancier'].'</td>
                <td>'.$row['Omschrijving'].'</td>
                <td>'.$row['Totaal'].'</td>
              </tr>'; 
    
}
}


// function selectCat(){
//     global $mysqli;
    
//     $query = "SELECT * FROM subcategory";
//     $result = mysqli_query($mysqli, $query);
    
//     while($row = mysqli_fetch_assoc($result)){
        
//         echo '<option value="'.$row['CatId'].$row['CategorieNaam'].'">'.$row['CategorieNaam'].'</option>';
        
//     }
// }

function selectCat(){
    global $mysqli;
    
    $query = "SELECT product_subcat.ID as subcatnr, product_subcat.subcat_naam as subcatnaam, product_cat.cat_Naam as catnaam, product_cat.ID as catnr FROM `product_subcat` inner join product_cat On product_subcat.CatId = product_cat.ID";
    $result = mysqli_query($mysqli, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        
        echo '<option value="'.$row['subcatnr'].'">'.$row['catnaam'].' - '.$row['subcatnaam'].'</option>';
        
    }
}




function createUser(){
    
    if(isset($_POST['submit'])){
        global $mysqli;
        if(!(empty($_POST['username'])) and !(empty($_POST['password'])) and !(empty($_POST['passwordconf'])) and !(empty($_POST['email']))){
            if($_POST['password'] === $_POST['passwordconf']){
                $username = $_POST['username'];
                $password = $_POST['password'];
                $usermail = $_POST['email'];
                
                
                $username = mysqli_real_escape_string($mysqli, $username);
                $password = mysqli_real_escape_string($mysqli, $password);
                
                
                $hashFormat = "$2y$400$";
                
                $salt = "mijnpapakomteraanblijfnumaarstaan";
                
                $hash_and_salt = $hashFormat . $salt;
                
                $password = crypt($password,$hash_and_salt);
                
                
                
                $query = "INSERT INTO login(username, password, usermail) ";
                $query .= "VALUES ('$username','$password','$usermail')";
                
                $result = mysqli_query($mysqli, $query);
                
                if(!$result) {
                    die('Query failed' . mysqli_error());
                } else {
                    echo "Record Created";
                }
            }
            
        }
    }
    
    
    
    
    
}




function addKlant(){
    
    if (isset($_POST['Voornaam']) && isset($_POST['Achternaam']) && isset($_POST['Telefoon']))  {
        global $mysqli;

// Define $username and $password
    $voornaam = $_POST['Voornaam'];
    $achternaam = $_POST['Achternaam'];
    $email = $_POST['Email'];
    $telefoon = $_POST['Telefoon'];
    $gebdat = $_POST['Geboorte_Datum'];
    $info = $_POST['Info'];
    $creadat = date("Y-m-d");
    
    $result = mysqli_query($mysqli, "select * from klanten where Voornaam='".$voornaam."' AND Achternaam='".$achternaam."'");
    
    
    
        if (mysqli_num_rows($result) === 0 ){
            $sql =  "INSERT INTO klanten (Voornaam, Achternaam, Email, Telefoon, Geboorte_Datum, Datum_Aangemaakt, Info)
                    Values ('".$voornaam."', '".$achternaam."', '".$email."', '".$telefoon."', '".$gebdat."', '".$creadat."', '".$info."')";
            if(mysqli_query($mysqli, $sql))
            {
                echo '<div class="modal fade" id="up_success" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h5 class="modal-title">Klant '.$_POST['voornaam'].' '.$_POST['achternaam'].'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>De gegevens werden opgeslagen</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="up_modal" class="btn btn-success">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
            }
    
            else {
                    die("Error: " .$sql . "<br>" . $mysqli->error);
            }
            
        }
        
        echo '<div class="modal fade" id="up_error" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-danger">
                            <h5 class="modal-title">Klant '.$_POST['voornaam'].' '.$_POST['achternaam'].'</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>De gegevens werden niet opgeslagen<br><br>Deze klant bestaat reeds</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="up_failed" class="btn btn-danger">OK</button>
                        </div>
                    </div>
                </div>
            </div>';
        
    }
    
}



function editKlant() {
        
    if (isset($_POST['voornaam']) && isset($_POST['achternaam']) && isset($_POST['telefoon']))  {
        global $mysqli;

        $sql =  "UPDATE klanten SET ";
        $sql .= "Voornaam ='".$_POST["voornaam"]."', ";
        $sql .= "Achternaam ='".$_POST["achternaam"]."', "; 
        $sql .= "Email ='".$_POST["email"]."', ";
        $sql .= "Telefoon ='".$_POST["telefoon"]."', ";
        $sql .= "Geboorte_Datum ='".$_POST["dob"]."' ";
        $sql .= "WHERE ID= ".$_POST["id"];
        
       
             
        if(mysqli_query($mysqli, $sql))
        {
            echo '<div class="modal fade" id="up_success" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h5 class="modal-title">Update '.$_POST['voornaam'].' '.$_POST['achternaam'].'</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>De gegevens werden opgeslagen</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="up_modal" class="btn btn-success">OK</button>
                                </div>
                            </div>
                        </div>
                    </div>';
        } else {
            
            die("Error: " .$sql . "<br>" . $mysqli->error);
            
        }
    
    }
    
}


function allKlantData() {
    
    global $mysqli;
    
    $sql = mysqli_query($mysqli, "Select * from klanten order by Voornaam ASC");
     
    while($row = mysqli_fetch_array($sql)){
        echo '<tr data-id="'.$row['ID'].'">
                <td class="up_fnaam" data-col="Voornaam" contenteditable="true">'.$row['Voornaam'].'</td>
                <td class="up_lnaam" data-col="Achternaam" >'.$row['Achternaam'].'</td>
                <td class="up_mail" data-col="E-mail" >'.$row['Email'].'</td>
                <td class="up_tel" data-col="Telefoon" >'.$row['Telefoon'].'</td>
                <td class="up_DOB" data-col="Geboorte_Datum" >'.$row['Geboorte_Datum'].'</td>
                <td class="float-right">
                    <a id="edit_row" class="btn-floating btn-sm blue-gradient" data-id="'.$row['ID'].'"><i class="fas fa-pencil-alt"></i></a>
                </td>
              </tr>';
    }
}

function allSalesData(){
    global $mysqli;
    
    $sql = mysqli_query($mysqli, "SELECT CONCAT( klanten.Voornaam,  ' ', klanten.Achternaam ) AS Klant, verkopen.Datum AS Datum, verkopen.Behandeling AS Behandeling, verkopen.Prijs AS Bedrag
                    FROM  `verkopen` 
                    RIGHT JOIN  `klanten` ON verkopen.KlantID = klanten.ID
                    WHERE verkopen.Jaar = DATE_FORMAT( CURDATE( ) ,  '%Y' ) 
                    ORDER BY Datum desc");
    
   while($row = mysqli_fetch_array($sql)){
        echo '<tr>
                <td>'.$row['Klant'].'</td>
                <td>'.$row['Datum'].'</td>
                <td>'.$row['Behandeling'].'</td>
                <td>'.$row['Bedrag'].'</td>
              </tr>'; 
    
}
}

function allClientList() {
    
    global $mysqli;
    $sql =mysqli_query($mysqli, "SELECT ID, CONCAT( Voornaam, ' ', Achternaam ) AS contact FROM  `klanten` GROUP BY 2 ORDER BY contact ASC");
     
    while($row = mysqli_fetch_array($sql)){
        echo '<tr data-id="'.$row['ID'].'" ><td class="contact"><button type="button" id="open_Info" class="btn btn-flat btn-sm"> '.$row['contact'].'</button></td></tr>';
    }
    
}

function allServicesList() {
    global $mysqli;
    //Query
    $query = "Select * , services.ser_Naam as service ";
    $query .= "FROM behandelingen ";
    $query .= "LEFT JOIN services ON services.ser_Id = behandelingen.ser_Id ";
    $query .= "order by services.ser_Id DESC";
    //SQL Statement
    $sql6 = mysqli_query($mysqli, $query);
    //Fetch Data
    while($row6 = mysqli_fetch_array($sql6)){
        echo '<tr>
                <td>'.$row6['service'].'</td>
                <td class="beh_Naam" data-id1='.$row6['beh_Id'].' >'.$row6['beh_Naam'].'</td>
                <td class="beh_Prijs" data-id2='.$row6['beh_Id'].' >'.$row6['beh_Prijs'].'</td>
                <td class="beh_Duur" data-id3='.$row6['beh_Id'].' >'.$row6['beh_Duur'].'</td>
                <td class="float-right">
                    <a id="edit_row" class="btn-floating btn-sm blue-gradient" data-id="'.$row['ID'].'"><i class="fas fa-pencil-alt"></i></a>
                </td>
            </tr>';
    }
    
    
}


function allProductsList() {
    global $mysqli;
    //Query
    $query = "Select * FROM producten ";
    $query .= " Where salInfo = 'Ja'";
    $query .= "order by prodId ASC";
    //SQL Statement
    $sql = mysqli_query($mysqli, $query);
    //Fetch Data
    while($row = mysqli_fetch_array($sql)){
        echo '<tr>
                <td>'.$row['prodId'].'</td>
                <td class="prod_Naam" data-id1='.$row['prodId'].' >'.$row['prodName'].'</td>
                <td class="prod_AP" data-id2='.$row['prodId'].' >€ '.$row['prodBuyPrice'].'</td>
                <td class="prod_VP" data-id3='.$row['prodId'].' >&euro;'.$row['prodSalPrice'].'</td>
                <td class="float-right">
                    <a id="edit_row" class="btn-floating btn-sm blue-gradient" data-id="'.$row['prodId'].'"><i class="fas fa-pencil-alt"></i></a>
                </td>
            </tr>';
    }
    
    
}


function monthMinChart($periode){
    
    global $mysqli;
    if(!isset($_REQUEST['periode'])){
        $periode = date('Y-m');
        
        $sql = mysqli_query($mysqli, "SELECT SUM( Prijs ) AS omzet, DATE_FORMAT( Datum,  '%Y-%m' ) AS periode FROM verkopen WHERE DATE_FORMAT( Datum,  '%Y-%m' ) = '".$periode."' GROUP BY 2");
        $row = mysqli_fetch_assoc($sql); 
        echo '<span class="min-chart" id="chart-mTarget" data-percent="'.floor($row["omzet"]/1000*100).'">';
        echo '<span class="percent"></span>';
        echo '</span>';
        echo '<p class="mb-4">Total sales '.$periode.' :<strong>&euro; '. $row['omzet'].'</strong></p>';
        } else {
        $periode = $_REQUEST['periode'];
        
        $sql = mysqli_query($mysqli, "SELECT SUM( Prijs ) AS omzet, DATE_FORMAT( Datum,  '%Y-%m' ) AS periode FROM verkopen WHERE DATE_FORMAT( Datum,  '%Y-%m' ) = '".$periode."' GROUP BY 2");
        $row = mysqli_fetch_assoc($sql); 
        echo '<span class="min-chart" id="chart-mTarget" data-percent="'.floor($row["omzet"]/1000*100).'">';
        echo '<span class="percent"></span>';
        echo '</span>';
        echo '<p class="mb-4">Total sales '.$periode.' :<strong> &euro; '. $row['omzet'].'</strong></p>';
        }
    
}


function periodSelect() {
    
    $today = new DateTime(date('Y-m-d'));
    $result = $today->format('Y-m-d');
    $thisMonth = date('Y-m');
    $curMonth = strtotime("$result first day of month");
    $prevMonth = strtotime("$curMonth -1 month");
    $twoMonth = strtotime("$curMonth -2 months");
    $threeMonth = strtotime("$curMonth -3 months");
    $fourMonth = strtotime("$curMonth -4 months");
    $fiveMonth = strtotime("$curMonth -5 months");
    
    
    echo '
            <option value="'.$thisMonth.'" selected>'.$thisMonth.'</option>
            <option value="'.date('Y-m', $prevMonth).'">'.date('Y-m', $prevMonth).'</option>
            <option value="'.date('Y-m', $twoMonth).'">'.date('Y-m', $twoMonth).'</option>
            <option value="'.date('Y-m', $threeMonth).'">'.date('Y-m', $threeMonth).'</option>
            <option value="'.date('Y-m', $fourMonth).'">'.date('Y-m', $fourMonth).'</option>
            <option value="'.date('Y-m', $fiveMonth).'">'.date('Y-m', $fiveMonth).'</option>
    ';
}





?>