<?php 
session_start();

require_once("../../../utils/config.php");
require_once('../../../view/admin/ViewTemplateAdmin.php');
require_once('../../../view/admin/ViewCategory.php');
require_once('../../../model/ModelCategory.php');
require_once('../../../model/ModelUniverse.php');

if ( isset($_POST['save']) ) {   // Save mode

  var_dump($_POST);
  $_POST['universe_id']  = is_int(intval($_POST['universe_id'])) ? intval($_POST['universe_id']) : null;
  $_POST['parent_id']    = is_int(intval($_POST['parent_id']))   ? intval($_POST['parent_id'])   : null;
  $_POST['season_start'] = $_POST['season_start'] !== '' ? date('Y-m-d',strtotime($_POST['season_start'])) : null;
  $_POST['season_end']   = $_POST['season_end']   !== '' ? date('Y-m-d',strtotime($_POST['season_end']))   : null;

  $modelCategory = new ModelCategory();
  $category = $modelCategory->updateCategory( $_POST );

  //header('Location: list.php');

} else if ( isset($_POST['cancel']) ) {

  header('Location: list.php'); 
  
} else {

  $modelUniverse = new ModelUniverse();
  $universes     = $modelUniverse->getUniverses();
  
  $modelCategory = new ModelCategory();
  $category      = $modelCategory->getCategory( $_GET['id'] );
  $categories    = $modelCategory->getCategoriesByUniverse( $category['universe_id'] );

?>
<?php ViewTemplateAdmin::genHead( $config, "Catégories" ); ?>
  <main class="container-fluid p-0 w-100 d-flex">
    <aside class="sidebar"><?php ViewTemplateAdmin::genSidebar(); ?></aside>
    <section class="w-100 h-100 content">
      <?php ViewTemplateAdmin::genHeader( $config, "Catégories" ); ?>
      <?php ViewCategory::genCategoriesToolbar( 'Modifier Catégorie', false ); ?>
      <?php ViewCategory::genCategoryForm( 'edit', $config, $category, $universes, $categories ); ?>
    </section>
  </main>
<?php ViewTemplateAdmin::genFooter( $config, [] ); ?>

<?php
}
?>
