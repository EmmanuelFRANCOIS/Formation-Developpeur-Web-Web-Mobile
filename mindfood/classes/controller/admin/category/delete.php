<?php 
session_start();

require_once('../../../model/ModelCategory.php');

$modelCategory = new ModelCategory();
$delete = $modelCategory->deleteCategory( $_GET['id'] );

header('Location: list.php');

?>
