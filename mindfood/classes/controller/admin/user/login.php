<?php
session_start();

require_once "../../../utils/config.php";
require_once("../../../utils/acl.php");
require_once "../../../view/admin/ViewTemplateAdmin.php";
require_once "../../../view/admin/ViewUser.php";
require_once "../../../model/ModelUser.php";

// User already connected
if ( isset($_SESSION['id']) ) {   
  header('Location: ../home/index.php');
  exit;
}

var_dump($_POST);

if ( isset($_POST['login']) ) {

  $modelUser = new ModelUser();
  $userData = $modelUser->getUserByEmailOrUsername( $_POST['email'] );
  
  if ( $userData && password_verify( $_POST['password'], $userData['password'] ) ) {

    //$_SESSION['user']['id']        = $userData['id'];
    $_SESSION['id']        = $userData['id'];
    $_SESSION['lastname']  = $userData['lastname'];
    $_SESSION['firstname'] = $userData['firstname'];
    $_SESSION['email']     = $userData['email'];
    $_SESSION['role_id']   = $userData['role_id'];
    $_SESSION['role']      = $userData['title'];

    //echo 'Connexion acceptée !';
    header('Location: ../home/index.php');
    
  } else {

    //echo 'Identifiant ou Mot de passe erronés !';
    header('Location: login.php');
  }

} else if ( isset($_POST['cancel']) ) {

  //echo 'Connexion annulée !';
  header('Location: ../home/index.php');

} else {

  ViewTemplateAdmin::genHead( $config, 'Connexion Employé' );
  //ViewTemplateAdmin::genHeader( $config, 'Connexion Client' );
  ViewUser::genUserLoginForm( $config, 'Connexion Employé' );
  ViewTemplateAdmin::genFooter( $config, [] );

}

?>
