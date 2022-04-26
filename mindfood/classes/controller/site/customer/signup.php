<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";
require_once "../../../utils/formValidation.php";
require_once "../../../model/ModelCustomer.php";

if ( isset($_POST['signup']) ) {

  $donnees = [ 
    $_POST['firstname'], 
    $_POST['lastname'], 
    $_POST['email'], 
    $_POST['password']
  ];
  $types   = [ 'firstname', 'lastname', 'email', 'password' ];
  $data = FormValidation::validateForm( $donnees, $types );
  if ( $data ) {
    echo "<h3>données valides</h3>";
    $modelCustomer = new ModelCustomer();
    ViewTemplateSite::genHead( $config, 'Inscription Client' );
    ViewTemplateSite::genHeader( $config, 'Inscription Client' );
    if ( $modelCustomer->signupCustomer( $_POST ) ) {
      // Display signup ok
      ViewCustomerAuth::genCustomerSignupSucceed( $config, 'Inscription Client' );
    } else {
      // Display signup failed
      ViewCustomerAuth::genCustomerSignupFailed( $config, 'Inscription Client' );
    }
    ViewTemplateSite::genFooter( $config, [] );
  }

} else if ( isset($_POST['cancel']) ) {

  header('Location: ../home/index.php');

} else {

  ViewTemplateSite::genHead( $config, 'Inscription Client' );
  //ViewTemplateSite::genHeader( 'Inscription Client', $config );
  ViewCustomerAuth::genCustomerSignupForm( $config, 'Inscription Client' );
  ViewTemplateSite::genFooter( $config, ['validationForm'] );
  
}

?>
