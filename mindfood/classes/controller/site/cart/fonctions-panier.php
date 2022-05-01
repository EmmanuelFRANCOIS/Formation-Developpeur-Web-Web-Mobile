<?php
session_start();

/**
 * Verifie si le panier existe, le crée sinon
 * @return booleen
 */
function creationPanier () {
  if ( !isset($_SESSION['panier']) ) {
    $_SESSION['panier']                   = array();
    $_SESSION['panier']['idProduit']      = array();
    $_SESSION['panier']['libelleProduit'] = array();
    $_SESSION['panier']['auteurProduit']  = array();
    $_SESSION['panier']['qteProduit']     = array();
    $_SESSION['panier']['prixProduit']    = array();
    $_SESSION['panier']['verrou']         = false;
  }
  return true;
}


/**
 * Ajoute un article dans le panier
 * @param string $libelleProduit
 * @param int $qteProduit
 * @param float $prixProduit
 * @return void
 */
function ajouterArticle( $idProduit, $libelleProduit, $auteurProduit, $qteProduit, $prixProduit ) {
  //Si le panier existe
  if ( creationPanier() && !isVerrouille() ) {
    //Si le produit existe déjà on ajoute seulement la quantité
    $positionProduit = array_search( $libelleProduit,  $_SESSION['panier']['libelleProduit'] );
    if ( $positionProduit !== false ) {
      $_SESSION['panier']['qteProduit'][$positionProduit] += $qteProduit ;
    } else {
      //Sinon on ajoute le produit
      array_push( $_SESSION['panier']['idProduit'],      $idProduit      );
      array_push( $_SESSION['panier']['libelleProduit'], $libelleProduit );
      array_push( $_SESSION['panier']['auteurProduit'],  $auteurProduit  );
      array_push( $_SESSION['panier']['qteProduit'],     $qteProduit     );
      array_push( $_SESSION['panier']['prixProduit'],    $prixProduit    );
    }
  } else {
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
  }
}



/**
 * Modifie la quantité d'un article
 * @param $libelleProduit
 * @param $qteProduit
 * @return void
 */
function modifierQTeArticle( $libelleProduit, $qteProduit ) {
  //Si le panier existe
  if ( creationPanier() && !isVerrouille() ) {
    //Si la quantité est positive on modifie sinon on supprime l'article
    if ( $qteProduit > 0 ) {
      //Recharche du produit dans le panier
      $positionProduit = array_search( $libelleProduit,  $_SESSION['panier']['libelleProduit'] );
      if ( $positionProduit !== false ) {
        $_SESSION['panier']['qteProduit'][$positionProduit] = $qteProduit ;
      }
    } else {
      supprimerArticle($libelleProduit);
    }
  } else {
    echo "Un problème est survenu veuillez contacter l'administrateur du site.";
  }
}

/**
 * Supprime un article du panier
 * @param $libelleProduit
 * @return unknown_type
 */
function supprimerArticle( $libelleProduit ) {
  //Si le panier existe
  if ( creationPanier() && !isVerrouille() ) {
    //Nous allons passer par un panier temporaire
    $tmp                    = array();
    $tmp['idProduit']       = array();
    $tmp['libelleProduit']  = array();
    $tmp['qteProduit']      = array();
    $tmp['prixProduit']     = array();
    $tmp['verrou']          = $_SESSION['panier']['verrou'];
    for ( $i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++ ) {
        if ( $_SESSION['panier']['libelleProduit'][$i] !== $libelleProduit ) {
          array_push( $tmp['idProduit'],      $_SESSION['panier']['idProduit'][$i]);
          array_push( $tmp['libelleProduit'], $_SESSION['panier']['libelleProduit'][$i]);
          array_push( $tmp['qteProduit'],     $_SESSION['panier']['qteProduit'][$i]);
          array_push( $tmp['prixProduit'],    $_SESSION['panier']['prixProduit'][$i]);
        }
    }
    //On remplace le panier en session par notre panier temporaire à jour
    $_SESSION['panier'] =  $tmp;
    //On efface notre panier temporaire
    unset($tmp);
  } else {
  echo "Un problème est survenu veuillez contacter l'administrateur du site.";
  }
}


/**
 * Montant total du panier
 * @return int
 */
function MontantGlobal () {
  $total=0;
  for($i = 0; $i < count($_SESSION['panier']['libelleProduit']); $i++) {
    $total += $_SESSION['panier']['qteProduit'][$i] * $_SESSION['panier']['prixProduit'][$i];
  }
  return $total;
}


/**
 * Fonction de suppression du panier
 * @return void
 */
function supprimePanier () {
  unset( $_SESSION['panier'] );
}

/**
 * Permet de savoir si le panier est verrouillé
 * @return boolean
 */
function isVerrouille () {
  if (isset($_SESSION['panier']) && $_SESSION['panier']['verrou']) {
    return true;
  } else {
    return false;
  }
}

/**
 * Compte le nombre d'articles différents dans le panier
 * @return int
 */
function compterArticles() {
  if ( isset($_SESSION['panier']) ) {
    return count($_SESSION['panier']['idProduit']);
  } else {
    return 0;
  }
}


/**
 * Compte le nombre d'articles différents dans le panier
 * @return int
 */
function passerCommande( $config ) {

  if ( isset( $_SESSION['panier'] ) && isset( $_SESSION['site']['id'] ) ) {

    $date = new DateTime();
    $timestamp = $date->getTimestamp();
    $dateOrder = date("Y-m-d H:i:s");
    $customer_id = $_SESSION['site']['id'];
    $order = [
      'customer_id'      => $customer_id, 
      'date_order'       => $dateOrder, 
      'order_no'         => "ORDER-" . $customer_id . "-" . $timestamp, 
      'date_bill'        => $dateOrder, 
      'bill_no'          => "BILL-" . $customer_id . "-" . ($timestamp + 60), 
      'date_paid'        => null, 
      'date_sent'        => null, 
      'delivery_no'      => null, 
      'date_delivered'   => null, 
      'date_returned'    => null, 
      'date_cancelled'   => null, 
      'status'           => 'saved', 
      'delivery_point'   => 'home', 
      'delivery_address' => null, 
      'carrier_id'       => null
    ];
    $modelOrders = new ModelOrders();
    $order_id = $modelOrders->createOrderFromCart( $order );
    $result = $modelOrders->createOrderProductsFromCart( $config, $order_id, $_SESSION['panier'] );

    $backToPage = $_SESSION['panier']['backToPage'];
    if ( $result > 0 ) {
      supprimePanier ();
    }
    if ( isset($backToPage) ) {
      header( "Location: ../orders/validate.php?id=" . $order_id );
    }

  } else {
    return false;
  }

}


/**
 * Generate the Cart html code
 * @return html
 */
function genCart() {
  $connected = false;
  if ( isset( $_SESSION['site']['id'] ) ) {
    $connected = true;
  }
?>
  <div class="container-fluid">
    <div class="container">
      <?php
      if ( creationPanier() ) {
        $nbArticles=count($_SESSION['panier']['libelleProduit']);
        if ( $nbArticles <= 0 ) {
      ?>
          <h3 class="mt-5 text-center">Votre panier est vide </h3>
      <?php } else { ?>
          <form method="POST" action="panier.php">
            <div class="d-flex my-5 justify-content-between align-items-center">
              <h2 class="fw-bold text-uppercase">Votre panier</h2>
              <div class="text-end">
              <?php if ( $nbArticles > 0 ) { ?>
                <a href="<?php echo htmlspecialchars('panier.php?action=commander'); ?>" 
                        class="btn btn-warning fs-5 fw-bold text-uppercase<?php if ( !$connected ) echo ' disabled'; ?>" 
                        <?php if ( !$connected ) echo ' disabled'; ?>>Passer Commande</a>
                <?php if ( !$connected ) { ?><div class="text-danger small">(connexion requise)</div><?php } ?>
              <?php } ?>
              </div>
            </div>
            <table id="tableCart" class="w-100 display responsive">
              <thead>
                <tr class="text-center">
                  <th scope="col">Id</th>
                  <th scope="col">Titre</th>
                  <th scope="col">Auteur</th>
                  <th class="text-center" scope="col">Quantité</th>
                  <th class="text-end" scope="col">Prix Unitaire</th>
                  <th class="text-end" scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                <?php for ( $i=0; $i < $nbArticles; $i++ ) { ?>
                  <tr>
                    <td class="text-center"><?php echo htmlspecialchars($_SESSION['panier']['idProduit'][$i]); ?></td>
                    <td class="fw-bold text-success"><?php echo htmlspecialchars($_SESSION['panier']['libelleProduit'][$i]); ?></td>
                    <td><?php echo htmlspecialchars($_SESSION['panier']['auteurProduit'][$i]); ?></td>
                    <td class="text-center"><input type="text" size="4" name="q[]" value="<?php echo htmlspecialchars($_SESSION['panier']['qteProduit'][$i]); ?>"></td>
                    <td class="text-end"><?php echo htmlspecialchars($_SESSION['panier']['prixProduit'][$i]); ?> €</td>
                    <td class="text-end">
                      <a href="<?php echo htmlspecialchars('panier.php?action=suppression&l='.rawurlencode($_SESSION['panier']['libelleProduit'][$i])); ?>">
                        <i class="fa-solid fa-trash-can fs-5 text-danger"></i>
                      </a>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
              <tfoot class="bg-light">
                <tr>
                  <td colspan="3">
                  <a class="btn btn-dark fw-bold text-uppercase" href="javascript:history.back()">Continuer mes achats</a>
                  </td>
                  <td class="text-center">
                    <?php if ( $nbArticles > 0 ) { ?>
                      <input type="submit" class="btn btn-secondary fw-bold text-uppercase" value="Recalculer">
                    <?php } ?>
                  </td>
                  <td class="fw-bold text-dark text-uppercase text-end">Total : <?php echo MontantGlobal(); ?> €</td>
                  <td class="text-end">
                    <?php if ( $nbArticles > 0 ) { ?>
                      <a class="btn btn-danger fw-bold text-uppercase" href="<?php echo htmlspecialchars('panier.php?action=vider'); ?>">Vider le panier</a>
                    <?php } ?>
                  </td>
                </tr>
                <input type="hidden" name="action" value="refresh">
              </tfoot>
            </table>
          </form>
      <?php
        }
      }
      ?>
    </div>
  </div>
<?php
}
?>
