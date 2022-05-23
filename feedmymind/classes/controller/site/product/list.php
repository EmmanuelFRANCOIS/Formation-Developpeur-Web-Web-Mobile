<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewProduct.php";
require_once "../../../model/ModelProduct.php";

$tpl   = isset($_GET['tpl'])  ? $_GET['tpl']  : $config['site']['productsList']['tpl'];
$srt   = isset($_GET['srt'])  ? $_GET['srt']  : $config['site']['productsList']['orderBy'];
$ls    = isset($_GET['ls'])   ? $_GET['ls']   : 0;
$ll    = isset($_GET['ll'])   ? $_GET['ll']   : $config['site']['productsList']['nbPerPage'];

$optionsQuery = [
  'universe_id' => 1,
  'category_id' => null,
  'brand_id'    => null,
  'limitStart'  => $ls,
  'limitNum'    => $ll,
  'orderBy'     => $srt
];
$modelProduct = new ModelProduct();
$products = $modelProduct->getProductsComplete( $optionsQuery );

ViewTemplateSite::genHead( $config, 'Mes Commandes' );
ViewTemplateSite::genHeader( $config, 'Mes Commandes' );
ViewTemplateSite::genNavBar( $config, null );

$options = [
  'tpl'         => $tpl,
  'moduleTitle' => '<span class="text-secondary">Nouveautés </span><span class="fw-bold text-success">Livres</span>',
  'moreBtnText' => 'Nouveautés Livres',
  'universe_id' => 1,
  'category_id' => null,
  'brand_id'    => null,
  'orderBy'     => 'created',
  // 'nbByRow'     => null,
];
ViewProduct::genProducts( $config, $products, $options );

ViewTemplateSite::genFooter( $config, [] );

?>
