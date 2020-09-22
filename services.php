<?php include('session.php'); ?>
<?php include('config.php'); ?>
<?php include('functions/functions.php'); ?>


<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>

        <div class="success_msg">

        </div>


        <main>
   
                
            <div id="products" class="container-fluid mt-5">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            <h1 class="h2">Behandelingen Schoonheidssalon</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <a href="Add_Customer.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-barcode"> +</i></a>
                                    <a href="dashboard.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-home"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid">
                    <div class="row d-none d-md-block">
                        <div class="col">
                           <div class="card card-cascade wider reverse my-4 pb-5">
                    
                                <div class="card-body">
                                    
                                    <table id="tblProd" class="table table-borderless table-responsive-md btn-table" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th class="th-sm">Service</th>
                                                <th class="th-sm">Behandeling</th>
                                                <th class="th-sm">Prijs</th>
                                                <th class="th-sm">Duur</th>
                                                <th class="th-sm">Edit</th>
                                            </tr>
                                        </thead>
                                        <!--<tfoot>-->
                                        <!--    <tr>-->
                                        <!--        <th class="th-sm">Service</th>-->
                                        <!--        <th class="th-sm">Behandeling</th>-->
                                        <!--        <th class="th-sm">Prijs</th>-->
                                        <!--        <th class="th-sm">Duur</th>-->
                                        <!--        <th class="th-sm">Edit</th>-->
                                        <!--    </tr>-->
                                        <!--</tfoot>-->
                                        <tbody>
                                            <?php 
                                                allServicesList();
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
    <!-- Custom Script -->
    <script type="text/javascript" src="js/script.js"></script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            $('#tblProd').DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: [2,3,4]
                }]
            });
            $('#tblProd_wrapper').find('label').each(function () {
                $(this).parent().append($(this).children());
            });
            $('#tblProd_wrapper .dataTables_filter').find('input').each(function () {
                $('input[type="search"]').attr("placeholder", "Search");
                $('input[type="search"]').removeClass('form-control-sm');
            });
            $('#tblProd_wrapper .dataTables_length').addClass('d-flex flex-row');
            $('#tblProd_wrapper .dataTables_filter').addClass('md-form');
            $('#tblProd_wrapper select').removeClass('custom-select custom-select-sm form-control form-control-sm');   
            $('#tblProd_wrapper select').addClass('mdb-select colorful-select dropdown-ins');
            $('#tblProd_wrapper .mdb-select').materialSelect();
            $('#tblProd_wrapper .dataTables_filter').find('label').remove();
        });
    </script>
    
<?php include('includes/footer.php'); ?>

