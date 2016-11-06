<?php

$response = array(
  'valid' => false,
  'message' => 'This "user" does not exist.'
);


if( isset($_POST['user']) ) {
  $userFactory = new UserFactory( DataStorage::instance() );
  $user = $userFactory->loadUser( $_POST['user'] );




  if( $user ) {
    // User name is registered on another account
    $response = array('valid' => false, 'message' => 'This user name is already registered.');
  } else {
    // User name is available
    $response = array('valid' => true);
  }


}
echo json_encode($response);