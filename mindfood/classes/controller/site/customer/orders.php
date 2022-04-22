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

$modelCustomer = new ModelCustomer();
$customer = $modelCustomer->getCustomer( $_SESSION['id'] );

ViewTemplateSite::genHead( $config, 'Mes Commandes' );
ViewTemplateSite::genHeader( $config, 'Mes Commandes' );
ViewCustomerAuth::genCustomerOrders( $config, 'Mes Commandes', $customer );
ViewTemplateSite::genFooter( $config, [] );

?>
