<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../modules/products/products.php";

$tpl = isset($_GET['tpl']) ? $_GET['tpl'] : $config['site']['modules']['tpl'];

$unvId = $_GET['id'];
switch ( $unvId ) {
  case 1: $unvTitle = 'Livre';         $unvTitlePlural = 'Livres';          break;
  case 2: $unvTitle = 'Album Musical'; $unvTitlePlural = 'Albums';          break;
  case 3: $unvTitle = 'Film';          $unvTitlePlural = 'Films';           break;
  case 4: $unvTitle = 'Documentaire';  $unvTitlePlural = 'Documentaires';   break;
}

$universe = [ 
  'id'        => $unvId,
  'title'     => $unvTitlePlural,
  'pageTitle' => "<span class='text-secondary'>L'Univers des </span><span class='fw-bold text-success'>$unvTitlePlural</span>"
];

ViewTemplateSite::genHead( $config, 'Accueil' );
ViewTemplateSite::genHeader( $config, '' );
ViewTemplateSite::genNavBar( $config, $unvId );
ViewTemplateSite::genPageHeader( $unvId, $tpl, $universe['pageTitle'] );

// New Products
$options = [
  'tpl'         => $tpl,
  'moduleTitle' => "<span class='fw-bold text-success'>Nouveautés </span><span class='text-secondary'>$unvTitlePlural</span>",
  'moreBtnText' => "Nouveautés $unvTitlePlural",
  'universe_id' => $unvId,
  'category_id' => null,
  'brand_id'    => null,
  'orderBy'     => 'created',
  // 'nbDisplay'   => null,
  // 'nbByRow'     => null,
  // 'nbQuery'     => null
];
ModProducts::genProducts( $config, $options );

// Bestsellers
$options = [
  'tpl'         => $tpl,
  'moduleTitle' => "<span class='fw-bold text-success'>Meilleures Ventes </span><span class='text-secondary'>$unvTitlePlural</span>",
  'moreBtnText' => "$unvTitlePlural les mieux vendus",
  'universe_id' => $unvId,
  'category_id' => null,
  'brand_id'    => null,
  'orderBy'     => 'sales',
  // 'nbDisplay'   => null,
  // 'nbByRow'     => null,
  // 'nbQuery'     => null
];
ModProducts::genProducts( $config, $options );

// Most rated
$options = [
  'tpl'         => $tpl,
  'moduleTitle' => "<span class='text-secondary'>$unvTitlePlural</span><span class='fw-bold text-success'> les mieux notés</span>",
  'moreBtnText' => "$unvTitlePlural les mieux notés",
  'universe_id' => $unvId,
  'category_id' => null,
  'brand_id'    => null,
  'orderBy'     => 'rating',
  // 'nbDisplay'   => null,
  // 'nbByRow'     => null,
  // 'nbQuery'     => null
];
ModProducts::genProducts( $config, $options );

// Most viewed (hits)
$options = [
  'tpl'         => $tpl,
  'moduleTitle' => "<span class='text-secondary'>$unvTitlePlural</span><span class='fw-bold text-success'> les plus consultés</span>",
  'moreBtnText' => "$unvTitlePlural les plus consultés",
  'universe_id' => $unvId,
  'category_id' => null,
  'brand_id'    => null,
  'orderBy'     => 'hits',
  // 'nbDisplay'   => null,
  // 'nbByRow'     => null,
  // 'nbQuery'     => null
];
ModProducts::genProducts( $config, $options );

// Random selection
$options = [
  'tpl'         => $tpl,
  'moduleTitle' => "<span class='text-secondary'>Laissons faire le </span><span class='fw-bold text-success'>hazard</span>",
  'moreBtnText' => "$unvTitlePlural au hazard",
  'universe_id' => $unvId,
  'category_id' => null,
  'brand_id'    => null,
  'orderBy'     => 'random',
  'nbDisplay'   => 8,
  'nbByRow'     => 4,
  'nbQuery'     => 16
];
ModProducts::genProducts( $config, $options );

ViewTemplateSite::genFooter( $config );
?>
