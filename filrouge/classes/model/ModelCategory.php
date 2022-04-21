<?php
// DB Connexion Utility
require_once('DBUtils.php');


/**
 *  Model Class for Categories
 */
class ModelCategory {

  /**
   *  Constructor
   */
  // public function __construct() {}

  /**
   *  Function to get the list of Categories from DB table
   */
  public static function getCategories()
  {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT cat.*, unv.title AS universe, cat2.title AS parent, COUNT(prod.id) AS nbproducts
      FROM category cat 
      INNER JOIN universe unv ON unv.id = cat.universe_id 
      LEFT JOIN category cat2 ON cat2.id = cat.parent_id 
      LEFT JOIN product prod ON cat.id = prod.category_id 
      GROUP BY cat.id 
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addCategory($customer) {}

  public function getCategory($customer) {}

  public function updateCategory($customer) {}

  public function deleteCategory($customer) {}



}

?>