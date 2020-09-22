<?php include('session.php'); ?>
<?php include('config.php'); ?>
<?php include('functions/functions.php'); ?>

<?php
 mb_internal_encoding("UTF-8");  
 
            setlocale(LC_MONETARY, 'nl_NL.UTF-8');

            
           
            
           
            
            $sql3 =mysqli_query($mysqli, "Select ID, Voornaam, Achternaam, Email, Telefoon, Geboorte_Datum from klanten order by Voornaam ASC");
            
             $tblCus = array();
             
             while ($row = mysqli_fetch_assoc($sql3)){
                $tblCus[$row['ID']] = $row;
             }
             

?>
<?php include('includes/header.php');?>
<?php include('includes/sidebar.php');?>

        <div class="success_msg">

        </div>


        <main>
           


             <!--
            
                    Sectie Klanten
            
            -->
            
            <div id="customers" class="container-fluid mt-5">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            <h1 class="h2">Klant Toevoegen</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <a href="klanten.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-user"></i></a>
                                    <a href="dashboard.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-home"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col">
                            <div class="card card-cascade reverse  my-4 pb-5">
                   
                                <div class="card-body card-body-cascade">
                                    
                                        
                                   
                                </div>
                                <div class="card-footer">
                                    <button name="btn_NewUser" id="btn_add" class="btn btn-xs btn-success float-right"><i class="fas fa-user-plus"></i> Voeg Toe</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </main>


    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.js"></script>
    <!-- MDBootstrap Datatables  -->
    <script type="text/javascript" src="js/addons/datatables.min.js"></script>
    <!-- DataTables Select JS -->
    <script href="css/addons/datatables-select.min.js" rel="stylesheet"></script>
    <!-- Custom Script -->
    <script type="text/javascript" src="js/script.js"></script>
    <script type="text/javascript">
    
 

    </script>
<?php include('includes/footer.php'); ?>

