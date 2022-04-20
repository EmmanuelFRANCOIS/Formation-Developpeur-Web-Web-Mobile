<?php

/**
 *  Model Class for DB Utilities
 */
class DBUtils {


  /**
   * @function getDBConnection()
   * @description Function to connect to DB
   */
  public static function getDBConnection() {
    $servername = "localhost";  // nom du serveur
    $username   = "root";       // nom d'utilisateur de mysql
    $password   = "johnjohn";   // mot de passe mysql
    $dbname     = "filrouge";   // nom de la base
    /* Attempt to connect to MySQL database */
    try{
      $pdo = new PDO("mysql:host=" . $servername . ";dbname=" . $dbname, $username, $password);
      // Set the PDO error mode to exception
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch( PDOException $e ){
      die("ERROR: Could not connect. " . $e->getMessage());
    }

  }


}

?>