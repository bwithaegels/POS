<?php include('session.php'); ?>
<?php include('config.php'); ?>
<?php include('functions/functions.php'); ?>

<?php 

    addProduct();
        

?>


<?php include('includes/header.php'); ?>
<?php include('includes/sidebar.php'); ?>


        <div class="success_msg">

        </div>


        <main>
           


             <!--
            
                    Sectie Klanten
            
            -->
            
            <div id="addproduct" class="container-fluid mt-5">
                <div class="row">
                    <div class="col">
                        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                            <h1 class="h2">Product Toevoegen</h1>
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
                    <div class="col">
                        <div class="card card-cascade reverse  my-4 pb-5">
               
                            <div class="card-body card-body-cascade">
                                
                                <div class="row">
                                    
                                    <div class="col-md-9 order2">
                                        
                                        <form action="" method="POST">
                                            
                                            <div class="row">
                                            
                                                <div class="col-md-6">
                                                    
                                                    <div class="md-form mb-4">
                                                    
                                                        <input id="productId" class="form-control" type="text" name="productId">
                                                        <label>Product Code</label> 
                                                    
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    
                                                    <div class="md-form mb-0">
                                                    
                                                        <input id="productName" class="form-control" type="text" name="productName">
                                                        <label for="productName">Product Naam</label> 
                                                    
                                                    </div>
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            <div class="row">
                                            
                                                <div class="col-md-4">
                                                    
                                                    <div class="md-form mb-4">
                                                    
                                                        <input id="purchasePrice" class="form-control" type="number" step=".01" name="purchasePrice">
                                                        <label for="purchasePrice">Aankoop prijs</label> 
                                                    
                                                    </div>
                                                    
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    
                                                    
                                                    
                                                   <div class="md-form">
                                                       
                                                        <input type="checkbox" class="form-check-input form-control" id="SaleProd" name="SaleProd">
                                                        <label class="form-check-label" for="SaleProd">Verkoopsproduct?</label>
                                                        
                                                    </div>
                                                
                                                    
                                                    
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    
                                                    <div class="md-form mb-5">
                                                    
                                                        <select id="CatSlct" name="prodCat" class="mdb-select colorful-select dropdown-ins md-form">
                                                        <option>Selecteer Categorie...</option>
                                                        

                                                            <? selectCat(); ?>
                                                           
                                    
                                                        </select>
                                                    
                                                    </div>
                                                    
                                                </div>
                                            
                                            </div>
                                            
                                            
                                            <div class="row">
                                                
                                                <div class="col">
                                                    
                                                    <div class="md-form">
                                                    
                                                        <textarea id="productInfo" class="md-textarea form-control" rows="4" name="productInfo"></textarea>
                                                        <label for="productInfo">Product Info</label>
                                                        
                                                    </div>
                                                    
                                                </div>
                                                
                                            </div>
                                            
                                            <div class="row">
                                                
                                                <div class="col mr-auto">
                                                    
                                                    <input name="submit" type="submit" id="prodAdd" class="btn btn-xs btn-success float-right" value="Voeg Toe">
                                                    
                                                </div>
                                                
                                            </div>
                                        
                                        </form>
                                        
                                    </div>
                                    
                                    <div class="col-md-3 order1">
                                        
                                        
                                        
                                    </div>
                                    
                                </div>    
                               
                            </div>
                            <!--<div class="card-footer">-->
                            <!--    <input name="submit" type="submit" id="btn_add" class="btn btn-xs btn-success float-right" value="Voeg Toe">-->
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>


        </main>










































<?php include('includes/scripts.php'); ?>
 <script>

 </script>
<?php include('includes/footer.php'); ?>
