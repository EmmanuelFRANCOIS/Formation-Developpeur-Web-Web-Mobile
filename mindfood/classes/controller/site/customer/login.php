<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";
require_once "../../../model/ModelCustomer.php";

// Customer already connected
// if ( isset($_SESSION['site']['id']) ) {   
//   header('Location: ../home/index.php');
//   exit;
// }

//var_dump($_POST); echo '<br />';

if ( isset($_POST['login']) ) {

  $modelCustomer = new ModelCustomer();
  $customerData = $modelCustomer->getCustomerByEmail( $_POST['email'] );

  //var_dump($customerData);
  
  if ( $customerData && password_verify( $_POST['password'], $customerData['password'] ) ) {

    $_SESSION['site']['id']        = $customerData['id'];
    $_SESSION['site']['lastname']  = $customerData['lastname'];
    $_SESSION['site']['firstname'] = $customerData['firstname'];
    $_SESSION['site']['email']     = $customerData['email'];
    $_SESSION['site']['role']      = 0;

    header('Location: ../home/index.php');

  } else {

    header('Location: login.php');
  }

} else if ( isset($_POST['cancel']) ) {

  header('Location: ../home/index.php');

} else {

  ViewTemplateSite::genHead( $config, 'Connexion Client' );
  ViewTemplateSite::genHeader( $config, 'Connexion Client' );
  ViewCustomerAuth::genCustomerLoginForm( $config, 'Connexion Client' );
  ViewTemplateSite::genFooter( $config, [] );

}

?>
