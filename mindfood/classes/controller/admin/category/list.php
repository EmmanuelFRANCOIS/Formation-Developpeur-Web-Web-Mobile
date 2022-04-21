<?php 
  require_once('../../../view/ViewTemplateAdmin.php');
  require_once('../../../view/ViewCategory.php');
  ViewTemplateAdmin::genHead("Categories' list");
?>
  <main class="container-fluid p-0 w-100 d-flex">
    <aside id="sidebar" class="sidebar"><?php ViewTemplateAdmin::genSidebar("Catégories"); ?></aside>
    <section class="w-100 h-100 content">
      <?php ViewTemplateAdmin::genHeader("Catégories", 'list'); ?>
      <?php // ViewCategory::getCategoriesNavbar("Catégories"); ?>
      <?php ViewCategory::getCategoriesTable(); ?>
    </section>
  </main>
<?php ViewTemplateAdmin::genFooter(); ?>
