<?php include('config.php'); ?>
<?php include('functions/functions.php'); ?>

<?php
            
            // $sql3 =mysqli_query($mysqli, "Select ID, Voornaam, Achternaam, Email, Telefoon, Geboorte_Datum from klanten order by Voornaam ASC");
            
            //  $tblCus = array();
             
            //  while ($row = mysqli_fetch_assoc($sql3)){
            //     $tblCus[$row['ID']] = $row;
            //  }
             

?>
<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>


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
                            <h1 class="h2">Klanten</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <a href="Add_Customer.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-user-plus"></i></a>
                                    <a href="dashboard.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-home"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row  d-none d-md-block">
                        <div class="col">
                            <div class="card card-cascade reverse  my-4 pb-5">
                   
                                <div class="card-body card-body-cascade">
                                    
                                        <table id="tblCus" class="table table-borderless table-responsive-md btn-table " cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    
                                                    <th class="th-sm">Voornaam</th>
                                                    <th class="th-sm">Achternaam</th>
                                                    <th class="th-sm">E-mail</th>
                                                    <th class="th-sm">Telefoon</th>
                                                    <th class="th-sm">Geboorte-datum</th>
                                                    <th class="th-sm"></th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    
                                                    <th class="th-sm">Voornaam</th>
                                                    <th class="th-sm">Achternaam</th>
                                                    <th class="th-sm">E-mail</th>
                                                    <th class="th-sm">Telefoon</th>
                                                    <th class="th-sm">Geboorte-datum</th>
                                                    <th class="th-sm"></th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                <? 
                                                   allKlantData();
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                   
                                </div>
                                <div class="card-footer">
                                    <button name="btn_add" id="btn_add" class="btn btn-xs btn-success float-right"><span data-feather="user-plus"></span> Voeg Toe</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row d-block d-md-none">
                    <div class="col">
                        <div class="table-responsive">
                            <table id="phonelist" class="table table-hover table-sm" cellspacing="0">
                                <thead class="rgba-stylish-strong">
                                    <tr>
                                        <th class="h1-responsive">Naam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? 
                                        allClientList();
                                  
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal - Update Contact -->
            <div class="modal fade sunny-morning-gradient" id="modalEditCustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header text-center special-color-dark white-text">
                    <h4 class="modal-title w-100 font-weight-bold">Klantfiche <span class="cusName"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body mx-3">
                    <div class="md-form mb-5">
                        <i></i>
                      <input type="hidden" id="c_ID" class="form-control validate">
                    </div>
                    <div class="md-form mb-5">
                        <i>Voornaam</i>
                      <input type="text" id="c_Voornaam" class="form-control validate">
                      <label data-error="wrong" data-success="right" for="form29"></label>
                    </div>
                    <div class="md-form mb-5">
                        <i>Achternaam</i>
                      <input type="text" id="c_Achternaam" class="form-control validate">
                      <label data-error="wrong" data-success="right" for="c_achternaam"></label>
                    </div>
                    <div class="md-form mb-5">
                        <i>E-mail</i>
                      <input type="email" id="c_Email" class="form-control validate">
                      <label data-error="wrong" data-success="right" for="c_Email"></label>
                    </div>
                    <div class="md-form mb-5">
                        <i>Telefoon</i>
                      <input type="text" id="c_Telefoon" class="form-control validate">
                      <label data-error="wrong" data-success="right" for="c_Telefoon"></label>
                    </div>
                    <div class="md-form mb-5">
                        <i>Geboorte Datum</i>
                      <input type="date" id="c_GebDat" class="form-control validate">
                      <label data-error="wrong" data-success="right" for="c_GebDat"></label>
                    </div>
            
                  </div>
                  <div class="modal-footer d-flex justify-content-center">
                    <button id="save_row" class="btn btn-success">Update<i class="fas fa-save ml-1"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /. Modal - Update Contact -->
            
            <!-- Modal - View Contact Info -->
            <div class="modal fade right bg-white" id="modalContactInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
              aria-hidden="true">
              <div class="modal-dialog modal-sm modal-right" role="document">
                <div class="modal-content warm-flame-gradient">
                 
                  <div class="modal-body">
                    <div>
                      <input type="hidden" id="ci_ID" class="form-control">
                    </div>
                    <div class="md-form">
                        <small>Naam</small>
                      <input type="text" id="ci_Naam" class="form-control" readOnly>
                      
                    </div>
                    <div class="md-form">
                        <small>E-mail</small>
                      <input type="email" id="ci_Email" class="form-control" readOnly>
                     
                    </div>
                    <div class="md-form">
                        <small>Telefoon</small>
                      <input type="text" id="ci_Telefoon" class="form-control" readOnly>
                      
                    </div>
                    <div class="md-form">
                        <small>Geboorte Datum</small>
                      <input type="date" id="ci_GebDat" class="form-control" readOnly>
                      
                    </div>
            
                  </div>
                  <div class="modal-footer d-flex justify-content-center">
                    <button id="close_Info" class="btn btn-success">Back<i class="fas fa-angle-double-left ml-1"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /. Modal - View Contact Info -->
            

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
        
       
        var customer_Array = <?php echo json_encode($tblCus) ?>;
        console.log(customer_Array);
        
        // Global variables to fill up the Edit Form
        
        var c_Voornaam;
        var c_Achternaam;
        var c_Email;
        var c_Telefoon;
        var c_GebDat;
        var c_ID;
        
        
         $(document).on('click', '#edit_row', function(){
        var cur_row = $(this).closest('tr');
        var cusId = cur_row.data('id');
        $('#modalEditCustomer').modal('show');
        $(".cusName").html(customer_Array[cusId].Voornaam + " " + customer_Array[cusId].Achternaam)
        $("#c_ID").val(customer_Array[cusId].ID);
        $("#c_Voornaam").val(customer_Array[cusId].Voornaam);
        $("#c_Achternaam").val(customer_Array[cusId].Achternaam);
        $("#c_Email").val(customer_Array[cusId].Email);
        $("#c_Telefoon").val(customer_Array[cusId].Telefoon);
        $("#c_GebDat").val(customer_Array[cusId].Geboorte_Datum);
    });
    
             $(document).on('click', '#open_Info', function(){
        var cur_row = $(this).closest('tr');
        var cusId = cur_row.data('id');
        $('#modalContactInfo').modal({
            show: true,
            keyboard: true,
            backdrop: true,
            focus: true
        });
        $(".cusName").html(customer_Array[cusId].Voornaam + " " + customer_Array[cusId].Achternaam)
        $("#ci_ID").val(customer_Array[cusId].ID);
        $("#ci_Naam").val(customer_Array[cusId].Voornaam +" "+ customer_Array[cusId].Achternaam);
        $("#ci_Email").val(customer_Array[cusId].Email);
        $("#ci_Telefoon").val(customer_Array[cusId].Telefoon);
        $("#ci_GebDat").val(customer_Array[cusId].Geboorte_Datum);
    });
    
    $(document).on("click", "#close_Info", function(){
        $("#modalContactInfo").modal('hide');
    });    
        
    </script>
<?php include('includes/footer.php'); ?>