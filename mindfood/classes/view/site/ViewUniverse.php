<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";
require_once "../../../module/products_by_date/products_by_date.php";
require_once "../../../module/products_by_rating/products_by_rating.php";
require_once "../../../module/products_by_random/products_by_random.php";
require_once "../../../module/products_by_hits/products_by_hits.php";
require_once "../../../module/products_by_sales/products_by_sales.php";


ViewTemplateSite::genHead( $config, 'Accueil' );
ViewTemplateSite::genHeader( $config, '' );
ViewTemplateSite::genNavBar( $config );

$options = [
  'display'     => null,
  'moduleTitle' => 'Nouveautés Livres',
  'universe_id' => 1,
  'category_id' => null,
  'brand_id'    => null,
  'mode'        => null,
  'nb'          => 5,
];
ModProductsByDate::genProductsByDate( $options );

$options = [
  'display'     => null,
  'moduleTitle' => 'Livres les mieux notés',
  'universe_id' => 1,
  'category_id' => null,
  'brand_id'    => null,
  'mode'        => null,
  'nb'          => 5,
];
ModProductsByRating::genProductsByRating( $options );

$options = [
  'display'     => null,
  'moduleTitle' => 'Livres les plus Populaires',
  'universe_id' => 1,
  'category_id' => null,
  'brand_id'    => null,
  'mode'        => null,
  'nb'          => 5,
];
ModProductsByHits::genProductsByHits( $options );

$options = [
  'display'     => null,
  'moduleTitle' => 'Meilleures Ventes Livres',
  'universe_id' => 1,
  'category_id' => null,
  'brand_id'    => null,
  'mode'        => null,
  'nb'          => 5,
];
ModProductsBySales::genProductsBySales( $options );

$options = [
  'display'     => null,
  'moduleTitle' => 'Laissons faire le hazard...',
  'universe_id' => 1,
  'category_id' => null,
  'brand_id'    => null,
  'mode'        => null,
  'nb'          => 10,
];
ModProductsByRandom::genProductsByRandom( $options );

ViewTemplateSite::genFooter( $config );
?>
