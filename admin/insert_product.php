<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
ini_set('display_errors', 'On');
require 'functions/functions.php';

if (empty($_SESSION['admin_email']))
    echo "<script> window.location ='./login.php';</script>";

if (isset($_POST['submit'])) {

    $p_title = $_POST['p_title'];
    $p_category = $_POST['p_category'];
    $p_brand = $_POST['p_brand'];
    
    $p_price = $_POST['p_price'];
    $p_description = $_POST['p_description'];
    $p_keyword = $_POST['p_keyword'];

    $p_image = $_FILES["p_image"];
    move_uploaded_file($_FILES["p_image"]['tmp_name'],"api/product_image/".$_FILES["p_image"]['name']);
    $p_image = $_FILES["p_image"]['name'];

    $product = array("title"=>$p_title,"category"=>$p_category,"brand"=>$p_brand,
                     "image"=>$p_image,"price"=>$p_price,"description"=>$p_description,"keyword"=>$p_keyword);

    $result = insert_new_product($product);

    if ($result)
        echo "<script>window.location='./index.php?product_inserted';</script>";
    else
        echo "<script> alert('Oops something went wrong.'); </script>";
    }
?>

<!DOCTYPE html>
<html lang="">
<head>

    <?php include "header.php"; ?>
    <title> Add new Product </title>

</head>


<body>

<div class="container wrapper">

    <img src="images/banner.png" class="img-responsive" width="100%" height="250">

    <?php include "menu.php"; ?>

    <div class="jumbotron main">
        <div class="row">
            <header>
                <p class="text-center h1"> Add new Product </p>
            </header>

            <form class="form-horizontal" role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                  id="product-form" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="p_title" class="col-xs-4 control-label"> Product Title </label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control" id="p_title" placeholder="Product Title" name="p_title"
                               data-validation="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="p_category" class="col-xs-4 control-label"> Product Category </label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control" id="p_category" placeholder="Product Category"
                               name="p_category" data-validation="required">
                        <p id="cat_suggestion"> </p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="p_brand" class="col-xs-4 control-label"> Product Brand </label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control" id="p_brand" placeholder="Product Brand" name="p_brand">
                    </div>
                </div>

                <div class="form-group">
                    <label for="p_image" class="col-xs-4 control-label"> Product Image </label>

                    <div class="col-xs-6">
                        <input type="file" class="filestyle" id="p_image" name="p_image"
                               data-input="false" data-buttonName="btn-default" data-validation="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="p_price" class="col-xs-4 control-label"> Product Price </label>

                    <div class="col-xs-6">
                        <input type="numeric" class="form-control" id="p_price" placeholder="Product Price"
                               name="p_price" data-validation="required" data-validation="number"
                               data-validation-allowing="float" data-validation-decimal-separator=","/>
                    </div>
                </div>

               

                <div class="form-group">
                    <label for="p_keyword" class="col-xs-4 control-label"> Product Keywords </label>

                    <div class="col-xs-6">
                        <input type="text" class="form-control" id="p_keyword" placeholder="Product Keyword"
                               name="p_keyword" data-validation="required">
                    </div>
                </div>

                <div class="form-group">
                    <label for="p_description" class="col-xs-4 control-label"> Product Description </label>

                    <div class="col-xs-6">
                        <textarea id="p_description" name="p_description" class="form-control" rows="10"
                                  placeholder="Description..." data-validation="required"></textarea>
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
    
    $("#p_category").keyup(function(){
    $.ajax({
        url:"suggestions/category.php?categories="+ $("#p_category").val(),
        success:function(result){
        $("#cat_suggestion").html(result);
        }});
    });

    $("#new_product").addClass("active");

</script>

</body>
</html>