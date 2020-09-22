<?php include('session.php'); ?>
<?php include('config.php'); ?>
<?php include_once('functions/functions.php'); ?>



<?php
    global $mysqli;

    $query = "Select count(Type) as counter from aankopen where Type = 'O' ";

    $sql = mysqli_query($mysqli, $query);
    $row = mysqli_fetch_assoc($sql);
    $counter = $row['counter'] +1;

?>
<?php 

addPurchase();

?>


<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>



<main>


    <div id="addPurchase" class="container-fluid mt-5">
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">Aankoop Registreren</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group mr-2">
                            <a href="klanten.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-user"></i></a>
                            <a href="dashboard.php" class="btn btn-sm btn-outline-secondary"><i class="fas fa-home"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-xl-8">
                <div class="card card-cascade reverse  my-4 pb-5">

                    <div class="card-body card-body-cascade">

                        <div class="row">

                            <div class="col">

                                <form action="" method="POST">
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-5">
                                        
                                            <div class="md-form mb-4">


                                                <div class="form-check">
                                                    
                                                    <input type="checkbox" class="form-check-input" id="checkFactuur" name="aankooptype">
                                                    <label class="form-check-label" for="checkFactuur">Factuur</label>
                                                    
                                                </div>
                                                
                                                
                                            </div>
                                                    
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-5 col-xl-4 factgeg d-none">

                                            <div class="md-form mb-4">

                                                <input id="LevId" class="form-control" type="text" name="LevId">
                                                <label for="LevId">Leverancier</label>

                                            </div>

                                        </div>

                                        <div class="col-md-5 col-xl-4 factgeg d-none">

                                            <div class="md-form mb-4">

                                                <input id="FactNr" class="form-control" type="text" name="FactNr">
                                                <label for="FactNr">Factuur nummer</label>

                                            </div>

                                        </div>
                                        
                                        <div class="col-md-2 col-xl-2 d-none">

                                            <div class="md-form mb-4">

                                                <input id="OnkNr" class="form-control" type="text" name="counter" value="<?php echo $counter; ?>"/>
                                                <label for="OnkNr">Referte</label>

                                            </div>

                                        </div>


                                        
                                    </div>
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-5 col-xl-4">
                                            
                                            <div class="md-form mb-4">
                                                
                                                <input id="FactDate" class="form-control datepicker" type="date" name="FactDate">
                                                <label for="FactDate">Factuur Datum</label>
                                                
                                            </div>
                                            
                                        </div>
                                        
                                    </div>
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-5 col-xl-4">

                                            <div class="md-form mb-4">

                                                <input id="FactMvh" class="form-control" type="number" step=".01" name="FactMvh">
                                                <label for="FactMvh">Bedrag</label>

                                            </div>

                                        </div>
                                        
                                        <div class="col-md-5 col-xl-4">

                                            <div class="md-form mb-4">

                                                <input id="FactBtw" class="form-control" type="number" step=".01" name="FactBtw">
                                                <label for="FactBtw">Btw Bedrag</label>

                                            </div>

                                        </div>
                                        
                                        
                                    </div>
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-10 col-xl-8">

                                            <div class="md-form mb-0">

                                                <input id="PurDescript" class="form-control" type="text" name="Omschrijving">
                                                <label for="PurDescript">Omschrijving</label>

                                            </div>

                                        </div>
                                        
                                    </div>



                                   

                                    <div class="row">

                                        <div class="col mr-auto">

                                            <input name="submit" type="submit" id="purAdd" class="btn btn-xs btn-success float-right" value="Voeg Toe">

                                        </div>

                                    </div>

                                </form>

                            </div>



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>


</main>










<?php include('includes/scripts.php'); ?>
<script>
    $(document).ready(function() {
        $('.datepicker').pickadate({
            // Strings and translations
            monthsFull: ['Januari', 'Februari', 'Maart', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September', 'Oktober',
                'November', 'December'
            ],
            monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Dec'],
            weekdaysFull: ['Zondag', 'Maandag', 'Dinsdag', 'Woensdag', 'Donderdag', 'Vrijdag', 'Zaterdag'],
            weekdaysShort: ['Zo', 'Ma', 'Di', 'Wo', 'Do', 'Vr', 'Za'],
            showMonthsShort: undefined,
            showWeekdaysFull: undefined,

            // Buttons
            today: 'Vandaag',
            clear: 'Clear',
            close: 'Sluit',

            // Accessibility labels
            labelMonthNext: 'Volgende maand',
            labelMonthPrev: 'Vorige maand',
            labelMonthSelect: 'Selecteer maand',
            labelYearSelect: 'Selecteer jaar',

            // Formats
            format: 'yyyy-mm-d',
            formatSubmit: 'yyyy-mm-d',
            hiddenPrefix: undefined,
            hiddenSuffix: '_submit',
            hiddenName: undefined,

            // Editable input
            editable: undefined,

            // Dropdown selectors
            selectYears: undefined,
            selectMonths: undefined,

            // First day of the week
            firstDay: undefined,

            // Date limits
            min: undefined,
            max: undefined,

            // Disable dates
            disable: undefined,

            // Root picker container
            container: undefined,

            // Hidden input container
            containerHidden: undefined,

            // Close on a user action
            closeOnSelect: true,
            closeOnClear: true,

            // Events
            onStart: undefined,
            onRender: undefined,
            onOpen: undefined,
            onClose: undefined,
            onSet: undefined,
            onStop: undefined,

            // Classes
            class: {

                // The element states
                input: 'picker__input',
                    active: 'picker__input--active',

                    // The root picker and states *
                    picker: 'picker',
                    opened: 'picker--opened',
                    focused: 'picker--focused',

                    // The picker holder
                    holder: 'picker__holder',

                    // The picker frame, wrapper, and box
                    frame: 'picker__frame',
                    wrap: 'picker__wrap',
                    box: 'picker__box',

                    // The picker header
                    header: 'picker__header',

                    // Month navigation
                    navPrev: 'picker__nav--prev',
                    navNext: 'picker__nav--next',
                    navDisabled: 'picker__nav--disabled',

                    // Month & year labels
                    month: 'picker__month',
                    year: 'picker__year',

                    // Month & year dropdowns
                    selectMonth: 'picker__select--month',
                    selectYear: 'picker__select--year',

                    // Table of dates
                    table: 'picker__table',

                    // Weekday labels
                    weekdays: 'picker__weekday',

                    // Day states
                    day: 'picker__day',
                    disabled: 'picker__day--disabled',
                    selected: 'picker__day--selected',
                    highlighted: 'picker__day--highlighted',
                    now: 'picker__day--today',
                    infocus: 'picker__day--infocus',
                    outfocus: 'picker__day--outfocus',

                    // The picker footer
                    footer: 'picker__footer',

                    // Today, clear, & close buttons
                    buttonClear: 'picker__button--clear',
                    buttonClose: 'picker__button--close',
                    buttonToday: 'picker__button--today'
            }
        });
        
        
        
        $("#checkFactuur").on("change", function(){
           
            $(".factgeg").toggleClass('d-none');
            
            
        });
        
        
        var counter = 0;

        $("#addrow").on("click", function () {
            var newRow = $("<tr id='row-"+ counter + "'>");
            var cols = "";

            cols += '<td><input type="text" class="form-control" name="prodId"></td>';
            cols += '<td><input type="number" class="form-control" name="purUnit"></td>';
            cols += '<td><input type="number" class="form-control" name="purPrice"></td>';
            cols += '<td><input type="number" class="form-control" name="purTotal"></td>';

            cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger"  value="Delete"></td>';
            newRow.append(cols);
            $("table.table-borderless").append(newRow);
            counter++;
        });



        $("table.table-borderless").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            counter -= 1
        });
        
        
        
    });
    
    function calculateRow(row) {
        var price = +row.find('input[name^="price"]').val();

    }

    function calculateGrandTotal() {
        var grandTotal = 0;
        $("table.order-list").find('input[name^="price"]').each(function () {
            grandTotal += +$(this).val();
        });
        $("#grandtotal").text(grandTotal.toFixed(2));
    }
    
    var datum = $("#FactDate").val();
    console.log(datum);
    

</script>
<?php include('includes/footer.php'); ?>
