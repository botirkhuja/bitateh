<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
     header('Content-Type: application/json'); 
	  include "../functions.php";
	 ini_set('display_errors', 'On');

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

/*    if($_SESSION['code'] !== $request->captcha){
         echo json_encode(array("status" => "failed"));
        return;
    }*/
     $email = $request->email;
     $password = $request->password;
     $name = $request->firstname .' '. $request->lastname;

     try{
           $con->beginTransaction();
           $result = $con->prepare('select count(customer_email) count from customers where customer_email=:email; insert into customers(customer_name, customer_email, customer_password) values(:name, :email, :password);');

            $result->bindParam(":name", $name);
            $result->bindParam(":email", $email);
            $result->bindParam(":password", $password);
            $result->execute();

            $test = $result->fetchAll(PDO::FETCH_ASSOC);
            $con->rollBack();

            if($test[0]['count'] == 0)
                echo json_encode(array("status" => "success"));
            else
                echo json_encode(array("status" => "failed"));
         }
    
        catch(PDOException $error){
            echo 'Connection failed: '.$error->getMessage().'.';
            return false;
        }

?>


