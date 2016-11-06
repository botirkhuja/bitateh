<?php
if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
ini_set('display_errors', 'On');
require 'functions/functions.php';

    if(empty($_SESSION['admin_email']))
        echo "<script> window.location ='./login.php';</script>";

    if(isset($_POST['c_name'])){

        $new_category = $_POST['c_name'];
        $result = insert_new_categories($new_category);

        if($result)
            echo "<script>window.location='./index.php?category_inserted';</script>";
        else
            echo "<script> alert('Oops something went wrong.'); </script>";
    } 
?>

<!DOCTYPE html>
<html lang="">
<head>

    <?php include "header.php"; ?>
    <title> Add new Category </title>

</head>


<body>

<div class="container wrapper">

    <img src="images/banner.png" class="img-responsive" width="100%" height="250">

    <ul class="nav nav-tabs">
        <li ><a href="index.php"> Home <span class="glyphicon glyphicon-home"></span></a></li>
        <li><a href="view_products.php"> Products </a></li>
        <li><a href="insert_product.php"> New Product </a></li>
        <li><a href="view_categories.php"> Categories </a></li>
        <li class="active"><a href="insert_category.php"> New Category</a></li>
        <li><a href="view_brands.php"> Brands </a></li>
        <li><a href="insert_brand.php"> New Brand </a></li>
        <li><a href="customers.php"> Customers </a></li>
        <li><a href="view_orders.php"> Orders </a></li>
        <li><a href="view_payment.php"> Payments </a></li>
        <li><a  id="logout" > Logout </a></li>
    </ul>

    <div class="jumbotron main">
        <div class="row">
            <header>
                <p class="text-center h1"> Add new Category </p>
            </header>

            <form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                  id="category-form">

                <div class="form-group">
                    <label for="c_name" class="col-xs-4 control-label"> Category Name </label>

                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="c_name" placeholder="Category name" name="c_name"
                               data-validation="required" autocomplete="off">
                        <p id="cat_suggestion"> </p>
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
    
    $("#c_name").keyup(function(){
    $.ajax({
        url:"suggestions/category.php?categories="+ $("#c_name").val(),
        success:function(result){
        $("#cat_suggestion").html(result);
        }});
    });

</script>

</body>
</html>