<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
ini_set('display_errors', 'On');

require 'functions/functions.php';
     if(empty($_SESSION['admin_email']))
        echo "<script> window.location ='./login.php';</script>";

    if(isset($_POST['submit'])){

        $new_brand = $_POST['brand'];
        $result = insert_new_brand($new_brand);
        if($result)
            echo "<script>window.location='./index.php?brand_inserted';</script>";
        else
            echo "<script> alert('The Brand already exit in the database.'); </script>";
    } 
?>

<!DOCTYPE html>
<html lang="">
<head>

    <?php include "header.php"; ?>
    <title> Add new Brand </title>

</head>


<body>

<div class="container wrapper">

    <img src="images/banner.png" class="img-responsive" width="100%" height="250">

    <ul class="nav nav-tabs">
        <li ><a href="index.php"> Home <span class="glyphicon glyphicon-home"></span></a></li>
        <li><a href="view_products.php"> Products </a></li>
        <li><a href="insert_product.php"> New Product </a></li>
        <li><a href="view_categories.php"> Categories </a></li>
        <li><a href="insert_category.php"> New Category</a></li>
        <li><a href="view_brands.php"> Brands </a></li>
        <li class="active"><a href="insert_brand.php"> New Brand </a></li>
        <li><a href="customers.php"> Customers </a></li>
        <li><a href="view_orders.php"> Orders </a></li>
        <li><a href="view_payment.php"> Payments </a></li>
        <li><a  id="logout" > Logout </a></li>
    </ul>

    <div class="jumbotron main">
        <div class="row">
            <header>
                <p class="text-center h1"> Add new Brand </p>
            </header>

            <form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                  id="brand-form">

                <div class="form-group">
                    <label for="brand" class="col-xs-4 control-label"> Brand Name </label>

                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="brand" placeholder="Brand name" name="brand"
                               data-validation="required" autocomplete="off">
                        <p id="suggestions"> </p>
                    </div>
                </div>

                <div class="form-group">
                   &nbsp;&nbsp; <button type="submit" class="btn btn-md btn-primary col-xs-offset-4" value="submit" name="submit"> &nbsp;
                        <span class="glyphicon glyphicon-floppy-saved"></span> Submit &nbsp; </button>
                </div>
            </form>
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
    $.validate(); 

    $("#brand").keyup(function(){

    $.ajax({
        url:"suggestions/brand.php?brands="+ $("#brand").val(),
        success:function(result){
        $("#suggestions").html(result);
        }});
    });

    

</script>

</body>
</html>