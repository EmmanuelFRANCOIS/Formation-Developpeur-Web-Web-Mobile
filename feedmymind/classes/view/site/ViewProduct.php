<?php
require_once "../../../utils/config.php";

/**
 * @class   ViewProduct
 * @summary Class to generate Product views modules
 */
class ViewProduct {


  /**
   * @function  genProductsHeader()
   * @summary   Function to generate Products page header
   * @return    html
   */
  public static function genProductsHeader() {

  }


  /**
   * @function  genProductSheet()
   * @summary   Function to generate Product page
   * @return    html
   */
  public static function genProductSheet( $config, $product ) {
    include "../../../utils/localization.php";

    $action = htmlspecialchars( $_SERVER["PHP_SELF"] );
    $imagePath  = '../../../../images/' . ($product['image'] ? $config['imagePath']['products'] . $product['image'] : 'image_empty.svg');
    $imageAlt = $product['title'];
?>
    <div class="container-fluid py-4 px-4">
      <div class="container">
        <form class="col-12 p-4 pb-3" method="POST" action="<?php echo $action;?>" enctype="multipart/form-data">
          <input type="hidden" class="col-9 form-control" 
                  id="id" name="id" 
                  placeholder="" 
                  value="<?= $product['id'] ?>" 
                  readonly>
          <div class="row flex-wrap">
            <div class="col-12 col-sm-3 px-5 mt-3 text-center form-group">
              <img style="max-width: 90%; max-height: 100%; border-radius: 8px;" 
                  src="<?php echo $imagePath; ?>" 
                  alt="<?php echo $imageAlt; ?>" 
                  class="mb-1 image"
              >
            </div>
            <div class="col form-group">
              <div class="form-group d-sm-flex">
                <div class="col form-group mt-3 pe-sm-2">
                  <h1 class="px-2 py-2 rounded rounded-3 fw-bold mb-0 pb-0"><?php echo $product['title']; ?></h1>
                </div>
                <div class="col-auto form-group mt-3 ps-sm-2">
                  <div class="px-2 text-secondary">Note</div>
                  <div class="px-2 text-success"><?php echo ViewTemplateSite::genRatingStars( $product['rating'], $product['rating_num'] ); ?></div>
                </div>
              </div>
              <div class="form-group">
                <div class="colcol-sm-6 form-group pe-sm-2">
                  <div class="px-2 text-secondary">de <span class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['maker']; ?></span></div>
                </div>
                <div class="col col-sm-6 form-group ps-sm-2">
                  <div class="px-2 text-secondary">édité par <span class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['brand']; ?></span></div>
                </div>
              </div>
              <div class="form-group d-sm-flex">
                <div class="col-12 col-sm-6 col-md-4 form-group mt-3 pe-sm-2">
                  <div class="px-2 text-secondary">Univers</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['universe']; ?></div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 form-group mt-3 px-sm-2">
                  <div class="px-2 text-secondary">Categorie</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['category']; ?></div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 form-group mt-3 ps-sm-2">
                  <div class="px-2 text-secondary">Marque</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['brand']; ?></div>
                </div>
              </div>
              <div class="form-group d-sm-flex">
                <div class="col-12 col-sm-4 form-group mt-3 pe-sm-2">
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['reference']; ?></div>
                  <div class="px-2 text-secondary">Stock</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['stock']; ?></div>
                </div>
                <div class="col-12 col-sm-4 form-group mt-3 px-sm-2">
                  <div class="px-2 text-secondary">Stock Min</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['stock_min']; ?></div>
                </div>
                <div class="col-12 col-sm-4 form-group mt-3 ps-sm-2">
                  <div class="px-2 text-secondary">Prix</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['price']; ?></div>
                </div>
              </div>
              <div class="form-group mt-3">
                <div class="px-2 text-secondary">Description</div>
                <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['description']; ?></div>
              </div>
              <div class="form-group d-sm-flex">
                <div class="col-12 col-sm-6 form-group mt-3 pe-sm-2">
                  <div class="px-2 text-secondary">Meta-Description</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['metadesc']; ?></div>
                </div>
                <div class="col-12 col-sm-6 form-group mt-3 ps-sm-2">
                  <div class="px-2 text-secondary">Meta-Keywords</div>
                  <div class="px-2 py-2 bg-white rounded rounded-3 fs-5"><?php echo $product['metakey']; ?></div>
                </div>
              </div>
              <div class="col-12 mt-3 d-flex justify-content-end align-items-center">
                <button class="btn btn-primary me-3" type="submit" name="edit">Modifier</button>
                <button class="btn btn-dark" type="cancel" name="close">Fermer</button>
              </div>
            </div>
          </div>
        </form>
        <div class="d-flex px-1 pb-4 justify-content-between">
          <div>&nbsp;</div>
          <button class="btn btn-danger me-3" 
                  onclick="getConfirmation( 
                          'Voulez-vous vraiment supprimer l\'Produit\n\n<?php echo $product['title'] ?>', 
                          'delete.php?id=<?php echo $product['id'] ?>' 
                        )"
                  name="none">Supprimer</button>
        </div>
      </div>
      <script>
        function getConfirmation( msg, link ) {
          if ( confirm(msg) == true ) {
            window.location.href = link;
          }
        }
      </script>
    </div>
<?php

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
  public static function genProducts( $config, $products, $options = null ) {
    include_once "../../../utils/localization.php";

    // Check $nb value
    $nbDisplay = $options['nbDisplay'] > 0 ? $options['nbDisplay'] : $config['site']['modules']['nbDisplay'];
    $nbByRow = $options['nbByRow'] > 0 ? $options['nbByRow'] : $config['site']['modules']['nbByRow'];
    $nbH = $nbByRow > 0 ? $nbByRow : min($nbDisplay, $config['site']['modules']['nbMaxByRow']);

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
              $imgsrc    = '../../../../images/' . $config['imagePath']['products'] . '/' . ( $product['image'] ? $product['image'] : 'image_' . $unvImg . '_empty.svg' );
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
                    
                    <img src="<?php echo $imgsrc; ?>" class="card-img-top py-0 my-3 mx-auto" style="width: auto !important; max-width: 128px; height:128px;" alt="<?php echo $product['title']; ?>">
                    
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
                      <div class="text-success rating"><?php echo ViewTemplateSite::genRatingStars( $product['rating'], $product['rating_num'] ); ?></div>
                      <div class="d-flex justify-content-end align-items-center fw-bold fs-5" style="z-index: 10;">
                        <div><?php echo Lclz::fmtMoney($product['price']); ?></div>
                        <a href="../cart/cart.php?action=add&amp;id=<?php echo $product['id']; ?>&amp;u=<?php echo $product['universe_id']; ?>&amp;c=<?php echo $product['category_id']; ?>&amp;b=<?php echo $product['brand_id']; ?>&amp;m=<?php echo $product['image']; ?>&amp;l=<?php echo $product['title']; ?>&amp;a=<?php echo $product['maker']; ?>&amp;r=<?php echo $product['reference']; ?>&amp;q=1&amp;p=<?php echo $product['price']; ?>" 
                          class="btn btn-success p-2 pb-1 ms-2" 
                          title="Ajouter au panier" >
                          <i class="fa-solid fa-cart-plus fs-5"></i>
                        </a>
                      </div>
                    </div>

                  </div>

              </div>
            <?php 
            } 
            ?>

          </div>
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
                    <img src="<?php echo $imgsrc; ?>" class="col py-0 my-3 mx-auto" style="height:64px;" alt="<?php echo $product['title']; ?>">
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
                    <div class="text-success rating"><?php echo ViewTemplateSite::genRatingStars( $product['rating'], $product['rating_num'] ); ?></div>
                  </td>

                  <td class="text-start px-2" style="width: 70px;">
                    <span class="price fw-bold fs-5" style="z-index: 10;"><?php echo Lclz::fmtMoney($product['price']); ?></span>
                  </td>

                  <td class="text-end ps-2 pe-0" style="width: 40px;">
                    <a href="../cart/cart.php?action=add&amp;id=<?php echo $product['id']; ?>&amp;u=<?php echo $product['universe_id']; ?>&amp;c=<?php echo $product['category_id']; ?>&amp;b=<?php echo $product['brand_id']; ?>&amp;m=<?php echo $product['image']; ?>&amp;l=<?php echo $product['title']; ?>&amp;a=<?php echo $product['maker']; ?>&amp;r=<?php echo $product['reference']; ?>&amp;q=1&amp;p=<?php echo $product['price']; ?>" 
                      class="btn btn-success p-2 pb-1 ms-2" 
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

        </div>
      </div>
      <?php

    }

  }


}


?>
