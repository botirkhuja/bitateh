<?php
include "connection.php";

///GETTING THE USER'S IP NUMBER
function getIpAddress(){
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {

        $ip = $_SERVER['HTTP_CLIENT_IP'];

    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

    }
    return $ip;

}//END FUNCTION

function redirect($url)
{
    if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }
}

function filter_string($str){
    $str = addslashes( strip_tags( trim( $str ) ) );
    return $str;
}

function filter_number($number){
    $number = (int)addslashes( strip_tags( trim( $number ) ) );
    return $str;
}

function validate_string($str){

    if(preg_match("%^[A-Za-z\.\'\-]{2,40}$%", stripslashes($str)))
        return true;

    return false;
}
function validate_email($email){

    if(preg_match("%^[A-Za-z0-9\.\'\-]+@[A-Za-z0-9\.\'\-]+\.[A-Za-z]{2,4}$%", stripslashes($email)))
        return true;

    return false;
}
function validate_password(){


}

function get_customer($email){
    
    global $con;
    
     try{
            $result = $con->prepare('select customer_email, customer_password, customer_phone, 
                customer_name from customers where customer_email=:email');

            $result->bindParam(':email', $email);
    
            $result->execute();
            
            if ($result->rowCount()== 0) {
                
              return false;
            }

            $customer = array();
             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

                $customer = array('name'=>$row['customer_name'],
                     'email'=>$row['customer_email'],
                     'password'=>$row['customer_password'],
                     'phone'=>$row['customer_phone']);
                $name = explode(" ", $customer['name']);
                $customer['fname'] = $name[0];
                $customer['lname'] = $name[1];
             }


             return $customer;
        }
    
        catch(PDOException $error){
            echo 'Connection failed: '.$error->getMessage().'.';
            return false;
        }

}


function login_customer($customer){ 
    
     try{
            global $con;
            $result = $con->prepare('select customer_email, customer_id from customers where customer_email=:email and customer_password=:password');
            
            $result->bindParam(':email', $customer['email']);
            $result->bindParam(':password', $customer['password']);

            $result->execute();
         
            if ($result->rowCount()== 0) {
              return false;
            }

             while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    $email = $row['customer_email'];
                    $id = $row['customer_id'];
             }

            $_SESSION['customer_email'] = $email;
            $_SESSION['customer_id'] = $id;

             return true;
         }
        catch(PDOException $error){
            echo 'Connection failed: '.$error->getMessage().'.';
            return false;
        }
    

}//END OF FUNCTION


function register_customer($customer)
{
     try{
            global $con;
            $result = $con->prepare('select count(*) count from customers where customer_email =:email');
            $result->bindParam(':email', $customer['email']);

            if($result->rowCount() != 0) {
              return false;
            }
            
            $result = $con->prepare('insert into customers(`customer_name`, `customer_email`, `customer_password`, `customer_phone`)
                                     values(:name, :email, :password, :phone)');
            
            $customer['name'] = $customer['fname'].' '.$customer['lname'];

            $result->bindParam(':name', $customer['name']);
            $result->bindParam(':email', $customer['email']);
            $result->bindParam(':password', $customer['password']);
            $result->bindParam(':phone', $customer['phone']);

            if($result->execute())
                return true;

            return false;

         }
        catch(PDOException $error){
            echo 'Connection failed: '.$error->getMessage().'.';
            return false;
        }
    
}  // END OF FUNCTION

function edit_customer($customer)
{

     try{
            global $con;

            $result = $con->prepare('select count(*) count from customers where customer_id=:id 
                                        and customer_password=:password');
            $result->bindParam(':id', $customer['id']);
            $result->bindParam(':password', $customer['password']);
            $result->execute();
         
            $row_count = $result->rowCount();

            while ($row = $result->fetch(PDO::FETCH_ASSOC))
                $count = $row['count'];

            if($count == 0)
                return false;

            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            
            $result = $con->prepare('update customers set customer_name=:name, customer_email=:email,
                                     customer_phone=:phone where customer_id=:id and customer_password=:password');
            
            $customer['name'] = $customer['fname'].' '.$customer['lname'];

            $result->bindParam(':name', $customer['name']);
            $result->bindParam(':email', $customer['email']);
            $result->bindParam(':password', $customer['password']);
            $result->bindParam(':phone', $customer['phone']);
            $result->bindParam(':id', $customer['id']);

            return $result->execute();      
         }

        catch(PDOException $error){
            echo 'Connection failed: '.$error->getMessage().'.';
            return false;
        }
    
}  // END OF FUNCTION

function insert_buyer($buyer){

    try {
        $buyer['phoneNumber'] = filter_number($buyer['phoneNumber']);

        global $con;
        $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );


        $result = $con->prepare('INSERT INTO buyer(first_name, last_name, cell_phone, address, city, country) 
                            VALUES (:first_name, :last_name, :cell_phone, :address, :city, :country);');

        $result->bindParam(':first_name', $buyer['firstName']);
        $result->bindParam(':last_name', $buyer['lastName']);
        $result->bindParam(':cell_phone', $buyer['phoneNumber'], PDO::PARAM_INT);
        $result->bindParam(':address', $buyer['address1']);
        $result->bindParam(':city', $buyer['cityName']);
        $result->bindParam(':country', $buyer['countryName']);

        return $result->execute();
    } catch (PDOException $error) {
        echo 'Connection failed: '.$error->getMessage().'.';
            return false;
    }
    
} // END OF FUNCTION

function take_order($order){
    
    try {
        global $con;
        $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );



        return $result->execute();
        
    } catch (Exception $error) {
        echo 'Connection failed: '.$error->getMessage().'.';
            return false;
    }
    
    
} // END OF FUNCTION

// Filtering the values
function filterInput($filtering_value)
{
    $filtering_value = trim($filtering_value);
    $filtering_value = stripslashes($filtering_value);
    $filtering_value = htmlspecialchars($filtering_value);
    $filtering_value = filter_var($filtering_value, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $filtering_value = filter_string($filtering_value);
    return $filtering_value;

} //END OF FUNCTION