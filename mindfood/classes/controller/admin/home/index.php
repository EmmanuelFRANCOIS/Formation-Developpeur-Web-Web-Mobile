<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/admin/ViewTemplateAdmin.php";


ViewTemplateAdmin::genHead( $config, 'Accueil Site' );
?>
  <main class="container-fluid p-0 w-100 d-flex">
    <aside id="sidebar" class="sidebar"><?php ViewTemplateAdmin::genSidebar("Catégories"); ?></aside>
    <section class="w-100 h-100 content">
      <?php ViewTemplateAdmin::genHeader("Accueil", 'list'); ?>
    </section>
  </main>
<?php
ViewTemplateAdmin::genFooter( $config, [] );

?>
