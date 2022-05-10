<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../model/ModelOrders.php";
require_once "fonctions-panier.php";



$erreur = false;

$action = (isset($_POST['action'])? $_POST['action']:  (isset($_GET['action'])? $_GET['action']:null )) ;
if ( $action !== null ) {
  if ( !in_array($action,array('ajout', 'suppression', 'refresh', 'vider', 'commander')) ) {
    $erreur=true;
  }
  //récupération des variables en POST ou GET
  $id = ( isset($_POST['id']) ? $_POST['id'] : ( isset($_GET['id']) ? $_GET['id'] : null )) ;
  $l  = ( isset($_POST['l'])  ? $_POST['l']  : ( isset($_GET['l'])  ? $_GET['l']  : null )) ;
  $a  = ( isset($_POST['a'])  ? $_POST['a']  : ( isset($_GET['a'])  ? $_GET['a']  : null )) ;
  $p  = ( isset($_POST['p'])  ? $_POST['p']  : ( isset($_GET['p'])  ? $_GET['p']  : null )) ;
  $q  = ( isset($_POST['q'])  ? $_POST['q']  : ( isset($_GET['q'])  ? $_GET['q']  : null )) ;

  //On vérifie que $id est un integer
  $id = intval($id);
  //Suppression des espaces verticaux
  $l = preg_replace('#\v#', '',$l);
  $a = preg_replace('#\v#', '',$a);
  //On vérifie que $p est un float
  $p = floatval($p);

  //On traite $q qui peut être un entier simple ou un tableau d'entiers
  
  if ( is_array($q) ) {
    $QteArticle = array();
    $i=0;
    foreach ( $q as $contenu ) {
        $QteArticle[$i++] = intval($contenu);
    }
  } else {
    $q = intval( $q );
  }
}

if ( !$erreur ) {
  switch ( $action ) {
    case "ajout":
      ajouterArticle( $id, $l, $a, $q, $p );
      // Keep trace of the last product(s) page to go back after operations on cart
      if ( isset($_SERVER["HTTP_REFERER"]) ) {
        $_SESSION['panier']['backToPage'] = $_SERVER["HTTP_REFERER"];
      }  
      break;

    case "suppression":
      supprimerArticle( $l );
      break;

    case "refresh" :
      for ( $i = 0 ; $i < count($QteArticle) ; $i++ ) {
        modifierQTeArticle($_SESSION['panier']['libelleProduit'][$i],round($QteArticle[$i]));
      }
      break;

    case "commander" :
      passerCommande( $config );
      break;
      
    case "vider" :
      supprimePanier();
      break;
        
    default:
      break;
  }
}

ViewTemplateSite::genHead( $config, 'Mon panier' );
ViewTemplateSite::genHeader( $config, '' );
ViewTemplateSite::genNavBar( $config );
genCart();
ViewTemplateSite::genFooter( $config );


?>
