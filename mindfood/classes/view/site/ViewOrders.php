<?php



class ViewOrders {


  /**
   * @function genCustomerOrders()
   * @summary  Function to generate customer orders page
   */
  public static function genOrderValidationForm( $config, $order, $products ) {
    $date = new DateTime( $order['date_order'] );
    $date_order = $date->format('D d F Y') . ' à ' . $date->format('H:i:s');
    $date = new DateTime( $order['date_bill'] );
    $date_bill = $date->format('D d F Y') . ' à ' . $date->format('H:i:s');
    $status = $config['statusList'][$order['status']];
?>
    <div class="container-fluid py-4">
      <div class="container">
        <h3 class="text-uppercase">Payer ma commande</h3>
        <form class="mt-4 mb-4 p-4 border border-success rounded" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="<?php echo $order['id']; ?>">
          <div class="row">
            <div class="col-6">
              <div class="row"><div class="col-4 text-secondary">Date commande : </div><div class="col fw-bold"><?php echo $date_order; ?></div></div>
              <div class="row"><div class="col-4 text-secondary">Commande n° </div><div class="col fw-bold"><?php echo $order['order_no']; ?></div></div>
              <div class="row"><div class="col-4 text-secondary">Date facturation : </div><div class="col fw-bold"><?php echo $date_bill; ?></div></div>
              <div class="row"><div class="col-4 text-secondary">Facture n° </div><div class="col fw-bold"><?php echo $order['bill_no']; ?></div></div>
              <div class="row"><div class="col-4 text-secondary">Status </div><div class="col fw-bold text-primary"><?php echo $status; ?></div></div>
            </div>
            <div class="col-6">
              <div class="text-end text-nowrap">
                <button type="submit" name="pay" class="btn btn-warning me-1 fw-bold text-uppercase">Payer ma commande</button>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <h4 class="my-3 text-uppercase fs-5">Contenu de ma commande</h4>
            <table class="w-100 display responsive" id="tableOrderProducts">
              <thead>
                <tr>
                  <th>Univers</th>
                  <th>Titre</th>
                  <th>Auteur</th>
                  <th>Référence</th>
                  <th class="text-end">Qté</th>
                  <th class="text-end">PUHT</th>
                  <th class="text-end">PTHT</th>
                  <th class="text-end">TVA</th>
                  <th class="text-end">PTTC</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $totalQty  = 0;
                  $totalPtht = 0;
                  $totalTva  = 0;
                  $totalPttc = 0;
                  foreach ( $products as $product ) { 
                    $totalQty += $product['quantity'];
                    $puht = number_format( $product['price'] / (1 + $product['tva']), 2, ',', ' ' ) . " €";
                    $ptht = number_format( $product['quantity'] * $product['price'] / (1 + $product['tva']), 2, ',', ' ' ) . " €";
                    $totalPtht += $ptht;
                    $tva = number_format( $product['quantity'] * $puht * $product['tva'], 2, ',', ' ' ) . " €";
                    $totalTva += $tva;
                    $pttc = number_format( $product['quantity'] * $product['price'], 2, ',', ' ' ) . " €";
                    $totalPttc += $pttc;
                ?>
                  <tr>
                    <td><?php echo $product['universe']; ?></td>
                    <td class="fw-bold"><?php echo $product['title']; ?></td>
                    <td><?php echo $product['maker']; ?></td>
                    <td><?php echo $product['reference']; ?></td>
                    <td class="text-end"><?php echo $product['quantity']; ?></td>
                    <td class="text-end"><?php echo $puht; ?></td>
                    <td class="text-end"><?php echo $ptht; ?></td>
                    <td class="text-end"><?php echo $tva; ?></td>
                    <td class="text-end"><?php echo $pttc; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <td class="fw-bold text-end"><?php echo $totalQty; ?></td>
                  <td></td>
                  <td class="fw-bold text-end"><?php echo number_format( $totalPtht, 2, ',', ' ' ) . " €"; ?></td>
                  <td class="fw-bold text-end"><?php echo number_format( $totalTva, 2, ',', ' ' ) . " €"; ?></td>
                  <td class="fw-bold text-end"><?php echo number_format( $totalPttc, 2, ',', ' ' ) . " €"; ?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </form>
      </div>
    </div>
<?php
  }
  
  
  /**
   * @function genCustomerOrders()
   * @summary  Function to generate customer orders page
   */
  public static function genOrders( $config, $orders ) {
    var_dump($orders);
?>
    <div class="container-fluid py-4">
      <div class="container">
        <h3 class="text-uppercase">Mes commandes</h3>
        <div class="row mt-4">
          <table class="w-100 display responsive" id="tableOrders">
            <thead>
              <tr>
                <th>Date Commande</th>
                <th>N° Commande</th>
                <th>Date Facture</th>
                <th>N° Facture</th>
                <th>Date Paiement</th>
                <th>Status</th>
                <th class="text-end">Nb Produits</th>
                <th class="text-end">Montant HT</th>
                <th class="text-end">TVA</th>
                <th class="text-end">Montant TTC</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                foreach ( $orders as $order ) { 
              ?>
                <tr>
                  <td><?php echo $order['date_order']; ?></td>
                  <td class="fw-bold"><?php echo $order['order_no']; ?></td>
                  <td><?php echo $order['date_bill']; ?></td>
                  <td><?php echo $order['bill_no']; ?></td>
                  <td class="text-end"><?php echo $order['date_paid']; ?></td>
                  <td class="text-end"><?php echo $order['status']; ?></td>
                  <td class="text-end"><?php echo $order['qty']; ?></td>
                  <td class="text-end"><?php echo $order['totalHT']; ?></td>
                  <td class="text-end"><?php echo $order['totalTTC'] - $order['totalHT']; ?></td>
                  <td class="text-end"><?php echo $order['totalTTC']; ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
<?php
  }
   
  
  /**
   * @function genOrderSheet()
   * @summary  Function to generate an order page
   */
  public static function genOrderSheet( $config, $order, $products ) {
    $date = new DateTime( $order['date_order'] );
    $date_order = $date->format('D d F Y') . ' à ' . $date->format('H:i:s');
    $date = new DateTime( $order['date_bill'] );
    $date_bill = $date->format('D d F Y') . ' à ' . $date->format('H:i:s');
    $status = $config['statusList'][$order['status']];
?>
    <div class="container-fluid py-4">
      <div class="container">
        <h3 class="text-uppercase">Ma commande</h3>
        <div class="mt-4 mb-4 p-4 border border-success rounded">
          <div class="row">
            <div class="col-6">
              <div class="row"><div class="col-4 text-secondary">Date commande : </div><div class="col fw-bold"><?php echo $date_order; ?></div></div>
              <div class="row"><div class="col-4 text-secondary">Commande n° </div><div class="col fw-bold"><?php echo $order['order_no']; ?></div></div>
              <div class="row"><div class="col-4 text-secondary">Date facturation : </div><div class="col fw-bold"><?php echo $date_bill; ?></div></div>
              <div class="row"><div class="col-4 text-secondary">Facture n° </div><div class="col fw-bold"><?php echo $order['bill_no']; ?></div></div>
              <div class="row"><div class="col-4 text-secondary">Status </div><div class="col fw-bold text-primary"><?php echo $status; ?></div></div>
            </div>
            <div class="col-6">
              <div class="text-end text-nowrap">
                <a href="bill.php?id=<?php echo $order['id']; ?>" class="btn btn-warning me-1 fw-bold text-uppercase">Editer ma Facture</a>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <h4 class="my-3 text-uppercase fs-5">Contenu de ma commande</h4>
            <table class="w-100 display responsive" id="tableOrderProducts">
              <thead>
                <tr>
                  <th>Univers</th>
                  <th>Titre</th>
                  <th>Auteur</th>
                  <th>Référence</th>
                  <th class="text-end">Qté</th>
                  <th class="text-end">PUHT</th>
                  <th class="text-end">PTHT</th>
                  <th class="text-end">TVA</th>
                  <th class="text-end">PTTC</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $totalQty  = 0;
                  $totalPtht = 0;
                  $totalTva  = 0;
                  $totalPttc = 0;
                  foreach ( $products as $product ) { 
                    $totalQty += $product['quantity'];
                    $puht = number_format( $product['price'] / (1 + $product['tva']), 2, ',', ' ' ) . " €";
                    $ptht = number_format( $product['quantity'] * $product['price'] / (1 + $product['tva']), 2, ',', ' ' ) . " €";
                    $totalPtht += $ptht;
                    $tva = number_format( $product['quantity'] * $puht * $product['tva'], 2, ',', ' ' ) . " €";
                    $totalTva += $tva;
                    $pttc = number_format( $product['quantity'] * $product['price'], 2, ',', ' ' ) . " €";
                    $totalPttc += $pttc;
                ?>
                  <tr>
                    <td><?php echo $product['universe']; ?></td>
                    <td class="fw-bold"><?php echo $product['title']; ?></td>
                    <td><?php echo $product['maker']; ?></td>
                    <td><?php echo $product['reference']; ?></td>
                    <td class="text-end"><?php echo $product['quantity']; ?></td>
                    <td class="text-end"><?php echo $puht; ?></td>
                    <td class="text-end"><?php echo $ptht; ?></td>
                    <td class="text-end"><?php echo $tva; ?></td>
                    <td class="text-end"><?php echo $pttc; ?></td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="4"></td>
                  <td class="fw-bold text-end"><?php echo $totalQty; ?></td>
                  <td></td>
                  <td class="fw-bold text-end"><?php echo number_format( $totalPtht, 2, ',', ' ' ) . " €"; ?></td>
                  <td class="fw-bold text-end"><?php echo number_format( $totalTva, 2, ',', ' ' ) . " €"; ?></td>
                  <td class="fw-bold text-end"><?php echo number_format( $totalPttc, 2, ',', ' ' ) . " €"; ?></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
<?php
  }

}