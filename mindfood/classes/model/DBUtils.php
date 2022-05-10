<?php

/**
 * @class   DBUtils
 * @summary Model Class for DB Utilities
 */
class DBUtils {


  /**
   * @function getDBConnection()
   * @summary  Function to get a connection to DB
   */
  public static function getDBConnection() {
    $servername = "localhost";  // nom du serveur
    $username   = "root";       // nom d'utilisateur de mysql
    $password   = "aaa";   // mot de passe mysql
    $dbname     = "mindfood";   // nom de la base
    try {
      $dbconn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
      return $dbconn;
    } catch ( PDOException $e ) {
      echo "Connection failed: " . $e->getMessage();
      return FALSE;
      exit();
    }
  }


}

?>