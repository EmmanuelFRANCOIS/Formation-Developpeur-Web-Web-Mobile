<?php 
session_start();

require_once("../../../utils/config.php");
require_once('../../../view/admin/ViewCategory.php');
require_once('../../../model/ModelCategory.php');

if ( isset($_GET['idUnv']) ) {

  // Get Categories list by universe_id
  $modelCategory = new ModelCategory();
  $categories = $modelCategory->getCategoriesByUniverse( $_GET['idUnv'] );

  ViewCategory::genCategoriesOptions( $categories );

}
?>
