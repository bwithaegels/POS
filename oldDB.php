<?php

//session_start();
//
//if( !isset($_SESSION['id']) || (trim($_SESSION['id']) == '')){
//    header('location:index.php');
//    exit();
//}

include('../config.php');


 mb_internal_encoding("UTF-8");  
 
            setlocale(LC_MONETARY, 'nl_NL.UTF-8');

            
            $sql = mysqli_query($mysqli, "Select * from klanten order by Voornaam ASC");
            $sql2 = mysqli_query($mysqli, "SELECT SUM( Prijs ) AS omzet, DATE_FORMAT( Datum,  '%Y-%m' ) AS periode FROM verkopen GROUP BY 2 ORDER BY periode DESC LIMIT 12");
            
            /* Array aanmaken met gegevens laatste 6 maanden */
            
            $omzetValues = array();
                $omzetLabels = array();
                    while($row2 = mysqli_fetch_array($sql2)){
                            $value =  $row2['omzet'];
                            $label = $row2['periode'];
                            array_unshift($omzetValues, $value);
                            array_unshift($omzetLabels, $label);
                            }
            
            /* Chart voor Top 3 producten */
            
            $sql3 = mysqli_query($mysqli, "SELECT Behandeling, COUNT( * ) AS aantal
                                            FROM verkopen
                                            GROUP BY Behandeling
                                            ORDER BY COUNT( * ) DESC 
                                            LIMIT 3");
                                            
                /* Data in array zetten voor grafiek */
                $topProdValues = array();
                $topProdLabels = array();
                while($row3 = mysqli_fetch_array($sql3)){
                    $value = $row3['aantal'];
                    $label = $row3['Behandeling'];
                    array_push($topProdValues, $value);
                    array_push($topProdLabels, $label);
                }
                
                /* Chart voor Top 3 omzet/Behandeling */
                
            $sql4 = mysqli_query($mysqli, "SELECT Behandeling, SUM( Prijs ) AS omzet
                                                FROM verkopen
                                                GROUP BY Behandeling
                                                ORDER BY SUM( Prijs ) DESC 
                                                LIMIT 3");
                                                
                /* Data van query omzetten naar array */
                
                 $topRevValues = array();
                $topRevLabels = array();
                while($row4 = mysqli_fetch_array($sql4)){
                    $value = $row4['omzet'];
                    $label = $row4['Behandeling'];
                    array_push($topRevValues, $value);
                    array_push($topRevLabels, $label);
                }
                
                /* Chart Top 3 Klanten */
            
            $sql5 = mysqli_query($mysqli, "SELECT klanten.Voornaam as voornaam, klanten.Achternaam as achternaam, SUM( verkopen.Prijs ) as omzet
                                            FROM verkopen
                                            LEFT JOIN klanten ON klanten.Id = verkopen.KlantID
                                            GROUP BY klanten.Id
                                            ORDER BY omzet DESC 
                                            LIMIT 3");   
            
                /* Data ophalen voor Donut grafiek */
                
                $topCusValues = array();
                $topCusNames = array();
                while($row5 = mysqli_fetch_array($sql5)){
                    $value = $row5['omzet'];
                    $name = $row5['voornaam'].' '.$row5['achternaam'];
                    array_push($topCusValues, $value);
                    array_push($topCusNames, $name);
                }
                
                
            $sql6 = mysqli_query($mysqli, "Select * , services.ser_Naam as service 
                                            FROM behandelingen
                                            LEFT JOIN services ON services.ser_Id = behandelingen.ser_Id
                                            order by services.ser_Id DESC
                                            ");
            $row6 = mysqli_fetch_array($sql6);


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exzellence - Point of Sale</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel='stylesheet' href='css/fullcalendar.css'>
    <!--<link href="../css/main.min.css" rel="stylesheet" type="text/css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    
    <style>
        

.feather {
  width: 16px;
  height: 16px;
  vertical-align: text-bottom;
}

.card, .btn, .form-control {
    border-radius: 0;
}

/*
 * Sidebar
 */

.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100; /* Behind the navbar */
  padding: 0;
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
}

.sidebar-sticky {
  position: absolute;
  top: 50px; /* Height of navbar */
  height: calc(100vh - 50px);
  padding-top: .5rem;
  overflow-x: hidden;
  overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #999;
}

.sidebar .nav-link.active {
  color: #fff;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  color: inherit;
}

.sidebar-heading {
  font-size: .75rem;
  text-transform: uppercase;
}

/*
 * Navbar
 */

.navbar-brand {
  padding-top: .75rem;
  padding-bottom: .75rem;
  font-size: 1rem;
  background-color: rgba(0, 0, 0, .25);
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, .25);
}

.navbar .form-control {
  padding: .75rem 1rem;
  border-width: 0;
  border-radius: 0;
}

.form-control-dark {
  color: #fff;
  background-color: rgba(255, 255, 255, .1);
  border-color: rgba(255, 255, 255, .1);
}

.form-control-dark:focus {
  border-color: transparent;
  box-shadow: 0 0 0 3px rgba(255, 255, 255, .25);
}

/*
 * Utilities
 */

.border-top { border-top: 1px solid #e5e5e5; }
.border-bottom { border-bottom: 1px solid #e5e5e5; }

#success_msg{
    width: 100%;
    height: auto;
    display: flex;
    justify-content: center;
}

/*

Klanten pagina

*/

#customers{
    display: none;
}

#calendar{
    display: block;
    height: 100%;
    width: 100%;
}

        .dark-text,
        .dark-text:hover{
            color: black;
        }

/*
* Charts
*/

/*
.ChartCanvas .card,
.dougnutCharts .card{
    border: none;
}
.dougnutCharts{
    display: flex;
    flex-direction: column;
}
*/

    </style>
</head>

<body>
<div class="success_msg">
                    
</div>
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 navbar-expand-md">
    <div class="navbar-brand d-flex align-items-center justify-content-between col-sm-12 col-md-2 mr-0">
        <a class="mr-1 d-md-none text-light" href="#sidenav" data-toggle="collapse" data-target="#sidenav">
            <span data-feather="menu" class="my-1"></span>
        </a>
        <a class="text-light" href="dashboard.php">Exzellence</a>
    </div>
    
</nav>

<div class="container-fluid">
    <div class="row navbar-expand-md">
        <nav class="col-md-3 col-lg-2 bg-light sidebar" id="sidenav">
            <div class="sidebar-sticky flex-column w-100 mt-1">
                <ul class="nav flex-column nav-pills">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">
                            <span class="fas fa-home" aria-hidden="true"></span> Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="pos/pos.php">
                            <span class="fas fa-th" aria-hidden="true"></span> POS
                        </a>
                    </li>
                    <li class="nav-item">
                        <a id="menProd" class="nav-link dropdown-toggle" href="#subProd" data-toggle="collapse" aria-expanded="false">
                            <span class="fas fa-barcode" aria-hidden="true"></span> Producten
                        </a>
                        <div id="subProd" class="collapse list-group">
                            <a  href="products.php" class="list-group-item dark-text">Lijst Producten</a>
                            <a  href="#" class="list-group-item dark-text">Product Toevoegen</a>
                            <a  href="#" class="list-group-item dark-text">Producten Importeren</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a id="menCat" class="nav-link dropdown-toggle" href="#subCat" data-toggle="collapse" aria-expanded="false">
                            <span class="fas fa-folder" aria-hidden="true"></span> Categorie
                        </a>
                        <div id="subCat" class="collapse list-group">
                            <a  href="#" class="list-group-item dark-text">Lijst Categoriën</a>
                            <a  href="#" class="list-group-item dark-text">Categorie Toevoegen</a>
                            <a  href="#" class="list-group-item dark-text">Categoriën Importeren</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a id="menVerk" class="nav-link dropdown-toggle" href="#subVerk" data-toggle="collapse" aria-expanded="false">
                            <span class="fas fa-shopping-cart" aria-hidden="true"></span> Verkopen
                        </a>
                        <div id="subVerk" class="collapse list-group">
                            <a  href="#" class="list-group-item dark-text">Lijst Verkopen</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a id="menAank" class="nav-link dropdown-toggle" href="#subAank" data-toggle="collapse" aria-expanded="false">
                            <span class="fas fa-plus" aria-hidden="true"></span> Aankopen
                        </a>
                        <div id="subAank" class="collapse list-group">
                            <a  href="#" class="list-group-item dark-text">Lijst Aankopen</a>
                            <a  href="#" class="list-group-item dark-text">Aankoop Toevoegen</a>
                            <a  href="#" class="list-group-item dark-text">Lijst Uitgaven</a>
                            <a  href="#" class="list-group-item dark-text">Uitgaven Toevoegen</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a id="menGift" class="nav-link dropdown-toggle" href="#subGift" data-toggle="collapse" aria-expanded="false">
                            <span class="fas fa-credit-card" aria-hidden="true"></span> Cadeaubonnen
                        </a>
                        <div id="subGift" class="collapse list-group">
                            <a  href="#" class="list-group-item dark-text">Lijst Cadeaubonnen</a>
                            <a  href="#" class="list-group-item dark-text">Cadeaubon Toevoegen</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a id="menCont" class="nav-link dropdown-toggle" href="#subCont" data-toggle="collapse" aria-expanded="false">
                            <span class="fas fa-users" aria-hidden="true"></span> People
                        </a>
                        <div id="subCont" class="collapse list-group">
                            <a  href="klanten.php" class="list-group-item dark-text">Lijst Klanten</a>
                            <a  href="#" class="list-group-item dark-text">Klant Toevoegen</a>
                            <a  href="#" class="list-group-item dark-text">Lijst Leveranciers</a>
                            <a  href="#" class="list-group-item dark-text">Leverancier Toevoegen</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a id="menRapp" class="nav-link dropdown-toggle" href="#subRapp" data-toggle="collapse" aria-expanded="false">
                            <span class="fas fa-chart-bar" aria-hidden="true"></span> Rapporten
                        </a>
                        <div id="subRapp" class="collapse list-group">
                            <a  href="#" class="list-group-item dark-text">Dagomzet</a>
                            <a  href="#" class="list-group-item dark-text">Maandomzet</a>
                            <a  href="#" class="list-group-item dark-text">Verkoop Rapport</a>
                            <a  href="#" class="list-group-item dark-text">Betaal Rapport</a>
                            <a  href="#" class="list-group-item dark-text">Kassa Rapport</a>
                            <a  href="#" class="list-group-item dark-text">Top Producten</a>
                            <a  href="#" class="list-group-item dark-text">Product Rapport</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <span class="fas fa-cogs" aria-hidden="true"></span> Settings
                        </a>
                    </li>
                </ul>

            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
            
            <div id="keyFigures" class="container-fluid">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            <h1 class="h2">Key Figures</h1>
                            <div class="btn-toolbar mb-2 mb-md-0">
                                <div class="btn-group mr-2">
                                    <button class="btn btn-sm btn-outline-secondary">Share</button>
                                    <button class="btn btn-sm btn-outline-secondary">Export</button>
                                </div>
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                    <span data-feather="calendar"></span> This week
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1 ChartCanvas">
                        
                        <div class="card shadow border-left-warning h-100">
                            <div class="card-header">
                                <h1 class="h3 text-center">Omzet laatste 6 maanden</h1>
                            </div>
                            <div class="card-body">
                                <canvas id="salesChart" class="mt-5 pl-3" width="400" height="300" role="img"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row align-items-center">
                    
                    <div class="col-md-4 my-5 py-1">
                        <div class="card shadow border border-left-info h-100">
                            <div class="card-header pl-5">
                                <h1 class="h3">Meest verkocht</h1>
                            </div>
                            <div class="card-body">
                                <canvas id="topProdChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 my-5 py-1">
                        
                        <div class="card shadow border border-left-success h-100">
                            <div class="card-header pl-5">
                                <h1 class="h3">Meest Opgebracht</h1>
                            </div>
                            <div class="card-body">
                                <canvas id="topRevenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 my-5 py-1">
                        
                        <div class="card shadow border border-left-warning h-100">
                            <div class="card-header pl-5">
                                <h1 class="h3">Grootste klant</h1>
                            </div>
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <canvas id="topCustomerChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!--
            
                    Sectie Producten
            
            -->
                

             <!--
            
                    Sectie Klanten
            
            -->

        </main>
    </div>
</div>

<!--<script src="js/bootstrap.min.js"></script>-->
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="../js/sales-script.js"></script>
<script src="../scripts/script.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/fullcalendar.js"></script>
<script src="js/locale-all.js"></script>
<script type="text/javascript">
$(document).ready(function(){

    $('#tblCus').DataTable({
        "aLengthMenu": [[25,50,75,-1],[25,50,75, "ALL"]],
        "iDisplayLength": 50
    });
    $('#tblProd').DataTable({
        "aLengthMenu": [[25,50,100],[25,50,100]],
        "iDisplayLength": 50
    });

        
    $('#calendar').fullCalendar({
        locale: 'nl',
        themeSystem: 'bootstrap4',
        defaultView: 'agendaWeek',
        nowIndicator: true,
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listMonth'
        },
        views: {
            month: {
                titleFormat: 'MMMM'
            },
            agendaWeek: {
                titleFormat: 'DD MMM'
            },
            agendaDay: {
                titleFormat: 'DD MMMM YYYY'
            }
        },
        weekNumbers: true,
        weekends: true,
        eventLimit: true
    });
    feather.replace();
});


var donutOptions = {
  cutoutPercentage: 65, 
  legend: {position:'top', padding:0, labels: {pointStyle:'circle', usePointStyle:true, fontSize: 12}}
};

/*
###########################
#########  AGENDA #########
###########################
*/
/*
var calendar = $('#calendar').fullCalendar('getCalendar');

    calendar.on('dayClick', function(date, jsEvent, view){
        console.log('clicked on ' + date.format()); 
    });
*/
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
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
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
var ctx = document.getElementById('topProdChart').getContext('2d');
        var topProdChart = new Chart(ctx, {
        // The type of chart we want to create
            type: 'pie',

            // The data for our dataset
            data: {
                labels: <?php echo json_encode($topProdLabels, JSON_NUMERIC_CHECK); ?>,
                datasets: [
                    {
                    data: <?php echo json_encode($topProdValues, JSON_NUMERIC_CHECK); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)'
                        ],
                    borderColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)'
                        ],
                    borderWidth: 0,
                    }
                ]
            },
    
            // Configuration options go here
            options: donutOptions
        });
var ctx = document.getElementById('topRevenueChart').getContext('2d');
    var topRevChart = new Chart(ctx, {
    // The type of chart we want to create
        type: 'pie',

        // The data for our dataset
        data: {
            labels: <?php echo json_encode($topRevLabels, JSON_NUMERIC_CHECK); ?>,
            datasets: [{
                data: <?php echo json_encode($topRevValues, JSON_NUMERIC_CHECK); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                    ],
                borderColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                    ],
                borderWidth: 0,
            }]
        },

        // Configuration options go here
        options: donutOptions
    });
var ctx = document.getElementById('topCustomerChart').getContext('2d');
    var topCusChart = new Chart(ctx, {
    // The type of chart we want to create
        type: 'pie',

    // The data for our dataset
        data: {
            labels: <?php echo json_encode($topCusNames, JSON_NUMERIC_CHECK); ?>,
            datasets: [{
                data: <?php echo json_encode($topCusValues, JSON_NUMERIC_CHECK); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                    ],
                borderColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)'
                    ],
                borderWidth: 0,
            }]
        },

    // Configuration options go here
        options: donutOptions
    });
$(document).on('click', '#btn_add', function(){
    var Voornaam = $('#akVoornaam').text();
    var Achternaam = $('#akAchternaam').text();
    var Email = $('#akEmail').text();
    var Telefoon = $('#akTelefoon').text();
    var Geboorte_Datum = $('#akGeb_Dat').text();
    if(Voornaam =="")
    {
        alert("Gelieve een Voornaam op te geven");
        return false;
    }
    if(Achternaam =="")
    {
        alert("Gelieve een Achternaam op te geven");
        return false;
    }
    if(Telefoon =="")
    {
        alert("Gelieve een Telefoon op te geven");
        return false;
    }
    $.ajax({
        url: "insert_New_Klant.php",
        method: "POST",
        data:{Voornaam:Voornaam,Achternaam:Achternaam,Email:Email,Telefoon:Telefoon,Geboorte_Datum:Geboorte_Datum},
        success: function(data){
            alert(data);
            location.reload();
        }
    });
});
$(document).on('click', '#edit_row', function(){
    // Get current row
    var cur_row = $(this).closest('tr');
    var id = cur_row.data('id')
    var voornaam = cur_row.children('td.up_fnaam').text();
    var achternaam = cur_row.children('td.up_lnaam').text();
    var mail = cur_row.children('td.up_mail').text();
    var tel = cur_row.children('td.up_tel').text();
    var dob = cur_row.children('td.up_DOB').text();
    console.log(voornaam);
    console.log(achternaam);
    console.log(mail);
    console.log(tel);
    console.log(dob);
    if(voornaam ==="")
    {
        alert("Gelieve een Voornaam op te geven");
        return false;
    }
    if(achternaam ==="")
    {
        alert("Gelieve een Achternaam op te geven");
        return false;
    }
    $.ajax({
        url: "edit_Klanten.php",
        method: "POST",
        data: {
            id:id,
            voornaam:voornaam,
            achternaam:achternaam,
            mail:mail,
            tel:tel,
            dob:dob
        }
    })
    .done(function(data){
        $('.success_msg').html(data);
        $('#up_success').modal({
            keyboard: true,
            show: true
        });
            
    });
});
$(document).on('click', '#up_modal', function(){
    $('#up_success').modal('hide');
    location.reload();
});
        


        


</script>
</body>
</html>

