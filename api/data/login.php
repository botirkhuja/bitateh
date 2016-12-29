<?php
    if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
     header('Content-Type: application/json'); 
	  include "../functions.php";
	 ini_set('display_errors', 'On');

    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

     $email = $request->email;
     $password = $request->password;

     try{
             $result = $con->prepare('select customer_name, customer_email, customer_id from customers where 
            						customer_email=:email and customer_password=:password');

            $result->bindParam(':email', $email);
            $result->bindParam(':password', $password);

            $result->execute();

            $user = array();
            $link = array();

            if ($result->rowCount() == 1) {
	             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
	             	$name = explode(" ", $row['customer_name']);

	             	$link = array('email' => $row['customer_email'],
	             					'firstname'=> $name[0], 'lastname'=> $name[1]);


                    $_SESSION['firstname'] = $name[0];
                    $_SESSION['lastname'] = $name[1];
                    $_SESSION['email'] = $link['email'];
                    
	             	array_push($user, $link);
	             }
	             echo json_encode($link);
         	}

             else 
              	echo json_encode($result->rowCount());;
            
         }
    
        catch(PDOException $error){
            echo 'Connection failed: '.$error->getMessage().'.';
            return false;
        }

?>

