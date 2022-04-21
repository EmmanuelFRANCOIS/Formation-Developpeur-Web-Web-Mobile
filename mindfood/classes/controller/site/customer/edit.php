<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";
require_once "../../../model/ModelCustomer.php";

// Customer not connected
if ( !isset($_SESSION['id']) ) {   
  header('Location: ../customer/login.php');
  exit;
}

if ( isset($_POST['save']) ) {
  $modelCustomer = new ModelCustomer();
  $customerSaved = $modelCustomer->updateCustomer( $_POST );
  if ( $customerSaved ) {
    header('Location: sheet.php');
  } else {
    echo "ERREUR : Votre profil n'a pas été sauvegardé !";
  }

} else if ( isset($_POST['cancel']) ) {

  header('Location: sheet.php');

} else {

  $modelCustomer = new ModelCustomer();
  $customer = $modelCustomer->getCustomer( $_SESSION['id'] );
  
  ViewTemplateSite::genHead( 'Mon Profil', $config );
  ViewTemplateSite::genHeader( 'Mon Profil', $config );
  ViewCustomerAuth::genCustomerProfileForm( 'Mon Profil', $config, $customer );
  ViewTemplateSite::genFooter();

}

?>
