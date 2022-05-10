<?php
// DB Connexion Utility
require_once('DBUtils.php');


/**
 * @class   ModelUniverse
 * @summary Class to manage Universes (DB layer)
 */
class ModelUniverse {


  /**
   *  Function to get the list of all Universes
   */
  public static function getUniverses() {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT * FROM universe
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   *  Function to get the list of Universes from DB table
   */
  public static function getUniversesTable() {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT * 
      FROM universe 
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }

  
  public function addUniverse( $universe ) {

    //var_dump($universe);

    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      INSERT INTO universe (title, image, description) 
      VALUES (:title, :image, :description)
    ");
    $requete->execute([
      ':title'        => $universe['title'],
      ':image'        => $universe['image'],
      ':description'  => $universe['description'],
    ]);
    // Debug query
    $requete->debugDumpParams();

    return $dbconn->lastInsertId();

  }


  public function getUniverse($id) {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT * FROM universe
      WHERE id = " . $id
    );
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetch(PDO::FETCH_ASSOC);
  }


  public function updateUniverse($universe) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      UPDATE universe 
      SET title = :title, image = :image, description = :description 
      WHERE id = :id
    ");
    $requete->execute([
      ':id'            => $universe['id'],
      ':title'         => $universe['title'], 
      ':image'         => $universe['image'],
      ':description'   => $universe['description']
      ]);
    // Debug query
    $requete->debugDumpParams();
  }

  
  public function deleteUniverse($id) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      DELETE FROM universe WHERE id = :id
    ");
    $requete->execute([
      ':id' => $id
    ]);
    // Debug query
    $requete->debugDumpParams();
  }



}

?>