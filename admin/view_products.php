<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
    ini_set('display_errors', 'On');
    require 'functions/functions.php';
    
    if (empty($_SESSION['admin_email']))
        echo "<script> window.location ='./login.php';</script>";
?>

<!DOCTYPE html>
<html lang="">
<head>
       <?php include "header.php"; ?>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>
    <title> Show Products </title>

</head>


<body>

<div class="container wrapper">

    <img src="images/banner.png" class="img-responsive" width="100%" height="250">

    <?php include "menu.php"; ?>

    <div class="jumbotron main">
        <div class="row" data-ng-app="" data-ng-controller="Products">
            <header>
                <p class="text-center h1"> List of Products </p>
            </header>

               <table id="product_table" class="table table-hover table-striped" ng-table="tableParams">
                    <col width="20%"></col>
                    <col width="60%"></col>
                    <col width="20%"></col>
                    <thead>
                        <tr>
                            <th>Prodcut Details</th>
                            <th>Product Description</th>
                            <th>Product Image</th>
                        </tr>
                    </thead>
                    <tbody>

                              <tr data-ng-repeat='product in products'>
                                    <td>
                                        <dl class='dl-horizontal'>
                                            <dt> Title: </dt>
                                                <dd> {{ product.title }} </dd>
                                            <dt> Category: </dt>
                                                <dd> {{ product.category }} </dd>
                                            <dt> Brand: </dt>
                                                <dd> {{ product.brand }}</dd>
                                            <dt> Price: </dt>
                                                 <dd> {{ product.price | currency}}</dd>
                                        </dl>
                                    </td>
                                    <td class='description'>{{ product.description }}</td>
                                    <td class='text-center'> <img data-ng-src='functions/product_image/{{ product.image }}' width='120' height='80'/> </td>
                              </tr>
                    </tbody>
                </table>
        </div>
    </div>

    <!-- FOOTER STARTS -->
    <div class="row footer">

        <?php include "footer.php"; ?>

    </div>
    <!-- FOOTER ENDS -->
</div>
<!-- jQuery Form Validation code -->
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.1.47/jquery.form-validator.min.js"></script>
<script src="js/script.js"></script>

<script> 

        $("#products").addClass("active");

        function Products($scope, $http) {
           
            $http.get("api/files/products.php").success(function(response){
                $scope.products = response;
            });

    }
    
</script>


</script>

</body>
</html>