<?php

ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

     header('Content-Type: application/json'); 
     include "../../../api/functions.php";

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $category = $request->category;

    if(isset($category) && $category != 'all'){

        $category =  "%".strip_tags( trim( $category ) )."%";
    }
    else
        $category = "%";   
 

     try{
            $result = $con->prepare('select product_id, product_title, product_brand,
                                        product_cat, product_image, product_keywords,product_price,
                                        product_desc from products where product_keywords 
                                        like :category');

            $result->bindParam(':category', $category);
            $result->execute();
            
            $product = array();
            $link = array();

             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                  $link = array('id'=> $row['product_id'], 'title'=> $row['product_title'],
                                'brand'=> $row['product_brand'], 'category' => $row['product_cat'],
                                'image'=> $row['product_image'], 'keywords' => $row['product_keywords'],
                                'description' => $row['product_desc'], 'price' => $row['product_price']);

                  array_push($product, $link);
             }

             echo json_encode($product);
         }
    
        catch(PDOException $error){
            echo 'Connection failed: '.$error->getMessage().'.';
            return false;
        }

?>