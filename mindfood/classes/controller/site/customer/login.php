<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";
require_once "../../../model/ModelCustomer.php";

// Customer already connected
if ( isset($_SESSION['id']) ) {   
  header('Location: ../home/index.php');
  exit;
}

if ( isset($_POST['login']) ) {

  $modelCustomer = new ModelCustomer();
  $customerData = $modelCustomer->getCustomerByEmail( $_POST['email'] );

  if ( $customerData && password_verify( $_POST['password'], $customerData['password'] ) ) {

    $_SESSION['id']        = $customerData['id'];
    $_SESSION['lastname']  = $customerData['lastname'];
    $_SESSION['firstname'] = $customerData['firstname'];
    $_SESSION['email']     = $customerData['email'];

    header('Location: ../home/index.php');

  } else {

    header('Location: login.php');
  }

} else if ( isset($_POST['cancel']) ) {

  header('Location: ../home/index.php');

} else {

  ViewTemplateSite::genHead( 'Connexion Client', $config );
  //ViewTemplateSite::genHeader( 'Connexion Client', $config );
  ViewCustomerAuth::genCustomerLoginForm( 'Connexion Client', $config );
  ViewTemplateSite::genFooter();

}

?>
