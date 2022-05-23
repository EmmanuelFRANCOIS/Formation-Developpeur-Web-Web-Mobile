<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewProduct.php";
require_once "../../../model/ModelProduct.php";
require_once "../../../modules/products/products.php";

$tpl   = isset($_GET['tpl']) ? $_GET['tpl'] : $config['site']['modules']['tpl'];

switch ( $unvId ) {
  case 1: $unvTitle = 'Livre';         $unvTitlePlural = 'Livres';          break;
  case 2: $unvTitle = 'Album Musical'; $unvTitlePlural = 'Albums';          break;
  case 3: $unvTitle = 'Film';          $unvTitlePlural = 'Films';           break;
  case 4: $unvTitle = 'Documentaire';  $unvTitlePlural = 'Documentaires';   break;
}

$modelProduct = new ModelProduct();
$product = $modelProduct->getProductComplete( $_GET['id'] );

ViewTemplateSite::genHead( $config, 'Accueil' );
ViewTemplateSite::genHeader( $config, '' );
ViewTemplateSite::genNavBar( $config, $unvId );

ViewProduct::genProductSheet( $config, $product );

// Some products from the same category
$options = [
  'tpl'         => $tpl,
  'moduleTitle' => "<span class='text-secondary'>Nouveautés dans la même </span><span class='fw-bold text-success'>catégorie</span>",
  'moreBtnText' => "Nouveautés dans la même catégorie",
  'universe_id' => $product['universe_id'],
  'category_id' => $product['category_id'],
  'brand_id'    => null,
  'orderBy'     => 'created',
  // 'nbDisplay'   => null,
  // 'nbByRow'     => null,
  // 'nbQuery'     => null
];
ModProducts::genProducts( $config, $options );

ViewTemplateSite::genFooter( $config );

?>
