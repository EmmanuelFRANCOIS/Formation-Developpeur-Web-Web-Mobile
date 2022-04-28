<?php 
session_start();

require_once("../../../utils/config.php");
require_once("../../../utils/acl.php");
require_once("../../../utils/fileManager.php");
require_once('../../../view/admin/ViewTemplateAdmin.php');
require_once('../../../view/admin/ViewCategory.php');
require_once('../../../model/ModelCategory.php');
require_once('../../../model/ModelUniverse.php');

// Check if User can reach that controlleur
$right = ACL::getRight( $_SERVER["REQUEST_URI"], $_SESSION['role_id'] );

if ( $right && isset($_POST['add']) ) {   // Add mode

  $extensions = ["jpg", "JPG", "jpeg", "JPEG", "png", "PNG", "gif", "GIF", "svg", "SVG"];
  $upload = FileManager::upload( $extensions, $_FILES['image'], $config['imagePath']['categories'] );
  $_POST['image']        = $upload['uploadOk']           ? $upload['file_name'] : null;

  $_POST['season_start'] = $_POST['season_start'] !== '' ? date('Y-m-d',strtotime($_POST['season_start'])) : null;
  $_POST['season_end']   = $_POST['season_end']   !== '' ? date('Y-m-d',strtotime($_POST['season_end']))   : null;

  $modelCategory = new ModelCategory();
  $categoryId = $modelCategory->addCategory( $_POST );

  header('Location: show.php?id=' . $categoryId);

} else if ( $right && isset($_POST['cancel']) ) {

  header('Location: list.php'); 
  
} else {

  $modelUniverse = new ModelUniverse();
  $universes = $modelUniverse->getUniverses();
  
  $category = [ 
    'id'            => null, 
    'universe_id'   => null, 
    'parent_id'     => null, 
    'title'         => null, 
    'image'         => null,
    'description'   => null,
    'season_start'  => null,
    'season_end'    => null,
    'metadesc'      => null,
    'metakey'       => null,
    'hits'          => 0
  ];

?>
<?php ViewTemplateAdmin::genHead( $config, "Catégories" ); ?>
  <main class="container-fluid p-0 w-100 d-flex">
    <aside class="sidebar"><?php ViewTemplateAdmin::genSidebar(); ?></aside>
    <section class="w-100 h-100 content">
      <?php 
        ViewTemplateAdmin::genHeader( $config, "Catégories" );
        ViewCategory::genCategoriesToolbar( 'Liste des Catégories', true );
        if ( !$right ) {
          echo '<h2 class="mt-5 fw-bold text-center text-danger">Désolé, vous n\'avez pas l\'authorisation de venir ici...</h2>';
        } else {
          ViewCategory::genCategoryForm( 'add', $config, $category, $universes );
        }
      ?>
    </section>
  </main>
<?php ViewTemplateAdmin::genFooter( $config, [] ); ?>

<?php
}
?>
