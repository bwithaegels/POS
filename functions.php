<?php include('config.php');?>
<?php


// Log me In

function login() {
    global $mysqli;
    //session_start(); // Starting Session
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
            
             // Define $username and $password
            $username = mysqli_real_escape_string($mysqli, $username);
            $password = mysqli_real_escape_string($mysqli, $password);
            

            
             //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            // //Get Ip adress from User
            function get_client_ip() {
                $ipaddress = '';
                if (getenv('HTTP_CLIENT_IP'))
                    $ipaddress = getenv('HTTP_CLIENT_IP');
                else if(getenv('HTTP_X_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
                else if(getenv('HTTP_X_FORWARDED'))
                    $ipaddress = getenv('HTTP_X_FORWARDED');
                else if(getenv('HTTP_FORWARDED_FOR'))
                    $ipaddress = getenv('HTTP_FORWARDED_FOR');
                else if(getenv('HTTP_FORWARDED'))
                  $ipaddress = getenv('HTTP_FORWARDED');
                else if(getenv('REMOTE_ADDR'))
                    $ipaddress = getenv('REMOTE_ADDR');
                else
                    $ipaddress = 'UNKNOWN';
                return $ipaddress;
            }
            
            //$passw = password_verify($password, $hashed_password);
            
            // SQL query to fetch information of registerd users and finds user match.
            $query =mysqli_query($mysqli, "select * from `login` where username='$username' and password='$password'");
            
            $count = mysqli_num_rows($query);
            
            $ip = get_client_ip();
            
            // Als wachtwoord en/of gebruikersnaam niet juist is
            if ($count == 1 ){
                session_register("username");
                $_SESSION['login_user'] = $username.'@'.$ip;
                header('location:dashboard.php');
            }
            // Indien deze wel juist zijn
            
            else{
                $error = "De Gebruikersnaam of Paswoord is onjuist";
                
                // // wanneer remember-me werd aangevinkt zal er een cookie opgeslagen worden
                // if ( isset($_POST['remember'])){
                //     //set up setcookie
                //     setcookie("user", $row['username'], time() + 60*60*24*365);
                //     setcookie("ip", get_client_ip(), time() + 60*60*24*30);
                //     //$_SESSION['message'] = print_r($_COOKIE);
                // }
                // // de sessie word opgeslagen en de gebruiker wordt doorverbonden naar de correcte pagina
                // $_SESSION['User'] = $row['username'].'@'.get_client_ip();
                // $_SESSION['id'] = $row['userid'];
                // header('location:dashboard.php');
            }
        }
}


// Adding new customer including Success messages

function addKlant(){
    
    if (isset($_POST['Voornaam']) && isset($_POST['Achternaam']) && isset($_POST['Telefoon']))  {
        global $mysqli;

// Define $username and $password
    $voornaam = $_POST[Voornaam];
    $achternaam = $_POST[Achternaam];
    $email = $_POST[Email];
    $telefoon = $_POST[Telefoon];
    $gebdat = $_POST[Geboorte_Datum];
    $info = $_POST[Info];
    
    $result = mysqli_query($mysqli, "select * from klanten where Voornaam='".$voornaam."' AND Achternaam='".$achternaam."'");
    
    
    
        if (mysqli_num_rows($result) === 0 ){
            $sql =  "INSERT INTO klanten (Voornaam, Achternaam, Email, Telefoon, Geboorte_Datum, Info)
                    Values ('".$voornaam."', '".$achternaam."', '".$email."', '".$telefoon."', '".$gebdat."', '".$info."')";
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

// Edit Excisting Customer

function editKlant() {
        
    if (isset($_POST['voornaam']) && isset($_POST['achternaam']))  {
        global $mysqli;

        $sql =  "UPDATE klanten SET ";
        $sql .= "Voornaam ='".$_POST[voornaam]."', ";
        $sql .= "Achternaam ='".$_POST[achternaam]."', "; 
        $sql .= "Email ='".$_POST[email]."', ";
        $sql .= "Telefoon ='".$_POST[telefoon]."', ";
        $sql .= "Geboorte_Datum ='".$_POST[dob]."' ";
        $sql .= "WHERE ID= ".$_POST[id];
        
       
             
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


// Customer Table

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
                <td class="text-center">
                    <a id="edit_row" class="btn-floating btn-sm blue-gradient" data-id="'.$row['ID'].'"><i class="fas fa-pencil-alt"></i></a>
                </td>
              </tr>';
    }
}


// Sales Table

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


// Customer List (phonebook like)

function allClientList() {
    
    global $mysqli;
    $sql =mysqli_query($mysqli, "SELECT ID, CONCAT( Voornaam, ' ', Achternaam ) AS contact FROM  `klanten` GROUP BY 2 ORDER BY contact ASC");
     
    while($row = mysqli_fetch_array($sql)){
        echo '<tr data-id="'.$row['ID'].'" ><td class="contact"><button type="button" id="open_Info" class="btn btn-flat btn-sm"> '.$row['contact'].'</button></td></tr>';
    }
    
}

// Treatment List

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


// Minimalistic Chart Monthly Sales Target


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


// Dynamic SelectBox holding Last 6 months


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