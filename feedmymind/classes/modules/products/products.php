<?php
require_once "../../../utils/config.php";
require_once('../../../model/DBUtils.php');
require_once "../../../view/site/ViewTemplateSite.php";


/**
 * @class   Products module
 * @summary Class to extract products in DB
 *          and display them where this module
 *          is applied
 */
class ModProducts {

  /**
   * @function getProducts()
   * @summary  return products 
   *           by universe, by category and/or by brand,
   *           sorted as required
   * @param $options = [
   *          'universe_id' => [id of the Universe] (default : null)
   *          'category_id' => [id of the Category] (default : null)
   *          'brand_id'    => [id of the Brand]    (default : null)
   *          'orderBy'     => [year, sales, rating, hits, created, modified, random] (default: created)
   *          'nbDisplay'   => [# of products to display randomly among returned products] (default : 8)
   *          'nbByRow'     => [# of products to display horizontaly, by row] (default : 4)
   *          'nbQuery'     => [# of products to return] (default : 16)
   *        ]
   * @return All requested Products data
   */
  private static function getProducts( $config, $options = null ) {

    $whereUnv = $options['universe_id'] ? 'prd.universe_id = ' . $options['universe_id'] : null;
    $whereCat = $options['category_id'] ? 'prd.category_id = ' . $options['category_id'] : null;
    $whereBrd = $options['brand_id']    ? 'prd.brand_id = '    . $options['brand_id']    : null;
    $where    = $whereUnv     ? $whereUnv                                  : '';
    $where   .= $whereCat     ? ($where !== '' ? ' AND ' : '') . $whereCat : '';
    $where   .= $whereBrd     ? ($where !== '' ? ' AND ' : '') . $whereCat : '';
    $where    = $where !== '' ? 'WHERE ' . $where . ' ' : '';

    switch ( $options['orderBy'] ) {
      case 'year'     : $orderBy = "ORDER BY prd.year DESC, prd.title ASC ";    break;
      case 'sales'    : $orderBy = "ORDER BY prd.sales DESC, prd.title ASC ";   break;
      case 'rating'   : $orderBy = "ORDER BY prd.rating DESC, prd.title ASC ";  break;
      case 'hits'     : $orderBy = "ORDER BY prd.hits DESC, prd.title ASC ";    break;
      case 'created'  : $orderBy = "ORDER BY created_on DESC, prd.title ASC ";  break;
      case 'modified' : $orderBy = "ORDER BY modified_on DESC, prd.title ASC "; break;
      case 'random'   : $orderBy = "ORDER BY rand() ";                          break;
      default         : $orderBy = "ORDER BY rand() ";                          break;
    }

    $nbQuery = $options['nbQuery'] > 0 ? $options['nbQuery'] : $config['site']['modules']['nbQuery'];

    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT prd.*, 
             unv.title AS universe, unv.image as universe_image, 
             cat.title as category, cat.image AS category_image, 
             brd.title AS brand, brd.image AS brand_image 
      FROM product AS prd 
      INNER JOIN universe AS unv ON unv.id = prd.universe_id
      INNER JOIN category AS cat ON cat.id = prd.category_id
      INNER JOIN brand    AS brd ON brd.id = prd.brand_id " .
      $where . 
      $orderBy . "  
      LIMIT 0, " . $nbQuery . ";
    ");

    if ( $req->execute() ) {

      return $req->fetchAll( PDO::FETCH_ASSOC );

    } else {

      return "<br/>============================================================================<br/>"
           . "Erreur lors de l'exécution de la requête SQL du module [products_by_date] :<br/>"
           . "Code erreur      : ". $req->errorCode() . "<br/>"
           . "Message d'erreur : ". $req->errorInfo() . "<br/>"
           . "Détail de la commande SQL : <br/>"
           . $req->debugDumpParams()
           . "<br/>============================================================================<br/>";

    }

  }


  /**
   * @function genProducts()
   * @summary  return Html generated code for a module with n products
   *           by universe, by category and/or by brand,
   *           sorted as required
   * @param $options = [
   *          'tpl'         => ['mosaic', 'list'] (default : 'mosaic')
   *          'moduleTitle' => ['module title'] (default : 'Nouveautés')
   *          'universe_id' => [id of the Universe] (default : null)
   *          'category_id' => [id of the Category] (default : null)
   *          'brand_id'    => [id of the Brand]    (default : null)
   *          'orderby'     => ["columnName + Direction"] (default: ['created_on DESC'])
   *          'nbDisplay'   => [# of products to display randomly among returned products] (default : 4)
   *          'nbQuery'     => [# of products to return] (default : 4)
   *        ]
   * @return  Html code of the generated module
   */
  public static function genProducts( $config, $options = null ) {

    // Check $nb value
    $nbDisplay = $options['nbDisplay'] > 0 ? $options['nbDisplay'] : $config['site']['modules']['nbDisplay'];
    $nbByRow = $options['nbByRow'] > 0 ? $options['nbByRow'] : $config['site']['modules']['nbByRow'];
    $nbH = $nbByRow > 0 ? $nbByRow : min($nbDisplay, $config['site']['modules']['nbMaxByRow']);

    // Get Products from DB Product table
    $result = ModProducts::getProducts( $config, $options );

    // Extract $nbDisplay random rows from the $result table
    if ( is_array($result) && count($result) > 0 ) {
      $keys = array_rand( $result, $nbDisplay );
      for ( $i = 0; $i < count($result); $i++ ) {
        if ( in_array($i, array_values($keys)) ) {
          $products[] = $result[$i];
        }
      }
    } else {
      return false;
    }
    
    if ( $options['tpl'] === 'mosaic' ) {

      ?>
      <!-- Generate Html MOSAIC module -->
      <div class="container-fluid">
        <div class="container py-4 my-3">
          <h3 class="text-success text-uppercase module-title"><?php echo $options['moduleTitle']; ?></h3>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 row-cols-lg-<?php echo $nbH; ?> g-4 mt-2">

            <?php 
            foreach( $products as $product ) {

              switch ( $product['universe_id'] ) {
                case 1: $unvImg = "BOOK"; break;
                case 2: $unvImg = "CD"; break;
                case 3: $unvImg = "DVD"; break;
                case 4: $unvImg = "DOCS"; break;
              } 
              $imgsrc    = '../../../../images/products/' . ( $product['image'] ? $product['image'] : 'image_' . $unvImg . '_empty.svg' );
              $imgcatsrc = $product['category_image'] ? '../../../../images/categories/' . $product['category_image'] : '';
              $created   = new DateTime($product['created_on']);
              $modified  = new DateTime($product['created_on']);

              switch ( $options['orderBy'] ) {
                case 'year'     : $displayOrderValue = "Sortie : "     . $product['year'];                                                  break;
                case 'sales'    : $displayOrderValue = "Ventes : "     . $product['sales'];                                                 break;
                case 'rating'   : $displayOrderValue = "Note : "       . $product['rating'] . "/5 (" . $product['rating_num'] . " votes)";  break;
                case 'hits'     : $displayOrderValue = "Vues : "       . $product['hits'];                                                  break;
                case 'created'  : $displayOrderValue = "Ajouté le : "  . $created->format('d F Y');                                         break;
                case 'modified' : $displayOrderValue = "Modifié le : " . $modified->format('d F Y');                                        break;
                case 'random'   : $displayOrderValue = "Sortie : "     . $product['year'];                                                  break;
                default         : $displayOrderValue = "Sortie : "     . $product['year'];                                                  break;
              }

            ?>
              <div class="col">

                  <div class="card h-100 bg-light text-center">
                    
                    <img src="<?php echo $imgsrc; ?>" class="card-img-top py-0 my-3 mx-auto" style="max-width: 80%; height:128px;" alt="<?php echo $product['title']; ?>">
                    
                    <div class="card-body text-start p-2">
                      <a class="text-decoration-none text-dark stretched-link" 
                        href="../../../controller/site/product/show.php?id=<?php echo $product['id']; ?>">
                        <h5 class="card-title fs-4"><?php echo $product['title']; ?></h5>
                      </a>
                      <div class="card-text"><?php echo $product['maker']; ?></div>
                      <div class="card-text mt-2"><?php echo $product['brand']; ?></div>
                    </div>

                    <div class="card-footer text-start mt-2 pt-2 px-2">
                      <div class="d-flex align-items-content category">
                        <div class="card-text"><?php echo $product['category']; ?></div>
                      </div>
                      <div class="card-text mt-2"><?php echo $displayOrderValue; ?></div>
                    </div>

                    <div class="card-footer d-flex justify-content-between align-items-center p-2 text-end">
                      <?php if ( $product['rating'] ) { ?>
                        <div class="text-success rating"><?php echo ViewTemplateSite::genRatingStars( $product['rating'] ) . '<span class="fw-bold"> &nbsp; (' . $product['rating_num'] . ')</span>'; ?></div>
                      <?php } else { ?>
                        <div class="text-secondary rating">Pas noté</div>
                      <?php } ?>
                      <div class="price fw-bold fs-5" style="z-index: 10;"><?php echo $product['price']; ?> €
                      <a href="../cart/cart.php?action=add&amp;id=<?php echo $product['id']; ?>&amp;l=<?php echo $product['title']; ?>&amp;a=<?php echo $product['maker']; ?>&amp;r=<?php echo $product['reference']; ?>&amp;q=1&amp;p=<?php echo $product['price']; ?>" 
                        class="btn btn-success px-1 pt-1 pb-0 ms-2" 
                        title="Ajouter au panier" >
                        <i class="fa-solid fa-cart-plus fs-5"></i>
                      </a></div>
                    </div>

                  </div>

              </div>
            <?php 
            } 
            ?>

          </div>
          <div class="mt-4 fs-5 text-end"><span class="py-1 me-2">Plus de </span><a class="btn btn-success fs-5 fw-bold py-1 px-3 text-uppercase more" href="#"><?php echo $options['moreBtnText'] ?></a></div>
        </div>
      </div>
      <?php

    } else if ( $options['tpl'] === 'list' ) {
     
      ?>
      <!-- Generate Html LIST module -->
      <div class="container-fluid">
        <div class="container py-4 my-3">
          <h3 class="text-success text-uppercase module-title mb-4"><?php echo $options['moduleTitle']; ?></h3>

            <table class="w-100 table table-hover align-middle">
              <tbody>

                <?php 
                $first = true;
                foreach( $products as $product ) {

                  switch ( $product['universe_id'] ) {
                    case 1: $unvImg = "BOOK"; break;
                    case 2: $unvImg = "CD"; break;
                    case 3: $unvImg = "DVD"; break;
                    case 4: $unvImg = "DOCS"; break;
                  } 
                  $imgsrc    = '../../../../images/products/' . ( $product['image'] ? $product['image'] : 'image_' . $unvImg . '_empty.svg' );
                  $imgcatsrc = $product['category_image'] ? '../../../../images/categories/' . $product['category_image'] : '';
                  $created   = new DateTime($product['created_on']);
                  $modified  = new DateTime($product['created_on']);

                  switch ( $options['orderBy'] ) {
                    case 'year'     : $displayOrderValue = "Sortie : "     . $product['year'];                                                  break;
                    case 'sales'    : $displayOrderValue = "Ventes : "     . $product['sales'];                                                 break;
                    case 'rating'   : $displayOrderValue = "Note : "       . $product['rating'] . "/5 (" . $product['rating_num'] . " votes)";  break;
                    case 'hits'     : $displayOrderValue = "Vues : "       . $product['hits'];                                                  break;
                    case 'created'  : $displayOrderValue = "Ajouté le : "  . $created->format('d F Y');                                         break;
                    case 'modified' : $displayOrderValue = "Modifié le : " . $modified->format('d F Y');                                        break;
                    case 'random'   : $displayOrderValue = "Sortie : "     . $product['year'];                                                  break;
                    default         : $displayOrderValue = "Sortie : "     . $product['year'];                                                  break;
                  }

                ?>

                <tr class="<?php echo $first ? 'border-top ' : ''; ?>border-bottom border-secondary">

                  <td class="text-start pe-2 ps-0" style="width: 70px;">
                    <img src="<?php echo $imgsrc; ?>" class="col py-0 my-3 mx-auto" style="height:48px;" alt="<?php echo $product['title']; ?>">
                  </td>

                  <td class="text-start px-2 w-50" style="max-width: 40%;">
                    <a class="text-decoration-none text-dark" 
                      href="../../../controller/site/product/show.php?id=<?php echo $product['id']; ?>">
                      <h5 class="fs-4"><?php echo $product['title']; ?></h5>
                    </a>
                    <div class=""><?php echo $product['maker']; ?></div>
                  </td>

                  <td class="text-start px-2">
                    <div class=""><?php echo $product['brand']; ?></div>
                    <div class=""><?php echo $product['category']; ?></div>
                  </td>

                  <td class="text-start px-2">
                    <div class=""><?php echo $displayOrderValue; ?></div>
                    <?php if ( $product['rating'] ) { ?>
                      <div class="text-success rating"><?php echo ViewTemplateSite::genRatingStars( $product['rating'] ) . '<span class="fw-bold"> &nbsp; (' . $product['rating_num'] . ')</span>'; ?></div>
                    <?php } else { ?>
                      <div class="text-secondary rating">Pas noté</div>
                    <?php } ?>
                  </td>

                  <td class="text-start px-2" style="width: 70px;">
                    <span class="price fw-bold fs-5" style="z-index: 10;"><?php echo $product['price']; ?> €</span>
                  </td>

                  <td class="text-end ps-2 pe-0" style="width: 40px;">
                    <a href="../cart/cart.php?action=add&amp;id=<?php echo $product['id']; ?>&amp;l=<?php echo $product['title']; ?>&amp;a=<?php echo $product['maker']; ?>&amp;r=<?php echo $product['reference']; ?>&amp;q=1&amp;p=<?php echo $product['price']; ?>" 
                      class="btn btn-success px-1 pt-1 pb-0 ms-2" 
                      title="Ajouter au panier" >
                      <i class="fa-solid fa-cart-plus fs-5"></i>
                    </a>
                  </td>

                </tr>

                <?php 
                  $first = false;
                } 
                ?>

            </tbody>
          </table>

          <div class="mt-4 fs-5 text-end"><span class="py-1 me-2">Plus de </span><a class="btn btn-success fs-5 fw-bold py-1 px-3 text-uppercase more" href="#"><?php echo $options['moreBtnText'] ?></a></div>
        </div>
      </div>
      <?php

    }

  }


}


?>