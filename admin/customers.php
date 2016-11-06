<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
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

    <title> Cutomers </title>

</head>


<body>

<div class="container wrapper">

    <img src="images/banner.png" class="img-responsive" width="100%" height="200">

    <?php include "menu.php" ?>

    <div class="jumbotron main">
        <div class="row">
            <header>
                <p class="text-center h1"> Customers </p>
            </header>

       <table id="product_table" class="table table-hover table-striped" ng-table="tableParams">
            <thead>
                <tr>
                    <th> Name </th>
                    <th> Email </th>
                    <th> Phone </th>
                    <th> Actions </th>
                </tr>
            </thead>
            <tbody data-ng-app="" data-ng-controller="Customers">
                <tr data-ng-repeat="customer in customers"> 
                     <td> {{ customer.name }} </td>
                     <td> {{ customer.email }} </td>
                     <td> {{ customer.phone }} </td>
                     <td class="action"> <span id="edit" class="text-center" data-ng-click="edit.doClick()"> Edit </span>
                        <span id="remove" class="text-center" data-ng-click="remove.doClick()"> Remove </span> 
                    </td>
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

        $('#customers').addClass("active");

        function Customers($scope, $http) {
           
            $http.get("api/files/customers.php").success(function(response){
                $scope.customers = response;
            });

        $scope.edit  = {};
        $scope.remove  = {};

        $scope.edit.doClick = function(){
           alert('hsdfjdsflkjsdfl');
        }
          $scope.remove.doClick = function(){
           alert('hsdfjdsflkjsdfl');
        }
        
        }

</script>

</body>
</html>
