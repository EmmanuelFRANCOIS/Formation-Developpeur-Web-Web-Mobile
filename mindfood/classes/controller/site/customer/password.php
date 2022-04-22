<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";
require_once "../../../model/ModelCustomer.php";

// if ( isset($_POST['reset']) ) {
//   $modelCustomer = new ModelCustomer();
//   $customerSaved = $modelCustomer->updateCustomer( $_POST );
//   if ( $customerSaved ) {
//     header('Location: sheet.php');
//   } else {
//     echo "ERREUR : Votre profil n'a pas été sauvegardé !";
//   }

// } else if ( isset($_POST['cancel']) ) {

//   header('Location: sheet.php');

// } else {

//   $modelCustomer = new ModelCustomer();
//   $customer = $modelCustomer->getCustomer( $_SESSION['id'] );
  
  ViewTemplateSite::genHead( $config, 'Mon Profil' );
  ViewTemplateSite::genHeader( $config, 'Mon Profil' );
  //ViewCustomerAuth::genCustomerProfileForm( $config, 'Mon Profil', $customer );
  ViewTemplateSite::genFooter( $config, [] );

// }

?>
