<?php include('session.php'); ?>
<?php include('config.php');?>
<?php include('functions/functions.php'); ?>
<?php include('includes/header.php');?>


<?php
 mb_internal_encoding("UTF-8");  
 
            setlocale(LC_MONETARY, 'nl_NL.UTF-8');

            
            // MaandOmzet laatste 12 maanden
            $sql2 = mysqli_query($mysqli, "SELECT SUM( Prijs ) AS omzet, DATE_FORMAT( Datum,  '%Y-%m' ) AS periode FROM verkopen GROUP BY 2 ORDER BY periode DESC LIMIT 12");
            // Maand omzet huidige periode
            $sql3 = mysqli_query($mysqli, "SELECT SUM( Prijs ) AS omzet, DATE_FORMAT( Datum,  '%Y-%m' ) AS periode FROM verkopen WHERE periode = DATE_FORMAT( CURDATE( ) ,  '%Y-%m' ) GROUP BY 2");
            
            // Jaaromzet huidig jaar
            
            
            /* Array aanmaken met gegevens laatste 6 maanden */
            
            $omzetValues = array();
                $omzetLabels = array();
                    while($row2 = mysqli_fetch_array($sql2)){
                            $value =  round($row2['omzet'],2);
                            $label = $row2['periode'];
                            array_unshift($omzetValues, $value);
                            array_unshift($omzetLabels, $label);
                    }
?>

<?php include('includes/sidebar.php');?>


        <!-- Start your project here-->


        <div class="success_msg">

        </div>



       
        <main>
            

            <div id="keyFigures" class="container-fluid mt-5">

                <!-- KeyFigures / Row 1 -->
                <div class="row">
                    
                    <!-- KeyFigures / Row 1 / Col 1 -->
                    <div class="col">
                        
                        <!-- KeyFigures / Row 1 / Col 1 / Content -->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            
                            <!-- Title Quick Links -->
                            <h1 class="h2-responsive">Quick Links</h1>
                            <!-- /Title KeyFigures + Month Name -->
                            
                        </div>
                        <!-- /KeyFigures / Row 1 / Col 1 / Content -->
                        
                    </div>
                    <!-- /KeyFigures / Row 1 / Col 1-->
                    
                </div>
                <!-- /KeyFigures / Row 1 -->
                
                <!-- KeyFigures / Row 2 -->
                <div class="row mb-5">
                    
                    <!-- KeyFigures / Row 2 / Col 1 -->
                    <div class="col">
                        
                        
                        <div class="d-flex justify-content-around flex-wrap flex-md-nowrap pb-2 mb-5">
                            
                            
                            <a class="btn btn-lg btn-secondary material-tooltip-main m-2" data-placement="top" data-title="POS" type="button" href="posmdb.php"><i class="fas fa-th"></i></a>
                            <a class="btn btn-lg btn-secondary material-tooltip-main m-2" data-placement="top" data-title="Klantenlijst" type="button" href="klanten.php"><i class="fas fa-user"></i></a>
                            <a class="btn btn-lg btn-secondary material-tooltip-main m-2" data-placement="top" data-title="Behandelingen" type="button" href="services.php"><i class="fas fa-spa"></i></a>
                            <a class="btn btn-lg btn-secondary material-tooltip-main m-2" data-placement="top" data-title="Productenlijst" type="button" href="products.php"><i class="fas fa-barcode"></i></a>
                            <a class="btn btn-lg btn-secondary material-tooltip-main m-2" data-placement="top" data-title="Verkopen Lijst" type="button" href="verkopen.php"><i class="fas fa-shopping-cart"></i></a>
                            <a class="btn btn-lg btn-secondary material-tooltip-main m-2" data-placement="top" data-title="Aankopen Lijst" type="button" href="aankopen.php"><i class="fas fa-cart-plus"></i></a>
                            
                            
                            
                        </div>
                         
                        
                    </div>
                    <!-- /KeyFigures / Row 2 / Col 1 -->
                    
                    
                    
                </div>
                <!-- /KeyFigures / Row 2 -->
                
                <!-- KeyFigures / Row 4 -->
                <div class="row mt-5">
                    
                    <!-- KeyFigures / Row 4 / Col 1 -->
                    <div class="col">
                        
                        <!-- KeyFigures / Row 4 / Col 1 / Content -->
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            
                            <!-- Title KeyFigures + Month Name -->
                            <h1 class="h2-responsive">Key Figures</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                
                                <select id="chartPeriodSelector" class="mdb-select colorful-select dropdown-ins md-form">
                                    
                                    <?php
                                    
                                        periodSelect();
                                    
                                    ?>
                                    
                                </select>
                                <h1 class="h3-responsive">
                                     
                                </h1>

                            </div>
                            <!-- /Title KeyFigures + Month Name -->
                            
                        </div>
                        <!-- /KeyFigures / Row 4 / Col 1 / Content -->
                        
                    </div>
                    <!-- /KeyFigures / Row 4 / Col 1-->
                    
                </div>
                <!-- /KeyFigures / Row 4 -->
                
                <!-- KeyFigures / Row 5 -->
                <div class="row">
                    
                    <!-- KeyFigures / Row 5 / Col 1 -->
                    <div class="col">
                        
                        <!-- KeyFigures / Row 5 / Col 1 / First Card -->
                        <div class="card card-cascade narrower mb-5">
                            
                            <!-- First Card / Grid Row -->
                            <div class="row">
                                
                                <!-- First Card / Grid Row / Grid Column -->
                                <div class="col-md-5">
                                    
                                    <!-- Panel Header -->
                                    <div class="view view-cascade py-3 gradient-card-header info-color-dark">
                                        <h5 class="mb-0">Sales</h5>
                                    </div>
                                    <!-- /Panel Header -->
                                    
                                    <!-- Panel Content -->
                                    <div class="card-body">
                                        
                                        <!-- Grid Row -->
                                        <div class="row">
                                            
                                            <!-- Grid Column -->
                                            <div class="col-md-6 text-center my-4">
                                                
                                                <p class="lead">
                                                    <span class="badge info-color-dark p-2">Month target</span>
                                                </p>
                                                <div id="monthChart">
                                                    
                                                    <span class="min-chart" id="chart-mTarget" data-percent="<? $sql = mysqli_query($mysqli, "SELECT SUM( Prijs ) AS omzet, DATE_FORMAT( Datum,  '%Y-%m' ) AS periode FROM verkopen WHERE DATE_FORMAT( Datum,  '%Y-%m' )  = DATE_FORMAT( CURDATE( ) ,  '%Y-%m' ) GROUP BY 2");$row = mysqli_fetch_assoc($sql); echo floor($row['omzet']/1000*100);?>">
                                                        <span class="percent"></span>
                                                    </span>
                                                    
                                                    <p class="mb-4">
                                                        Total sales <? echo date('F'); ?> :
                                                
                                                        <strong>&euro; 
                                                            <? 
                                                                $sql = mysqli_query($mysqli, "SELECT SUM( Prijs ) AS omzet, DATE_FORMAT( Datum,  '%Y-%m' ) AS periode FROM verkopen WHERE DATE_FORMAT( Datum,  '%Y-%m' )  = DATE_FORMAT( CURDATE( ) ,  '%Y-%m' ) GROUP BY 2");
                                                                $row = mysqli_fetch_assoc($sql); 
                                                                echo number_format($row['omzet'],2,",","."); 
                                                            ?>
                                                        </strong>
                                                    </p>
                                                    
                                                </div>
                                                
                                                
                                                
                                                
                                            </div>
                                            <!-- /Grid Column -->
                                            
                                            <!-- Grid Column -->
                                            <div class="col-md-6 text-center my-4">
                                                
                                                <p class="lead">
                                                    <span class="badge info-color-dark p-2">Year target</span>
                                                </p>
                                                <span class="min-chart" id="chart-yTarget" data-percent="<? $sql = mysqli_query($mysqli, "SELECT SUM(Prijs) as omzet, Jaar FROM verkopen WHERE Jaar = Year(CURDATE())");$row = mysqli_fetch_assoc($sql); echo floor($row['omzet']/10000*100);?>">
                                                    <span class="percent"></span>
                                                </span>
                                                
                                                <p class="mb-1">Total sales <? echo date('Y'); ?> :
                                                    <strong>&euro; 
                                                        <? 
                                                            $sql = mysqli_query($mysqli, "SELECT SUM(Prijs) as omzet, Jaar FROM verkopen WHERE Jaar = YEAR(CURDATE())");
                                                            $row = mysqli_fetch_assoc($sql); 
                                                            echo number_format($row['omzet'],2,",",".");  
                                                        ?>
                                                    </strong>
                                                </p>
                                                
                                                
                                                
                                            </div>
                                            <!-- /Grid Column -->
                                            
                                        </div>
                                        <!-- Grid Row -->
                                        
                                    </div>
                                    <!-- /Panel Content -->
                                    
                                </div>
                                <!-- /Grid Column -->
                                        
                                <!-- Grid Column -->
                                <div class="col-md-7">
                                    
                                    <!-- Panel Header -->
                                    <div class="view view-cascade py-3 mb-4">
                                        
                                        <canvas id="salesChart" class="mt-5 pl-3" role="img"></canvas>
                                        

                                    </div>
                                    <!-- /Card Image -->
                                    
                                </div>
                                <!-- /Grid Column -->
                                
                            </div>
                            <!-- /Grid Row -->
                        
                        </div>
                        <!-- /1st Card -->
                
                    </div>
                    <!-- /KeyFigures / Row 4 / Col 1 -->
                    
                
                </div>
                <!-- /KeyFigures / Row 4 -->
                

            
            </div>
            <!-- /KeyFigures -->
            
            
        </main>
    
    


    <!-- /Start your project here-->

    <?php include('includes/scripts.php'); ?>
    <script type="text/javascript">
       
    $(document).ready(function (){     
        var ctx = document.getElementById('salesChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
        
            // The data for our dataset
            data: {
                labels: <?php echo json_encode($omzetLabels, JSON_NUMERIC_CHECK); ?>,
                datasets: [
                    {
                        data: <?php echo json_encode($omzetValues, JSON_NUMERIC_CHECK); ?>,
                        lineTension: 0.3,
                         backgroundColor: [
                                 'rgba(255, 99, 132, 0.2)'
                             ],
                         borderColor: [
                                 'rgba(255,99,132,1)'
                             ],
                        borderWidth: 1,
                        pointBackgroundColor: 'rgba(255,99,132,1)'
                            }
                        ]
            },
        
            // Configuration options go here
            options: {
                scales: {
                    xAxes: [{
                        barPercentage: 0.75,
                        categoryPercentage: 0.75
                                }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                                }]
                },
                legend: {
                    display: false
                }
            }
        });
        
    });    
    </script>
<?php include('includes/footer.php');?>
