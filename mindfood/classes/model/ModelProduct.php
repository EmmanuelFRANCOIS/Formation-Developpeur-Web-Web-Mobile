<?php
// DB Connexion Utility
require_once('DBUtils.php');


/**
 * @class   ModelProduct
 * @summary Class to manage Products (DB layer)
 */
class ModelProduct {


  /**
   *  Function to get the list of all Products
   */
  public static function getProducts() {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT * FROM product
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   *  Function to get the list of all Products
   */
  public static function getProductsComplete() {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT prd.*, unv.title AS universe, cat.title as category, brd.title AS brand
      FROM product AS prd
      INNER JOIN universe AS unv ON unv.id = prd.universe_id
      INNER JOIN category AS cat ON cat.id = prd.category_id
      INNER JOIN brand AS brd ON brd.id = prd.brand_id
      GROUP BY prd.id
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   *  Function to get the list of Products from DB table
   */
  public static function getProductsTable() {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT prd.*, unv.title AS universe, cat.title as category, brd.title AS brand
      FROM product AS prd
      INNER JOIN universe AS unv ON unv.id = prd.universe_id
      INNER JOIN category AS cat ON cat.id = prd.category_id
      INNER JOIN brand AS brd ON brd.id = prd.brand_id
      GROUP BY prd.id
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }

  
  public function addProduct( $product ) {

    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      INSERT INTO product (universe_id, category_id, brand_id, maker, reference, title, image, description, stock, stock_min, price, metakey, metadesc, hits) 
      VALUES (:universe_id, :category_id, :brand_id, :maker, :reference, :title, :image, :description, :stock, :stock_min, :price, :metakey, :metadesc, :hits)
    ");
    $requete->execute([
      ':universe_id'  => $product['universe_id'],
      ':category_id'  => $product['category_id'],
      ':brand_id'     => $product['brand_id'],
      ':maker'        => $product['maker'],
      ':reference'    => $product['reference'],
      ':title'        => $product['title'],
      ':image'        => $product['image'],
      ':description'  => $product['description'],
      ':stock'        => $product['stock'],
      ':stock_min'    => $product['stock_min'],
      ':price'        => $product['price'],
      ':metakey'      => $product['metakey'],
      ':metadesc'     => $product['metadesc'],
      ':hits'         => $product['hits']
    ]);
    // Debug query
    //$requete->debugDumpParams();

    return $dbconn->lastInsertId();

  }


  public function getProduct($id) {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT * FROM product
      WHERE id = " . $id
    );
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetch(PDO::FETCH_ASSOC);
  }


  public function getProductComplete($id) {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
    SELECT prd.*, unv.title AS universe, cat.title as category, brd.title AS brand
    FROM product AS prd
    INNER JOIN universe AS unv ON unv.id = prd.universe_id
    INNER JOIN category AS cat ON cat.id = prd.category_id
    INNER JOIN brand AS brd ON brd.id = prd.brand_id
    WHERE prd.id = " . $id
    );
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetch(PDO::FETCH_ASSOC);
  }


  public function updateProduct( $product)  {

    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      UPDATE product 
      SET universe_id = :universe_id, category_id = :category_id, 
          brand_id = :brand_id, maker = :maker, reference = :reference, 
          title = :title, image = :image, description = :description, 
          stock = :stock, stock_min = :stock_min, price = :price, 
          metakey = :metakey, metadesc = :metadesc, hits = :hits 
      WHERE id = :id
    ");
    return $requete->execute([
      ':id'           => $product['id'],
      ':universe_id'  => $product['universe_id'],
      ':category_id'  => $product['category_id'],
      ':brand_id'     => $product['brand_id'],
      ':maker'        => $product['maker'],
      ':reference'    => $product['reference'],
      ':title'        => $product['title'],
      ':image'        => $product['image'],
      ':description'  => $product['description'],
      ':stock'        => $product['stock'],
      ':stock_min'    => $product['stock_min'],
      ':price'        => $product['price'],
      ':metakey'      => $product['metakey'],
      ':metadesc'     => $product['metadesc'],
      ':hits'         => $product['hits']
      ]);
      
    // Debug query
    //$requete->debugDumpParams();

  }

  
  public function deleteProduct($id) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      DELETE FROM product WHERE id = :id
    ");
    return $requete->execute([
      ':id' => $id
    ]);
    // Debug query
    //$requete->debugDumpParams();
  }



}

?>