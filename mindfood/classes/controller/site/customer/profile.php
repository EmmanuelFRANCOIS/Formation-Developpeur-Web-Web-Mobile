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

if ( isset($_POST['edit']) ) {

  header('Location: edit.php');

} else if ( isset($_POST['delete']) ) {

  header('Location: delete.php');

} else if ( isset($_POST['close']) ) {

  header('Location: ../home/index.php');

} else {

  $modelCustomer = new ModelCustomer();
  $customer = $modelCustomer->getCustomer( $_SESSION['id'] );
  
  ViewTemplateSite::genHead( $config, 'Mon Profil' );
  ViewTemplateSite::genHeader( $config, 'Mon Profil' );
  ViewCustomerAuth::genCustomerSheet( $config, 'Mon Profil', $customer );
  ViewTemplateSite::genFooter( $config, [] );

}

?>
