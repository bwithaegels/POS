$(document).ready(function () {
    
    
// dashboard.php

            // Minimalist chart
    $(function () {
        $('.min-chart#chart-mTarget').easyPieChart({
            barColor: function (percent) {
                return (percent < 40 ? '#ff4444' : percent < 80 ? '#ffbb33' : '#00C851');
            },
            onStep: function (from, to, percent) {
              $(this.el).find('.percent').text(Math.round(percent));
            }
          });
          $('.min-chart#chart-yTarget').easyPieChart({
            barColor: function (percent) {
                return (percent < 40 ? '#ff4444' : percent < 80 ? '#ffbb33' : '#00C851');
            },
            onStep: function (from, to, percent) {
              $(this.el).find('.percent').text(Math.round(percent));
            }
          });
      
    });    

    $('.mdb-select').materialSelect();
    // SideNav Button Initialization
    $(".button-collapse").sideNav();
    // SideNav Scrollbar Initialization
    var sideNavScrollbar = document.querySelector('.custom-scrollbar');
    Ps.initialize(sideNavScrollbar);
    
    $(function () {
    $('.material-tooltip-main').tooltip({
      template: '<div class="tooltip md-tooltip-main"><div class="tooltip-arrow md-arrow"></div><div class="tooltip-inner md-inner-main"></div></div>'
    });
  });

//
// Update bestaande klant
    
    $(document).on('click', '#save_row', function(){
        // Get current row
        var id = $("#c_ID").val();
        var voornaam = $("#c_Voornaam").val();
        var achternaam = $("#c_Achternaam").val();
        var email = $("#c_Email").val();
        var telefoon = $("#c_Telefoon").val();
        var dob = $("#c_GebDat").val();


        if(voornaam === "")
        {
            alert("Gelieve een Voornaam op te geven");
            return false;
        }
        if(achternaam === "")
        {
            alert("Gelieve een Achternaam op te geven");
            return false;
        }
        $.ajax({
            url: "edit_klant.php",
            method: "POST",
            data: {
                id:id,
                voornaam:voornaam,
                achternaam:achternaam,
                email:email,
                telefoon:telefoon,
                dob:dob
            },
            success: function(data){
                $('.success_msg').html(data);
                $('#up_success').modal({
                    keyboard: true,
                    show: true
                });
                $('#modalEditCustomer').modal('hide');
            }

        });
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
    
    
    // Add Products
    $(document).on('click', '#btn_NP', function(){
        // Get current row
        var prodId = $("#productId").val();
        var prodName = $("#productName").val();
        var purchasePrice = $("#purchasePrice").val();
        var SaleProd = $("#SaleProd").val();
        var salesPrice = $("#salesPrice").val();
        var productInfo = $("#productInfo").val();
        console.log(prodId);
        console.log(prodName);
        console.log(purchasePrice);
        console.log(SaleProd);
        console.log(salesPrice);
        console.log(productInfo);

        
        $.ajax({
            url: "add_prod.php",
            method: "POST",
            data: {
                prodId:prodId,
                prodName:prodName,
                purchasePrice:purchasePrice,
                SaleProd:SaleProd,
                salesPrice:salesPrice,
                productInfo:productInfo
            },
            success: function(data){
            $('.success_msg').html(data);
            $('#ap_success').modal({
                keyboard: true,
                show: true
            });
            $('#modalAddProduct').modal('hide');
                
            },
            error: function(response){
            $('.success_msg').html(response);
            $('#ap_alert').modal('show');
            $('#modalAddProduct').modal('hide');
            }
        });
    });
    
    $(document).on('click', '#ap_modal', function(){
        $('#ap_success').modal('hide');
        location.reload();
    });
    
    
    $('#chartPeriodSelector').change(function() {
        var periode = $("#chartPeriodSelector option:selected").val();
        console.log(periode);
        $.ajax({
          url: 'minChartMonth.php',
          method: 'POST',
          data: {periode:periode},
          success: function(data){
              $('#monthChart').html("");
              //location.reload();
              $('#monthChart').html(data);
              $('.min-chart#chart-mTarget').easyPieChart({
                    barColor: function (percent) {
                        return (percent < 40 ? '#ff4444' : percent < 80 ? '#ffbb33' : '#00C851');
                    },
                    onStep: function (from, to, percent) {
                      $(this.el).find('.percent').text(Math.round(percent));
                    }
                  });
                  $('.min-chart#chart-yTarget').easyPieChart({
                    barColor: function (percent) {
                        return (percent < 40 ? '#ff4444' : percent < 80 ? '#ffbb33' : '#00C851');
                    },
                    onStep: function (from, to, percent) {
                      $(this.el).find('.percent').text(Math.round(percent));
                    }
                  });
            } 
        });
      
       
    });
});
