$( document ).ready(function() {
    
    $('#selbeh').click( function(){
        
        $('.sercopas').removeClass('d-none');
        $('.sercopap').addClass('d-none');
        $('.salcopa').addClass('d-none');
        $(this).addClass('active');
        $('#selpro').removeClass('active');
        
    });
    
    $('#selpro').click( function(){
        $('.sercopap').removeClass('d-none');
        $('.sercopas').addClass('d-none');
        $('.salcopa').addClass('d-none');
        $(this).addClass('active');
        $('#selbeh').removeClass('active');
    });
    
    $('.md-tabs a[href*="#"]').on('click', function () {
        var showDiv = $($(this).attr('href'));

        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        $('.salcopa').removeClass('d-none');
        $('.salcoprod').addClass('d-none');
        $('.arr').removeClass('shown');
        $('.prod').removeClass('shown');
        $(showDiv).addClass('shown');
    });
//    $('.prod button').on('click', function (){
//        
//        $('.salcoprod').removeClass('d-none');
//    });
    $('.arr button').on('click', function () {
        var klantid = $("#SelectCust option:selected").val();
        var price = $(this).data("price");
        var beh = $(this).data("beh");
        var typ = $(this).data("soort");
        var fullDate = new Date();
        //Thu May 19 2011 17:25:38 GMT+1000 {}
        //convert month to 2 digits
        var twoDigitMonth = !((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
        //var currentYear = fullDate.getFullYear();
        var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();
        //19/05/2011
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    //
    // 2. Berekenen van de totale waarde van de uitgevoerde behandelingen
    //
        var sum = $(".sum").text();
        if ($(".sum").is(':empty')) {
            $(".sum").append(price);
            
            var income = parseFloat(price/1.21).toFixed(2);
            $(".income").append(income);
             var btw = parseFloat(price/1.21 * 0.21).toFixed(2);
            $(".btw").append(parseFloat(btw));
            $(".date").append(currentDate);
        } else {
            var newprice = parseFloat(sum) + parseFloat(price);
            var newincome = parseFloat(newprice / 1.21).toFixed(2);
            $(".income").text(newincome);
            var newbtw = parseFloat(newprice/1.21 * 0.21).toFixed(2);
            $(".sum").text(newprice);
            $(".btw").text(newbtw);
            //var btw = $(".btw").text();
            
        }
        var markup = "<tr><td class='d-none'>"+ klantid +"</td><td>" + currentDate + "</td><td class='d-none'>" + time + "</td><td>" + beh + "</td><td class='eprice'>" + price + "</td><td class='d-none'>" +
            fullDate.getFullYear() + "</td><td class='d-none'>" + typ + "</td><td></td></tr>";
        $(".inner-screen tbody").append(markup);
        $(".inner-screen td").last().addClass("far fa-trash-alt delete");
    });
    /*
    
     1bis. Verwijderen van een lijn uit de screentabel
    
    */
    $(".inner-screen table").on("click", ".delete", function () {
        var minprice = $(this).closest("tr").children("td.eprice").text();
        var sum = $(".sum").text();
        $(this).closest("tr").remove();
    /*
    
     2bis. herberekenen van de totale waarde van de uitgevoerde behandelingen
    
    */
        var neweprice = parseFloat(sum) - parseFloat(minprice);
        var newincome = parseFloat(neweprice / 1.21).toFixed(2);
        var newbtw= parseFloat(newincome * 0.21).toFixed(2);
        $(".sum").text(neweprice);
        $(".income").text(newincome);
        $(".btw").text(newbtw);
    });
    /*
    
     3 Transactie Annuleren + alle velden leegmaken.
    
    */
    $(".cancel").on("click", function () {
        $("#screenBody").empty();
        $("#tbltotals tbody td").empty();
        $("#txt").val("");
    });
    /*
    4   Transactie valideren
        Tabel in array plaatsen en verzenden naar database
        Alle velden leegmaken
    */
    $(".pay").on("click", function () {
        var klantid = $("#SelectCust option:selected").val();
        var fullDate = new Date();
        var myTableArray = [];
        var transTotaal = $(".sum").text();
        var transDate= $(".date").text();
        var transYear = fullDate.getFullYear();
        var periode = $(".btw").data("periode");
        var omzet = $(".income").text();
        var btw = $(".btw").text();
        $("#screenBody tr").each(function () {
            var arrayOfRow = [];
            var tableData = $(this).find("td:not(:last)");
            if (tableData.length > 0) {
                tableData.each(function () {
                    '(' + arrayOfRow.push($(this).text()) + ')';
                });
                myTableArray.push('(' + arrayOfRow + ')');

            }
        });
        console.log(periode);
        console.log(btw);

                
        $.ajax({
            type: "POST",
            url: "php/verkopen.php",
            data: {
                id: myTableArray,
                klantid: klantid,
                date: transDate,
                sum: transTotaal,
                year: transYear,
                btw: btw,
                periode: periode,
                omzet: omzet
            },
            async: true
            })
            .done(function(msg) {
                $(".savemsg").html(msg);
            });
        
        
        
               
        //$(".selected").text("");
        $("#txt").empty();
        $("#screenBody").empty();
        $("#tbltotals tbody td").empty();
    });
    
$(document).on('click', '#btn_aNK', function(){
        // Get current row
        var Voornaam = $("#aVN").val();
        var Achternaam = $("#aAN").val();
        var Email = $("#aEM").val();
        var Telefoon = $("#aPN").val();
        var Geboorte_Datum = $("#aGD").val();
        var Info = $("#aEI").val();

        if(Voornaam ==="")
        {
            alert("Gelieve een Voornaam op te geven");
            return false;
        }
        if(Achternaam ==="")
        {
            alert("Gelieve een Achternaam op te geven");
            return false;
        }
        $.ajax({
            url: "add_klant.php",
            method: "POST",
            data: {
                Voornaam:Voornaam,
                Achternaam:Achternaam,
                Email:Email,
                Telefoon:Telefoon,
                Geboorte_Datum:Geboorte_Datum,
                Info:Info
            },
        success: function(data){
            $('.success_msg').html(data);
            $('#up_success').modal({
                keyboard: true,
                show: true
            });
            $('#modalAddKlant').modal('hide');
                
        },
        error: function(response){
            $('.success_msg').html(response);
            $('#up_error').modal('show');
            $('#modalAddKlant').modal('hide');
        }
    });
    });
    $(document).on('click', '#up_modal', function(){
        $('#up_success').modal('hide');
        location.reload();
    });

});