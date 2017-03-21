<!DOCTYPE html>
<html>
<head>

    <script>if (window.location.protocol !== 'https:'){window.location = 'https://'+window.location.hostname+window.location.pathname;}</script>
    <?php
        if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
        ini_set('display_errors', 'On');
        ini_set('file_uploads', 'On');
        require 'functions/functions.php';

        if(empty($_SESSION['admin_email']))
            echo "<script> window.location ='./login.php';</script>";


        if(isset($_POST['c_name'])){

            $target_dir = "../img/categories/";
            $target_file = $target_dir . basename($_FILES["c_image"]['name']);
            $upload_ok = 1;
            $image_type = pathinfo($target_file, PATHINFO_EXTENSION);


            // Check if image file is a actual image or fake image
            $check = getimagesize($_FILES["c_image"]["tmp_name"]);
            if ($check === false) {
                $upload_ok = 0;
                $error_msg = "File is not an image.";
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                $upload_ok = 0;
                $error_msg = "This file already exists.";
            }

            // Check file size
            if ($_FILES["c_image"]["size"] > 200000) {
                $upload_ok = 0;
                $error_msg = "File is large than 200kb.";
            }

            // Allow certain file formats
            if ($image_type != "jpg" && $image_type != "png" && $image_type != "jpeg"
                && $image_type != "gif" ){
                $upload_ok = 0;
                $error_msg = "Only JPG, JPEG, PNG & GIF files are allowed";
            }



            $new_category = $_POST['c_name'];
            $c_image = $_FILES["c_image"];
            move_uploaded_file($_FILES["c_image"]['tmp_name'],"../img/categories/".basename($_FILES["c_image"]['name']));
            $c_image = $_FILES["c_image"]['name'];

            $result = insert_new_category($new_category, $c_image);

            if($result)
                echo "<script>window.location='./index.php?category_inserted';</script>";
            else
                echo "<script> alert('Oops something went wrong.'); </script>";
        }
    ?>
    <?php include "header.php"; ?>
    <title> Add new Category </title>

</head>


<body>

<div class="container wrapper">

    <img src="images/banner.png" class="img-responsive" height="250" alt="banner">

    <?php include "menu.php"; ?>

    <div class="jumbotron main">
        <div class="row">
            <header>
                <p class="text-center h1"> Add new Category </p>
            </header>

            <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"
                  id="category-form" enctype="multipart/form-data">

                <div class="form-group">
                    <label for="c_name" class="col-xs-4 control-label"> Category Name </label>

                    <div class="col-xs-5">
                        <input type="text" class="form-control" id="c_name" placeholder="Category name" name="c_name"
                               data-validation="required" autocomplete="off">
                        <p id="cat_suggestion"> </p>
                    </div>
                </div>

                <div class="form-group">
                    <label for="c_image" class="col-xs-4 control-label"> Category Image </label>

                    <div class="col-xs-6">
                        <input type="file" class="filestyle" id="c_image" name="c_image"
                               data-input="false" data-buttonName="btn-default" data-validation="required">
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