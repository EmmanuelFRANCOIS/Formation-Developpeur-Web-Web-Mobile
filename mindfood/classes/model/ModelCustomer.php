<?php
require_once "DBUtils.php";

/**
 * @class   ModelCustomer
 * @summary Model Class for Customers management
 */
class ModelCustomer {


  /**
   * @function signupCustomer()
   * @summary  Function to signup a Customer
   * @param    $customer => Customer's signup details
   */
  public function signupCustomer( $customer ) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      INSERT INTO customer (firstname, lastname, email, password) 
      VALUES (:firstname, :lastname, :email, :password)
    ");
    return $requete->execute([
      ':firstname' => ucwords(strtolower($customer['firstname'])),
      ':lastname'  => strtoupper($customer['lastname']),
      ':email'     => $customer['email'],
      ':password'  => password_hash( $customer['password'], PASSWORD_DEFAULT )
    ]);
  }


  /**
   * @function loginCustomer()
   * @summary  Function to login a customer
   * @param    $email => email of the Customer to get details of
   */
  public function getCustomerByEmail( $email ) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      SELECT * FROM customer WHERE email=:email
    ");
    $requete->execute([
      ':email' => $email,
    ]); 
    return $requete->fetch(PDO::FETCH_ASSOC);
  }


  /**
   * @function getCustomers()
   * @summary  Function to get Customers' list
   */
  public function getCustomers() {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      SELECT * FROM customer
    ");
    $requete->execute(); 
    return $requete->fetchAll(PDO::FETCH_ASSOC);
    }


  /**
   * @function getCustomer()
   * @summary  Function to get a Customer's details
   * @param    $id => id of the Customer to get details of
   */
  public function getCustomer( $id ) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      SELECT * FROM customer WHERE id=:id
    ");
    $requete->execute([
      ':id' => $id,
    ]); 
    return $requete->fetch(PDO::FETCH_ASSOC);
  }


  /**
   * @function updateCustomer()
   * @summary  Function to update a Customer's details
   * @param    $customer => details of the Customer to update
   */
  public function updateCustomer( $customer ) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      UPDATE customer 
      SET avatar = :avatar, 
          firstname = :firstname, lastname = :lastname, 
          email = :email, password = :password,
          address = :address, zipcode = :zipcode, city = :city, 
          fixedPhone = :fixedPhone, mobilePhone = :mobilePhone
      WHERE id = :id
    ");
    return $requete->execute([
      ':id'           => $customer['id'],
      ':avatar'       => $customer['avatar'],
      ':firstname'    => ucwords(strtolower($customer['firstname'])),
      ':lastname'     => strtoupper($customer['lastname']),
      ':email'        => $customer['email'],
      ':password'     => password_hash( $customer['password'], PASSWORD_DEFAULT ),
      ':address'      => $customer['address'],
      ':zipcode'      => $customer['zipcode'],
      ':city'         => ucwords(strtolower($customer['city'])),
      ':fixedPhone'   => $customer['fixedPhone'],
      ':mobilePhone'  => $customer['mobilePhone'],
    ]);
  }


  /**
   * @function deleteCustomer()
   * @summary  Function to delete a Customer
   * @param    $id => id of the Customer to delete
   */
  public function deleteCustomer( $id ) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      DELETE FROM customer WHERE id = :id
    ");
    return $requete->execute([
      ':id' => $id
    ]);
  }

}
