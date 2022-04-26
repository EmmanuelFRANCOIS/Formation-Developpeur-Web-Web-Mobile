<?php
// DB Connexion Utility
require_once('DBUtils.php');


/**
 * @class   ModelUniverse
 * @summary Class to manage Universes (DB layer)
 */
class ModelUniverse {

  /**
   *  Function to get the list of Universes from DB table
   */
  public static function getUniverses()
  {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT * FROM universe 
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }

  public function addUniverse($customer) {}

  public function getUniverse($customer) {}

  public function updateUniverse($customer) {}

  public function deleteUniverse($customer) {}



}

?>