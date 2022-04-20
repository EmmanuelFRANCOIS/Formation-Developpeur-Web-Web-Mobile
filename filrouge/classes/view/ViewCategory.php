<?php
// Include Category Model
require_once('../../../model/ModelCategory.php');


/**
 *  View Class for Categories
 */
class ViewCategory {


  /**
   * Function to prepare the table of Categories
   */
  public static function prepareCategoriesTable() {
?>
    <table id="tableCategories" class="w-100 display responsive"></table>
<?php
  }


  /**
   * Function to prepare the table of Categories
   */
  public static function getCategoriesNavbar($pageTitle) {
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#"><?php echo $pageTitle; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">List</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="add.php">Add</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<?php
  }


  /**
   * Function to display the list of Categories
   */
  public static function getCategoriesTable() {

    // Get Categories list
    $modelCategory = new ModelCategory();
    $categories = $modelCategory->getCategories();

    // Build 
    if ( true ) {   //count($categories) > 0
?>
      <div class="w-100 p-4">
        <table class="w-100 display responsive" id="tableCategories">
          <thead>
            <tr class="text-center">
              <th scope="col">#</th>
              <th scope="col">Parente</th>
              <th scope="col">Univers</th>
              <th scope="col">Catégorie</th>
              <th scope="col">Image</th>
              <th scope="col">Description</th>
              <th scope="col">Products</th>
              <th scope="col">Début Saison</th>
              <th scope="col">Fin Saison</th>
              <th scope="col">Modifié le</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>

<?php 
          foreach ($categories as $categorie) {
            $image = $categorie['image'] ?
                     '<img height="32" src="../../../../images/categories/' . $categorie['image'] . '" />' : '';
?>
            <tr>
              <td class="text-center"><?php echo $categorie['id'] ?></td>
              <td class="text-center"><?php echo $categorie['parent'] ? $categorie['parent'] : '-'; ?></td>
              <td class="text-center"><?php echo $categorie['universe'] ?></td>
              <td><?php echo $categorie['title'] ?></td>
              <td class="text-center"><?php echo $image ?></td>
              <td><?php echo substr($categorie['description'], 0, 50) . '...' ?></td>
              <td class="text-center"><?php echo $categorie['nbproducts'] > 0 ? $categorie['nbproducts'] : '-'; ?></td>
              <td><?php echo $categorie['season_start'] ?></td>
              <td><?php echo $categorie['season_end'] ?></td>
              <td><?php echo $categorie['modified_on'] ?></td>
              <td class="text-end text-nowrap">
                <a class="text-dark fs-5" href="show.php?id=<?php echo $categorie['id'] ?>" title="Voir Catégorie sur Admin"><i class="fa-solid fa-eye"></i></a>
                <a class="ms-2 text-success fs-5" href="show.php?id=<?php echo $categorie['id'] ?>" title="Voir Catégorie sur Site"><i class="fa-solid fa-eye"></i></a>
                <a class="ms-2 text-primary fs-5" href="edit.php?id=<?php echo $categorie['id'] ?>" title="Modifier Catégorie"><i class="fa-solid fa-pen-to-square"></i></a>
                <a class="ms-2 text-danger fs-5" href="delete.php?id=<?php echo $categorie['id'] ?>" title="Supprimer Catégorie"><i class="fa-solid fa-trash-can"></i></a>
              </td>
            </tr>
<?php
          }
?>
          </tbody>
        </table>
        </div>
<?php 
    } else {
?>

      <div class="alert alert-danger" role="alert">
        Il n'existe aucune Catégorie pour l'instant...
      </div>

<?php
    } 
  }


}

?>