<?php 
session_start();

require_once("../../../utils/config.php");
require_once('../../../view/admin/ViewTemplateAdmin.php');
require_once('../../../view/admin/ViewCategory.php');
require_once('../../../model/ModelCategory.php');

// Get Categories list
$modelCategory = new ModelCategory();
$categories = $modelCategory->getCategoriesTable();
?>

<?php ViewTemplateAdmin::genHead( $config, "Catégories"); ?>
  <main class="container-fluid p-0 w-100 d-flex">
    <aside class="sidebar"><?php ViewTemplateAdmin::genSidebar(); ?></aside>
    <section class="w-100 h-100 content">
      <?php ViewTemplateAdmin::genHeader( $config, "Catégories" ); ?>
      <?php ViewCategory::genCategoriesToolbar( 'Liste des Catégories', true ); ?>
      <?php ViewCategory::getCategoriesTable( $categories ); ?>
    </section>
  </main>
<?php ViewTemplateAdmin::genFooter( $config, [] ); ?>
