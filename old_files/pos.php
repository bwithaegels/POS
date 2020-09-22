<?php

session_start();

if( !isset($_SESSION['id']) || (trim($_SESSION['id']) == '')){
    header('location:index.php');
    exit();
}
//include('session.php');
//Require our config file with our DB details
include('config.php');

 mb_internal_encoding("UTF-8");         

            $query=mysqli_query($mysqli, "select * from login where userid='".$_SESSION['id']."'");
            $row =mysqli_fetch_assoc($query);
            $sql = mysqli_query($mysqli, "Select * from klanten");
            



//echo '<form id="q-select" name="selcus" action="php/CusSelect.php" method="get">';
//echo '<label>Klant:</label><br>';
//echo '<select name="klant" onchange="selectionchange()">';

?>
<!DOCTYPE html>
<html>
<head>
<title>Exzellence - Point of Sale</title>
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">-->
<link href="css/main.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>

<body>
    <header>
        <div class="logo logo-font">Exzellence</div>
        <div class="menu d-inline-flex justify-content-end pr-5">
            <button type="button" class="btn btn-outline-dark mx-1 px-2" id="welcome">Welcome : <i><?php echo $row['fullname']; ?></i></button>
            <button type="button" class="btn btn-outline-light mx-1 px-2" id="logout"><a href="logout.php">Log Out</a></button>
        </div>
        <div class="header-divider"></div>

    </header>

   <main>
   <div class="left">
            <div class="user-controls">
                <div class="inner-user-controls d-inline-flex justify-content-around">
                    
                        <!-- <div class="input-group-prepend">
                            <label class="input-group-text" for="SelectCust">Klant</label>
                        </div> -->
                       <select class="selectcus" name="e_klant" id="SelectCust">
                           <option value="0">Selecteer Klant...</option>
                           <? while($row=mysqli_fetch_array($sql)){
                                echo '<option value="'.$row['ID'].'">'.$row['Voornaam'].' '.$row['Achternaam'].'</option>';
                            }
                            ?>
                        </select>
                        

                    
                        <button type="button" class="btn btn-dark m-2 NewCus">Nieuwe klant</button>
                   
                        <button type="button" class="btn btn-dark m-2 CusCard">Klantenkaart</button>
                    
                </div>

            </div>
            <div class="data-screen">
                <div class="inner-screen">
                    <table id="tblscreen" class="table table-dark table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="tblhead">
                                <th scope="col">ID</th>
                                <th scope="col">Datum</th>
                                <th scope="col">Tijd</th>
                                <th scope="col">Behandeling</th>
                                <th scope="col">Prijs</th>
                                <th scope="col">Jaar</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="screenBody">
                            
                        </tbody>
    
    
                    </table>
                </div>

            </div>
            <div class="data-total">
                <div class="inner-total mb-3">
                        <table id="tbltotals" class="table table-dark">
                                <tbody>
                                    <tr class="tijd">
                                        <th>Datum:</th>
                                        <th></th>
                                        <td class="date"></td>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <td></td>
                                    </tr>
                                    <tr class="omzet">
                                        <th>Totaal:</th>
                                        <th>€</th>
                                        <td class="sum"></td>
                                    </tr>
                                </tbody>
                            </table>
                </div>

            </div>
            
       </div>
       <div class="right">
           <!-- Service control Panel -->
           <div class="sercopa">
                <div class="inner-sercopa d-flex flex-row justify-content-around">

                        <nav class="w-100 nav-fill ">
                                <div class="container">
        
                                    <ul class="nav nav-pills">
                                        <li class="nav-item seritm">
                                            <a class="nav-link active" href="#arr-gel">Gelaat</a>
                                        </li>
                                        <li class="nav-item seritm">
                                            <a class="nav-link" href="#arr-man">Manicure</a>
                                        </li>
                                        <li class="nav-item seritm">
                                            <a class="nav-link" href="#arr-ped">Pedicure</a>
                                        </li>
                                        <li class="nav-item seritm">
                                            <a class="nav-link" href="#arr-mak">Make-up</a>
                                        </li>
                                        <li class="nav-item seritm">
                                            <a class="nav-link" href="#arr-ont">ontharing</a>
                                        </li>
                                        <li class="nav-item seritm">
                                            <a class="nav-link" href="#arr-pro">producten</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </nav>
                    <!-- <div class="seritm arr-gel active">Gelaat</div>
                    <div class="seritm arr-man">Manicure</div>
                    <div class="seritm arr-ped">Pedicure</div>
                    <div class="seritm arr-mak">Make-up</div>
                    <div class="seritm arr-ont">Ontharing</div>
                    <div class="seritm arr-pro">Producten</div> -->
                    
                </div>
           </div>
           <!-- Sales control Panel -->
           <div class="salcopa">
                <div id="arr-gel" class="arr shown">
                   <button class="btn btn-secondary btn-lg" data-beh="Glo Intense" data-price="73">Glo-Intens</button>
                   <button class="btn btn-secondary btn-lg" data-beh="Glo Beauty" data-price="60">Glo-Beauty</button>
                   <button class="btn btn-secondary btn-lg" data-beh="Glo Flash" data-price="35">Glo-Flash</button>

                </div>
                <div id="arr-man" class="arr">
                    <button class="btn btn-secondary btn-lg" data-beh="Basis Manicure" data-price="25">Basis</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Manicure Deluxe" data-price="35">Deluxe</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Basis Manicure + Gellak" data-price="30">Basis + Gel</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Gelnagels" data-price="42">Gelnagels</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Gelnagels nieuwe set" data-price="60">Gelnagels +</button>
                </div>
                <div id="arr-ped" class="arr">
                    <!--<button class="btn btn-secondary btn-lg" data-beh="Estetische Pedicure" data-price="25">Estetische</button>-->
                    <button class="btn btn-secondary btn-lg" data-beh="Medische Pedicure" data-price="30">Medische</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Pedicure Deluxe" data-price="40">Deluxe</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Medische Pedicure + Gellak" data-price="45">Pedicure + Gel</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Gellac" data-price="10">Gellac</button>
                </div>
                <div id="arr-mak" class="arr">
                    <button class="btn btn-secondary btn-lg" data-beh="Feest Make-up" data-price="45">Feest</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Bruids Make-up" data-price="70">Bruid</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Persoonlijke Make-up (cursus)" data-price="60">Cursus</button>
                </div>
                <div id="arr-ont" class="arr">
                    <button class="btn btn-secondary btn-lg" data-beh="Epilatie Wenkbrauwen" data-price="8">Epi WB</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Wenkbrauwen Vorm geven" data-price="12">Vorm WB</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Ontharing Kin" data-price="6">Kin</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Ontharing Bovenlip" data-price="7,50">Bovenlip</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Ontharing Bovenlip + Kin" data-price="10">Bovenlip + Kin</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Ontharing Onderbenen" data-price="18">Onderbenen</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Ontharing Dijen" data-price="18">Dijen</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Ontharing Boven- en Onderbenen" data-price="28">Onder + Bovenbenen</button>
                    <button class="btn btn-secondary btn-lg" data-beh="Ontharing Oksels" data-price="12">Oksels</button>
                </div>
                <div id="arr-pro" class="arr">

                </div>
            

           </div>
           <div class="discopa">

           </div>
           <!-- Payment control Panel -->
           <div class="paycopa">
                <div class="inner-paycopa">
                    <button class="btn btn-lg btn-success mx-3 pay">Betalen</button>
                    <button class="btn btn-lg btn-danger mx-3 cancel">Annuleren</button>
                </div>
                <div class="savemsg mt-2">
                    
                </div>
           </div>



       </div>
    </main>
    <form id="NewCus" action="NewCus.php" method="post">
            <div class="close">
                    <div class="fas fa-window-close"></div>
                </div>
            <div class="form-title text-center mb-3">
                <h3>Nieuwe klant aanmaken</h3>
            </div>
            <div class="form-row">
                <div class="col">
                     <label for="cFirstName"></label>
                     <input type="text" name="cFirstName" class="form-control" placeholder="Voornaam" required>
                 </div>
                 <div class="col">
                     <label for="cLastName"></label>
                     <input type="text" name="cLastName" class="form-control" placeholder="Achternaam" required>
                 </div>
             </div>
             <div class="form-row">
                 <div class="col">
                     <label for="cEmail"></label>
                     <input type="email" name="cEmail" class="form-control" placeholder="E-mail">
                 </div>
             </div>
             <div class="form-row">
                 <div class="col">
                         <label for="cPhone"></label>
                         <input type="tel" name="cPhone" class="form-control" placeholder="Telefoonnummer" required>
                 </div>
                 <div class="col">
                         <label for="cDoB"></label>
                         <input type="date" name="cDoB" class="form-control" placeholder="Geboorte datum">
                 </div>
             </div>
             
             <button type="submit" class="btn btn-secondary btn-md my-3">Opslaan</button>
             <button type="reset" class="btn btn-warning btn-md">Annuleer</button>
        </form>
        
        <!-- Klanten formulier -->
        
        <form id="klantKaart">
            <div class="close">
                <div class="fas fa-window-close"></div>
            </div>
            <div class="form-title text-center my-5">
                <h3 class="klantNaam">Bjorge Withaegels</h3>
            </div>
        
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-2">
                    <label for="cEmail"></label>
                    <input type="email" id="cEmail" class="form-control" placeholder="E-mail">
                </div>
                <div class="col-2">
                    <label for="cPhone"></label>
                    <input type="tel" id="cPhone" class="form-control" placeholder="Telefoonnummer" required>
                </div>
                <div class="col-2">
                    <label for="cDoB"></label>
                    <input type="date" id="cDoB" class="form-control" placeholder="Geboorte datum">
                </div>
                <div class="col-2">     
                </div>
                <div class="col-2">
                    <button class="btn btn-lg btn-success">Update</button>
                </div>
            </div>
            
            <div id="salesHistory" class="form-row my-3">
                
            </div>
            
            
        </form>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="js/sales-script.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<!--
<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>
-->
</body>
</html>