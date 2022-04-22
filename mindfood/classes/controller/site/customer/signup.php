<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";
require_once "../../../utils/formValidation.php";
require_once "../../../model/ModelCustomer.php";

if ( isset($_POST['signup']) ) {

  $donnees = [ $_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['password'] ];
  $types   = [ 'firstname',         'lastname',         'email',         'password' ];
  $data = FormValidation::validateForm( $donnees, $types );
  if ( $data ) {
    echo "<h3>données valides</h3>";
    $modelCustomer = new ModelCustomer();
    if ( $modelCustomer->signupCustomer( $_POST ) ) {
      // Display signup ok
      ViewTemplateSite::genHead( 'Inscription Client', $config );
      ViewTemplateSite::genHeader( 'Inscription Client', $config );
      ViewCustomerAuth::genCustomerSignupResult( 'Inscription Client', $config );
      ViewTemplateSite::genFooter();
    } else {
      // Display signup failed
      echo "<h3>L'inscription a échoué !</h3>";
    }
  }

} else if ( isset($_POST['cancel']) ) {

  header('Location: ../home/index.php');

} else {

  ViewTemplateSite::genHead( 'Inscription Client', $config );
  //ViewTemplateSite::genHeader( 'Inscription Client', $config );
  ViewCustomerAuth::genCustomerSignupForm( 'Inscription Client', $config );
  ViewTemplateSite::genFooter();
  
}

?>
