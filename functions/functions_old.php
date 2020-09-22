<?php include('config.php');?>
<?php



function addProduct() {
    global $mysqli;
    if(! empty($_POST['prodId']) and ! empty($_POST['prodName']) and !empty($_POST['purchasePrice'])){
        $prodId = $_POST['prodId'];
        $prodName = $_POST['prodName'];
        $prodBuyPrice = $_POST['purchasePrice'];
        $prodSalPrice = $_POST['salesPrice'];
        $saleprod = $_POST['SaleProd'];
        $prodInfo = $_POST['productInfo'];
        $prodTime = "00:01:00";
        
        
        // check if Product excists
        
        $checkq = "SELECT * FROM producten WHERE prodId='$prodId'";
        $checkr = mysqli_query($mysqli, $checkq);
        
        // if Product doesn't excists add it
        
        if(mysqli_num_rows($checkr) === 0){
            
            
            
            $query = "INSERT INTO producten(prodId, prodName, prodBuyPrice, prodSalPrice, prodInfo) ";
            $query .= "VALUES ('$prodId', '$prodName', $prodBuyPrice, $prodSalPrice, '$prodInfo')";
            
            $result = mysqli_query($mysqli, $query);
            
            if(isset($saleprod) and !empty($prodSalPrice)){
                
               
                $query = "INSERT INTO behandelingen (ser_Id, beh_Naam, beh_Prijs, beh_Duur, beh_Info) ";
                $query .= "VALUES (7, '$prodId', '$prodSalPrice', '$prodTime' , '$prodId-$prodName')";
                
                $result = mysqli_query($mysqli, $query);
                
            }
            if($result){
                
                echo '<div class="modal fade" id="ap_success" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-success">
                                        <h5 class="modal-title">Product '.$prodId.' '.$prodName.'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Product Toegevoegd</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="ap_modal" class="btn btn-success">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
                
            }
            
            if(!$result) {
                
                die("Error: " .$query . "<br>" . $mysqli->error);
                    
            }
            
        } 
        
        else {
            
            echo '<div class="modal fade" id="ap_alert" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-alert">
                                        <h5 class="modal-title">Product '.$prodID.' - '.$prodName.'</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Dit product werd reeds eerder toegevoegd! Gelieve een ander productcode te gebruiken</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" id="ap_alertmodal" class="btn btn-alert">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>';
        }
    
    }
    
}





function selectCat(){
    global $mysqli;
    
    $query = "SELECT * FROM productCat";
    $result = mysqli_query($mysqli, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        
        echo '<div class="form-check form-check-inline">
                    <input type="radio" class="form-check-input" id="'.$row['Category'].'" data-id="'.$row['catID'].'" name="CategorySelect">
                    <label class="form-check-label" for="'.$row['Category'].'">'.$row['Category'].'</label>
                </div>';
        
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
    
    if (isset($_POST['voornaam']) && isset($_POST['achternaam']))  {
        global $mysqli;

// Define $username and $password
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];
    $telefoon = $_POST['telefoon'];
    $gebdat = $_POST['geboorte_datum'];
    $info = $_POST['info'];
    $creatdat = date("Y-m-d");
    
    $result = mysqli_query($mysqli, "select * from klanten where Voornaam='".$voornaam."' AND Achternaam='".$achternaam."'");
    
    
    
        if (mysqli_num_rows($result) === 0 ){
            $sql =  "INSERT INTO klanten (Voornaam, Achternaam, Email, Telefoon, Geboorte_Datum, Datum_Aangemaakt, Info)
                    Values ('".$voornaam."', '".$achternaam."', '".$email."', '".$telefoon."', '".$gebdat."', '".$creatdat."', '".$info."')";
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
        
    if (isset($_POST['voornaam']) && isset($_POST['achternaam']))  {
        global $mysqli;
        
        $id = $_POST['id'];
        $voornaam = $_POST['voornaam'];
        $achternaam = $_POST['achternaam'];
        $email = $_POST['email'];
        $telefoon = $_POST['telefoon'];
        $gebdat = $_POST['dob'];

        $sql =  "UPDATE klanten SET ";
        $sql .= "Voornaam ='".$voornaam."', ";
        $sql .= "Achternaam ='".$achternaam."', "; 
        $sql .= "Email ='".$email."', ";
        $sql .= "Telefoon ='".$telefoon."', ";
        $sql .= "Geboorte_Datum ='".$gebdat."' ";
        $sql .= "WHERE ID = ".$id;
        
       
             
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

function allProductData() {
    
    global $mysqli;
    
    $sql = mysqli_query($mysqli, "Select * from producten order by prodId ASC");
     
    while($row = mysqli_fetch_array($sql)){
        echo '<tr data-id="'.$row['prodId'].'">
                <td class="up_prodid" data-col="ProductId" contenteditable="true">'.$row['prodId'].'</td>
                <td class="up_prodname" data-col="ProductNaam" >'.$row['prodName'].'</td>
                <td class="up_prodBP" data-col="Aankoopprijs" >'.$row['prodBuyPrice'].'</td>
                <td class="up_prodSP" data-col="Verkoopprijs" >'.$row['prodSalPrice'].'</td>
                <td class="up_prodInfo" data-col="ProductInfo" >'.$row['prodInfo'].'</td>
                <td class="float-right">
                    <a id="edit_row" class="btn-floating btn-sm blue-gradient" data-id="'.$row['prodId'].'"><i class="fas fa-pencil-alt"></i></a>
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
                    ORDER BY Datum ASC");
    
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