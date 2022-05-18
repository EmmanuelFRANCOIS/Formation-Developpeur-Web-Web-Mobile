<?php
header( "Access-Control-Allow-Origin: *" );
header( "Content-Type: application/json; charset=UTF-8" );

require_once "../../model/ModelEntity.php";

/**
 * @class   RESTApiEntity
 * @summary REST Api to manage Entities
 */
class RESTApi_Entity {


  /**
   * @function getEntities()
   * @summary  Function to get the list of all Entities and their data
   * @return   All Entities data
   */
  public function getEntities() {

    // Get Entities from Model
    $modelEntity = new ModelEntity();
    $result = $modelEntity->getEntities();

    if ( is_array($result) && $result->rowCount() > 0 ) {
      // Return set of Entities as JSON object
      return json_encode( $result );
    } else {
      // Return the error message received from Model
      return $result;
    }

  }


  /**
   * @function getEntity()
   * @summary  Function to get an existing Entity data
   * @param    id of the existing Entity to get data of
   * @return   Selected Entity data
   */
  public function getEntity( $id ) {

    // Get Entity from Model
    $modelEntity = new ModelEntity();
    $result = $modelEntity->getEntity( $id );

    if ( is_array($result) ) {
      // Return Entity data as JSON object
      return json_encode( $result );
    } else {
      // Return the error message received from Model
      return $result;
    }

  }


  /**
   * @function createEntity()
   * @summary  Function to create a new Entity
   * @param    entity : JSON object with Entity data
   * @return   id of the successfully newly created Entity
   */
  public function createEntity( $entity ) {

    // Add Entity through the Model
    $modelEntity = new ModelEntity();
    $result = $modelEntity->createEntity( 
      json_decode( $entity )
    );

    return $result;

  }


  /**
   * @function updateEntity()
   * @summary  Function to update an existing Entity data
   * @param    entity : JSON object with Entity data to update
   * @return   true if the Entity has been successfully updated
   */
  public function updateEntity( $entity ) {

    // Update Entity through the Model
    $modelEntity = new ModelEntity();
    $result = $modelEntity->updateEntity( 
      json_decode( $entity )
    );

    return $result;

  }


  /**
   * @function deleteEntity()
   * @summary  Function to delete an existing Entity
   * @param    id of the existing Entity to delete
   * @return   true if the Entity has been successfully deleted
   */
  public function deleteEntity( $id ) {

    // Update Entity through the Model
    $modelEntity = new ModelEntity();
    $result = $modelEntity->deleteEntity( $id );

    return $result;

  }


}


?>