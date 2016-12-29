<?php
    header('Content-Type: application/json'); 

    include "../functions.php";


    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    $id = $request->id;

	$id = (int) strip_tags( trim( $id ) );

     try{
            $result = $con->prepare('select product_id, product_title, product_brand, product_price,
										product_cat, product_image, product_keywords,
										product_desc from products where product_id = :id');

            $result->bindParam(':id', $id);
            $result->execute();
            
            $product = array();
            $link = array();

             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

	              $link = array('id'=> $row['product_id'], 'title'=> $row['product_title'],
	              				'brand'=> $row['product_brand'], 'category' => $row['product_cat'],
	              				'image'=> $row['product_image'], 'keywords' => $row['product_keywords'],
	              				'description' => $row['product_desc'], 'price'=> $row['product_price']);

	              array_push($product, $link);
             }

             echo json_encode($product);
         }
    
        catch(PDOException $error){
            echo 'Connection failed: '.$error->getMessage().'.';
            return false;
        }

?>