<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/admin/ViewTemplateAdmin.php";
require_once "../../../view/admin/ViewCategory.php";
require_once "../../../model/ModelCategory.php";

if ( isset($_POST['edit']) ) {

  header('Location: edit.php?id=' . $_POST['id']);

} else if ( isset($_POST['delete']) ) {

  header('Location: delete.php');

} else if ( isset($_POST['close']) ) {

  header('Location: ../home/index.php');

} else {

  $modelCategory = new ModelCategory();
  $category      = $modelCategory->getCategoryComplete( $_GET['id'] );
  
?>
  <?php ViewTemplateAdmin::genHead( $config, "Catégories" ); ?>
  <main class="container-fluid p-0 w-100 d-flex">
    <aside class="sidebar"><?php ViewTemplateAdmin::genSidebar(); ?></aside>
    <section class="w-100 h-100 content">
      <?php ViewTemplateAdmin::genHeader( $config, "Catégories" ); ?>
      <?php ViewCategory::genCategoriesToolbar( 'Détails Catégorie', false ); ?>
      <?php ViewCategory::genCategorySheet( $config, $category ); ?>
    </section>
  </main>
  <?php ViewTemplateAdmin::genFooter( $config, [] ); ?>

<?php
}
?>
