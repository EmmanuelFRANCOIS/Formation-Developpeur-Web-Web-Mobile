<?php
// DB Connexion Utility
require_once "DBUtils.php";

/**
 * @class   ModelOrder
 * @summary Class to manage Orders (DB layer)
 */
class ModelOrders {


  /**
   *  Function to get the list of all Orders
   */
  public static function getOrders() {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT * FROM orders
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }


  /**
   *  Function to get the list of Orders from DB table
   */
  public static function getOrdersTable( $customer_id ) {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT ord.*, 
             sum(op.quantity) AS qty, 
             sum(op.quantity * op.price / (1 + op.tva)) AS totalHT, 
             sum(op.quantity * op.price) AS totalTTC
      FROM orders AS ord
      INNER JOIN orders_products AS op ON op.order_id = ord.id 
      WHERE ord.customer_id = " . $customer_id . " 
      GROUP BY ord.id 
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
  }

  
  public function addOrder( $order ) {

    var_dump($order);

    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      INSERT INTO orders (title, image, description) 
      VALUES (:title, :image, :description)
    ");
    $requete->execute([
      ':title'        => $order['title'],
      ':image'        => $order['image'],
      ':description'  => $order['description'],
    ]);
    // Debug query
    //$requete->debugDumpParams();

    return $dbconn->lastInsertId();

  }


  public function createOrderFromCart( $order ) {

    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      INSERT INTO orders (customer_id, date_order, order_no, date_bill, bill_no, date_paid, date_sent, delivery_no, date_delivered, date_returned, date_cancelled, status, delivery_point, delivery_address, carrier_id) 
      VALUES (:customer_id, :date_order, :order_no, :date_bill, :bill_no, :date_paid, :date_sent, :delivery_no, :date_delivered, :date_returned, :date_cancelled, :status, :delivery_point, :delivery_address, :carrier_id)
    ");
    $requete->execute([
      ':customer_id'      => $order['customer_id'], 
      ':date_order'       => $order['date_order'], 
      ':order_no'         => $order['order_no'], 
      ':date_bill'        => $order['date_bill'], 
      ':bill_no'          => $order['bill_no'], 
      ':date_paid'        => $order['date_paid'], 
      ':date_sent'        => $order['date_sent'], 
      ':delivery_no'      => $order['paid'], 
      ':date_delivered'   => $order['date_delivered'], 
      ':date_returned'    => $order['date_returned'], 
      ':date_cancelled'   => $order['date_cancelled'], 
      ':status'           => $order['status'], 
      ':delivery_point'   => $order['delivery_point'], 
      ':delivery_address' => $order['delivery_address'], 
      ':carrier_id'       => $order['carrier_id'] 
    ]);
    // Debug query
    //$requete->debugDumpParams();

    return $dbconn->lastInsertId();

  }


  public function createOrderProductsFromCart( $config, $order_id, $products ) {

    //echo 'order_id = ' . $order_id . '<br />';
    //var_dump($products);
    //echo '<br /><br />';

    $nbProducts = count( $_SESSION['panier']['libelleProduit'] );
    
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      INSERT INTO orders_products (order_id, product_id, quantity, price, tva, delivery_cost) 
      VALUES (:order_id, :product_id, :quantity, :price, :tva, :delivery_cost)
    ");
    $nbRowsAddedIntoTable = 0;
    for ( $i=0; $i < $nbProducts; $i++ ) {
      $requete->execute([
        ':order_id'      => $order_id, 
        ':product_id'    => $products['idProduit'][$i], 
        ':quantity'      => $products['qteProduit'][$i], 
        ':price'         => $products['prixProduit'][$i], 
        ':tva'           => $config['tva'], 
        ':delivery_cost' => $config['delivery_cost_per_product']
      ]);
      $nbRowsAddedIntoTable += 1;
    }
    // Debug query
    //$requete->debugDumpParams();

    return $nbRowsAddedIntoTable;

  }


  public function getOrder( $id ) {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT * FROM orders
      WHERE id = " . $id
    );
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetch(PDO::FETCH_ASSOC);
  }


  public function getOrderProducts( $id) {
    $dbconn = DBUtils::getDBConnection();
    $req = $dbconn->prepare("
      SELECT op.*, unv.title AS universe, prd.title AS title, prd.maker AS maker
      FROM orders_products AS op 
      INNER JOIN product AS prd ON prd.id = op.product_id 
      INNER JOIN universe AS unv ON unv.id = prd.universe_id 
      WHERE op.order_id = " . $id . "
      GROUP BY op.product_id
    ");
    $req->execute();
    // Debug query
    //$req->debugDumpParams();
    return $req->fetchAll(PDO::FETCH_ASSOC);
    
  }


  public function updateOrder( $orders ) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      UPDATE orders 
      SET title = :title, image = :image, description = :description 
      WHERE id = :id
    ");
    $requete->execute([
      ':id'            => $orders['id'],
      ':title'         => $orders['title'], 
      ':image'         => $orders['image'],
      ':description'   => $orders['description']
      ]);
    // Debug query
    //$requete->debugDumpParams();
  }

  
  public function payOrder( $id ) {
    $datePaid = date("Y-m-d H:i:s");
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      UPDATE orders 
      SET date_paid = :date_paid, status = :status 
      WHERE id = :id
    ");
    $requete->execute([
      ':id'            => $id,
      ':date_paid'     => $datePaid, 
      ':status'        => 'paid'
      ]);
    // Debug query
    //$requete->debugDumpParams();
  }

  
  public function deleteOrder( $id ) {
    $dbconn = DBUtils::getDBConnection();
    $requete = $dbconn->prepare("
      DELETE FROM orders WHERE id = :id
    ");
    $requete->execute([
      ':id' => $id
    ]);
    // Debug query
    //$requete->debugDumpParams();
  }



}

?>