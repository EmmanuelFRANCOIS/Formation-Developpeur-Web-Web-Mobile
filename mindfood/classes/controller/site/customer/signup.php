<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";
require_once "../../../model/ModelCustomer.php";

if ( isset( $_POST['signup'] ) ) {

  // $dataToValidate = [
  //   [ 'field' => 'Prénom',   'value' => $_POST['firstname'], 'type' => 'firstname', 'valid' => null, 'msg' => null ],
  //   [ 'field' => 'Nom',      'value' => $_POST['lastname'],  'type' => 'lastname',  'valid' => null, 'msg' => null ],
  //   [ 'field' => 'Email',    'value' => $_POST['email'],     'type' => 'email',     'valid' => null, 'msg' => null ],
  //   [ 'field' => 'Password', 'value' => $_POST['firstname'], 'type' => 'password',  'valid' => null, 'msg' => null ],
  // ];

  // $validData = FormValidation::validateForm( $dataToValidate );
  // if ( $validData ) {
  //   // echo "<h1>données valides</h1>";
    // Create Customer in table
    //$pass = password_hash( $_POST['password'], PASSWORD_DEFAULT );
    $modelCustomer = new ModelCustomer();
    if ( $modelCustomer->signupCustomer( $_POST ) ) {
?>
      <!-- <h1>Inscription faite avec succes </h1>
      <a href="login.php">Connexion</a> -->
<?php

      ViewTemplateSite::genHead( 'Inscription Client', $config );
      ViewTemplateSite::genHeader( 'Inscription Client', $config );
      ViewCustomerAuth::genCustomerSignupResult( 'Inscription Client', $config );
      ViewTemplateSite::genFooter();

    } else {
?>
      <h1> Echec de l 'inscription </h1>
      <a href="signup.php"> Retour </a>
<?php
    }

  //}

} else if ( isset($_POST['cancel']) ) {

  header('Location: ../home/index.php');

} else {

  ViewTemplateSite::genHead( 'Inscription Client', $config );
  //ViewTemplateSite::genHeader( 'Inscription Client', $config );
  ViewCustomerAuth::genCustomerSignupForm( 'Inscription Client', $config );
  ViewTemplateSite::genFooter();
  
}

?>
