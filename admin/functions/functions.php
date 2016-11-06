<?php
    include "../api/functions.php";

function insert_new_product($product)
{
      try{
           global $con;
           $result = $con->prepare("insert into products(product_title, product_brand, product_cat, 
                                    product_price, product_image, product_keywords, product_desc)
                                    values(:title,:brand,:category,:price,:image,:keyword,:description);");

           $result->bindParam(':title', $product['title']);
           $result->bindParam(':brand', $product['brand']);
           $result->bindParam(':category', $product['category']);
           $result->bindParam(':price', $product['price']);
           $result->bindParam(':image', $product['image']);
           $result->bindParam(':keyword', $product['keyword']);
           $result->bindParam(':description', $product['description']);

           return $result->execute();
      
       }
  
      catch(PDOException $error){
          echo 'Connection failed: '.$error->getMessage().'.';
          return false;
      }

}  // END OF FUNCTION

function admin_login($admin){ 

     global $con;
    
     try{
            
            $result = $con->prepare("select admin_id, admin_email, admin_name from admin where admin_password=:password and admin_email=:email");
            
            $result->bindParam(':email', $admin['email']);
            $result->bindParam(':password', $admin['password']);

            $result->execute();
         
            if ($result->rowCount()== 0) {
              return false;
            }

             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $email = $row['admin_email'];
                    $id = $row['admin_id'];
                    $name = $row['admin_name'];
             }

            $_SESSION['admin_email'] = $email;
            $_SESSION['admin_name'] = $id;
            $_SESSION['admin_id'] = $id;


             return true;
         }
        catch(PDOException $error){
            echo 'Connection failed: '.$error->getMessage().'.';
            return false;
        }

}//END OF FUNCTION


?>