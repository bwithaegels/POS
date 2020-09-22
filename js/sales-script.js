$( document ).ready(function() {
    $('.nav-pills a[href*="#"]').on('click', function () {
        var showDiv = $($(this).attr('href'));

        $('.nav-link').removeClass('active');
        $(this).addClass('active');
        $('.arr').removeClass('shown');
        $(showDiv).addClass('shown');
    });
    $('.arr button').on('click', function () {
        var klantid = $("#SelectCust option:selected").val();
        var price = $(this).data("price");
        var beh = $(this).data("beh");
        var fullDate = new Date();
        console.log(fullDate);
        //Thu May 19 2011 17:25:38 GMT+1000 {}
        //convert month to 2 digits
        var twoDigitMonth = !((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
        //var currentYear = fullDate.getFullYear();
        var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();
        console.log(currentDate);
        //19/05/2011
        var dt = new Date();
        var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
    //
    // 2. Berekenen van de totale waarde van de uitgevoerde behandelingen
    //
        // var sum = $(".sum").text();
        // if ($(".sum").is(':empty')) {
        //     $(".sum").append(price);
        //     $(".date").append(currentDate);
        // } else {
        //     var newprice = parseFloat(sum) + parseFloat(price);
        //     $(".sum").text(newprice);
        // }
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
        var markup = "<tr><td class='d-none'>"+ klantid +"</td><td>" + currentDate + "</td><td>" + time + "</td><td>" + beh + "</td><td class='eprice'>" + price + "</td><td class='d-none'>" +
            fullDate.getFullYear() + "</td><td></td></tr>";
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
        var newbtw= parseFloat(neweprice/1.21 * 0.21).toFixed(2);
        $(".sum").text(neweprice);
        $(".income").text(newincome);
        $(".btw").text(newbtw);
    });
    /*
    
     3 Transactie Annuleren + alle velden leegmaken.
    
    */
    $(".cancel").on("click", function () {
        //var name = $(this).closest('tr').find('.contact_name').text();
        $("#screenBody").empty();
        $("#tbltotals tbody td").empty();
//        $("#SalHist").empty();
        $("#txt").val("");
//        $("#CusInfo input[name='name']").val("");
//        $("#CusInfo input[name='Informatie']").val("");
    });
    /*
    
    4   Transactie valideren
        Tabel in array plaatsen en verzenden naar database
        Alle velden leegmaken
    */
    $(".pay").on("click", function () {
        var klantid = $("#SelectCust option:selected").val();
        var fullDate = new Date();
//        console.log(fullDate);
//        //Thu May 19 2011 17:25:38 GMT+1000 {}
//        //convert month to 2 digits
//        var twoDigitMonth = !((fullDate.getMonth().length + 1) === 1) ? (fullDate.getMonth() + 1) : '0' + (fullDate.getMonth() + 1);
//        //var currentYear = fullDate.getFullYear();
//        var currentDate = fullDate.getFullYear() + "-" + twoDigitMonth + "-" + fullDate.getDate();
//        console.log(currentDate);
//        //19/05/2011
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
    $(".NewCus").on("click", function(){
       $("#NewCus").show(); 
    });
    $(".close").on("click", function(){
        $("#SelectCust").prop('disabled', false);
        var $form = $(this).closest('form');
        $form.hide();
    });
    $(".CusCard").on("click", function(){
        var $id = $("#SelectCust option:selected").val();
        $("#klantKaart").show();
        $("#SelectCust").prop('disabled', true);
        $.ajax({
                type:"post",
                url: "php/cSalHist.php",
                data: {id : $id},
                async: true
            })
            .done(function(msg){
                $(".additional-info").html(msg);
            });
     });
    
    /*
    Bij het selecteren van de klant zal de klantenkaart aangevuld worden met verkoopsgegevens en algemene info.
    
    1. Ophalen van gegevens van selectiebox.
    
    */
    $("#SelectCust").on("change", function selectionchange(){
        $(".cInfo").empty();
        var $id = $("#SelectCust option:selected").val();
        var currentKlant = $("#SelectCust option:selected").text();
        if ($id > 0){
            $(".CusCard").prop('disabled', false);        
            $(".klantNaam").html(currentKlant) ; 

            $.ajax({
                type:"post",
                url: "php/cInfo.php",
                data: {id : $id},
                async: true
            })
            .done(function(msg){
                $(".cInfo").html(msg);
            });
        } else {
            $(".CusCard").attr('disabled', 'disabled');
        }
    });
    //function resize(){    
    //$("#salesChart").outerHeight($(window).height()-$("#salesChart").offset().top- Math.abs($("#salesChart").outerHeight(true) - $("#salesChart").outerHeight()));
  //}
    //resize();
    //$(window).on("resize", function(){                      
    //    resize();
    //});
});