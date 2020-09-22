<?php include('session.php'); ?>
<?php include('config.php'); ?>
<?php include('functions/functions.php'); ?>

<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

        <div class="success_msg">

        </div>


        <main>
           


             <!--
            
                    Sectie Klanten
            
            -->
            
            <div id="Sales" class="container-fluid mt-5">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            <h1 class="h2">Verkopen <? echo date('Y'); ?></h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <a class="btn btn-sm btn-outline-secondary" type="button" href="#"><i class="fas fa-cart-plus"></i></a>
                                <a class="btn btn-sm btn-outline-secondary" type="button" href="dashboard.php"><i class="fas fa-home"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row  d-none d-md-block">
                        <div class="col">
                            <div class="card card-cascade wider reverse  my-4 pb-5">
                    
                                <div class="card-body">
                                    
                                        <table id="tblSales" class="table table-borderless table-responsive-md btn-table">
                                            <thead>
                                                <tr>
                                                    <th class="th-sm">Naam</th>
                                                    <th class="th-sm">Datum</th>
                                                    <th class="th-sm">Behandeling</th>
                                                    <th class="th-sm">Prijs</th>
                                                </tr>
                                            </thead>
                                            
                                            <tbody>
                                                <? 
                                                    
                                                    allSalesData();
                                                    
                                                ?>
                                                
                                            </tbody>
                                        </table>
                                   
                                </div>
                                
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
        

        $(document).ready(function () {
            $('#tblSales').dataTable({
                
                "order": [[1, "desc" ]]
            });
            $('#tblSales_wrapper').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#tblSales_wrapper .dataTables_filter').find('input').each(function () {
                $('input[type="search"]').attr("placeholder", "Search");
                $('input[type="search"]').removeClass('form-control-sm');
            });
            $('#tblSales_wrapper .dataTables_length').addClass('d-flex flex-row');
            $('#tblSales_wrapper .dataTables_filter').addClass('md-form');
            $('#tblSales_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');   
            $('#tblSales_wrapper select').addClass('mdb-select colorful-select dropdown-ins');
            $('#tblSales_wrapper .mdb-select').materialSelect();
            $('#tblSales_wrapper .dataTables_filter').find('label').remove();
        });
        
    </script>

<?php include('includes/footer.php'); ?>
