<?php
require_once('../../../model/DBUtils.php');
require_once("../../../utils/config.php");
require_once("../../../utils/acl.php");

/**
 * @class   NewProducts module
 * @summary Class to extract new products in DB
 *          and display them where this module
 *          is applied
 */
Class ModProductsByDate {

  /**
   * @function getProductsByDate()
   * @summary return created or modified products 
   *          by universe, by category and/or by brand
   * @param $options = [
   *          'universe_id' => [id of the Universe] (default : null)
   *          'category_id' => [id of the Category] (default : null)
   *          'brand_id'    => [id of the Brand]    (default : null)
   *          'orderby'     => ["columnName + Direction"] (default: ['created_on DESC'])
   *          'nbDisplay'   => [# of products to display randomly among returned products] (default : 4)
   *          'nbQuery'     => [# of products to return] (default : 4)
   *        ]
   * @return All requested Entities data
   */
  private static function getProductsByDate( $options = null ) {

    $whereUnv = $options['universe_id'] ? 'prd.universe_id = ' . $options['universe_id'] : null;
    $whereCat = $options['category_id'] ? 'prd.category_id = ' . $options['category_id'] : null;
    $whereBrd = $options['brand_id']    ? 'prd.brand_id = '    . $options['brand_id']    : null;
    $where    = $whereUnv     ? $whereUnv                                  : '';
    $where   .= $whereCat     ? ($where !== '' ? ' AND ' : '') . $whereCat : '';
    $where   .= $whereBrd     ? ($where !== '' ? ' AND ' : '') . $whereCat : '';
    $where    = $where !== '' ? 'WHERE ' . $where . ' ' : '';

    switch ($options['orderby']) {
      case 'created'  : $mode = 'created_on';  break;
      case 'modified' : $mode = 'modified_on'; break;
      default         : $mode = 'created_on';  break;
    }
    if ( is_array($options['orderby']) ) {
      $orderby = "ORDER BY " . implode( " AND ", $options['orderby'] ) . " ";
    } else {
      $orderby = "ORDER BY created_on DESC ";
    }

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
      $orderby . "  
      LIMIT 0, " . $options['nbQuery'] . ";
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
   * @function genProductsByDate()
   * @summary  return Html generated code for a module with n last products
   *           by universe, by category and/or by brand
   * @param    $options = [
   *             'display'     => ['H-Blocks', 'V-Blocks', 'table'] (default : 'H-Blocks')
   *             'moduleTitle' => ['module title'] (default : 'Nouveautés')
   *             'universe_id' => [id of the Universe] (default : null)
   *             'category_id' => [id of the Category] (default : null)
   *             'brand_id'    => [id of the Brand]    (default : null)
   *             'orderby'     => ["columnName + Direction"] (default: ['created_on DESC'])
   *             'nbDisplay'   => [# of products to display randomly among returned products] (default : 4)
   *             'nbQuery'     => [# of products to return] (default : 4)
   *           ]
   */
  public static function genProductsByDate( $options = null ) {

    // Check Display mode
    // switch ( $options['display'] ) {
    //   case 'H-Blocks' : $display = 'H-Blocks'; break;
    //   case 'V-Blocks' : $display = 'V-Blocks'; break;
    //   case 'table'    : $display = 'table';    break;
    //   default         : $display = 'H-Blocks'; break;
    // }

    // Check $nb value
    $nbDisplay = $options['nbDisplay'];
    $nbH = $options['nbDisplay'] > 0 ? $options['nbDisplay'] : min($nbDisplay, 6);

    // Get Products from DB Product table
    $result = ModProductsByDate::getProductsByDate( $options );
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
    
    // Generate Html module
  ?>
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
            $imgsrc = '../../../../images/products/' . ( $product['image'] ? $product['image'] : 'image_' . $unvImg . '_empty.svg' );
            $imgcatsrc = $product['category_image'] ? '../../../../images/categories/' . $product['category_image'] : '';
            $date = new DateTime($product['created_on']);

          ?>
            <div class="col">

                <div class="card h-100 bg-light text-center">
                  
                  <img src="<?php echo $imgsrc; ?>" class="card-img-top py-0 my-3 mx-auto" style="max-width: 80%; height:128px;" alt="<?php echo $product['title']; ?>">
                  
                  <div class="card-body text-start p-2">
                    <a class="text-decoration-none text-dark stretched-link" 
                       href="../../../controller/site/product/show.php?id=<?php echo $product['id']; ?>">
                      <h5 class="card-title"><?php echo $product['title']; ?></h5>
                    </a>
                    <div class="card-text"><?php echo $product['maker']; ?></div>
                    <div class="card-text mt-2"><?php echo $product['brand']; ?></div>
                  </div>

                  <div class="card-footer text-start mt-2 pt-2">
                    <div class="d-flex align-items-content category">
                      <?php if ( $imgcatsrc <> '' ) { ?>
                        <img src="<?php echo $imgcatsrc; ?>" class="me-2" style="max-width: 32px; max-height:24px;">
                      <?php } ?>
                      <div class="card-text"><?php echo $product['category']; ?></div>
                    </div>
                    <div class="card-text mt-2">Sortie : <?php echo $date->format('F Y'); ?></div>
                  </div>

                  <div class="card-footer d-flex justify-content-between align-items-center p-2 text-end">
                    <div class="rating"><?php if ( $product['rating'] != null ) { echo $product['rating'] . '/5 (' . $product['rating_num'] . ' votes)'; } ?></div>
                    <div class="price fs-5" style="z-index: 10;"><?php echo $product['price']; ?> €
                    <a href="../cart/panier.php?action=ajout&amp;id=<?php echo $product['id']; ?>&amp;l=<?php echo $product['title']; ?>&amp;a=<?php echo $product['maker']; ?>&amp;q=1&amp;p=<?php echo $product['price']; ?>" 
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
        <div class="mt-4 fs-5 text-end">Voir toutes les <a class="btn btn-success fs-5 fw-bold py-1 px-3 ms-2 more" href="#"><?php echo $options['moduleTitle'] ?></a></div>
      </div>
    </div>
  <?php

  }


}


?>