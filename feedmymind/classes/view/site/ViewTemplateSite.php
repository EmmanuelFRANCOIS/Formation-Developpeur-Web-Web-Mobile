<?php

/**
 * @class   ViewTemplateSite
 * @summary Class for View templating for Site side
 */
class ViewTemplateSite {

  
  /**
   * @function genHead()
   * @summary  Function to generate Site page head
   * @param    $config => Config parameters object
   * @param    $pageTitle => Page title
   */
  public static function genHead( $config, $pageTitle ) {
?>
    <!DOCTYPE HTML>  
    <html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $pageTitle . ' - ' . $config['companyName']; ?></title>
      <!-- 3rd Party stylesheets -->
      <link rel="stylesheet" href="../../../../3rdparty/font-awesome/fa-6.1.0.all.min.css" />
      <link rel="stylesheet" href="../../../../3rdparty/bootstrap/bootstrap-5.1.3.min.css" />
      <link rel="stylesheet" href="../../../../3rdparty/jquery/datatables/jquery.dataTables.complete-1.11.5.min.css"></link>
      <link rel="stylesheet" href="../../../../3rdparty/jquery/datatables/jquery.dataTables.responsive.min.css"></link>
      <!-- Custom Styles stylesheet -->
      <link rel="stylesheet" href="../../../../css/site/site.css" />
      <style>
        .errorInput { border: 2px solid red !important; }
        .errorMessage { color: red !important; }
      </style>
    </head>
    <body>
<?php
  }


  /**
   * @function genHeader()
   * @summary  Function to generate Site page header
   * @param    $config => Config parameters object
   * @param    $pageTitle => Page title
   */
  public static function genHeader( $config, $pageTitle ) {
    $connected = false;
    if ( isset( $_SESSION['site']['id'] ) ) {
      $connected = true;
    }
?>
    <header class="container-fluid">
      <div class="container d-flex justify-content-between align-items-center py-2">
        <a class="d-flex align-items-center text-dark text-decoration-none" href="<?php echo $config['siteUrl']; ?>">
          <img src="../../../../images/logos/brainfood.svg" height="64" alt="<?php echo $config['siteName']; ?>">
          <h4 class="ms-2 me-auto fs-1 fw-bold text-uppercase"><?php echo $config['companyName']; ?></h4>
        </a>
        <div class="mx-auto fs-5 text-center fst-italic text-secondary">« L'homme sans culture est un arbre sans fruit. » (Rivarol)</div>
        <!-- Customer login & menu -->
        <?php if ( !$connected ) { ?>
          <div class="me-0 text-center">
            <a href="../customer/login.php" class="btn py-1 text-center text-dark" title="Connexion" id="customerLogin">
              <i class="d-block mx-auto fa-solid fa-user-large fs-2"></i>
              <div class="mt-1 lh-1 text-center small">Connexion</div>
            </a>
          </div>
        <?php } else if ( $connected ) { ?>
          <div class="me-0 dropdown text-center">
            <!-- Customer Account Connected Button -->
            <a class="btn text-success" type="button" id="customerMenu" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="d-block mx-auto fa-solid fa-user-lock fs-2"></i>
              <div class="mt-1 lh-1 text-center small text-dark"><?php echo isset($_SESSION['site']['id']) ? 'Bonjour<br />' . $_SESSION['site']['firstname'] : ''; ?></div>
            </a>
            <!-- Account dropdown -->
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="customerMenu">
              <!-- <li><a class="dropdown-item" href="../customer/account.php">Mon compte</a></li> -->
              <li><a class="dropdown-item" href="../orders/list.php">Mes commandes</a></li>
              <!-- <li><a class="dropdown-item" href="../favorite/list.php">Mes favoris</a></li> -->
              <li><a class="dropdown-item" href="../customer/profile.php">Mon profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="../customer/logout.php">Déconnexion</a></li>
            </ul>
          </div>
        <?php } ?>
          <!-- Cart button -->
          <div class="me-0 text-center">
            <a href="../../../controller/site/cart/panier.php" type="button" class="btn py-1 text-center text-dark" title="Mon panier">
              <i class="d-block mx-auto fa-solid fa-cart-shopping fs-2"></i>
              <div class="mt-1 lh-1 text-center small">
                <div>Panier</div>
                <!-- <div id="cartContent">vide</div> -->
              </div>
            </a>
            <!-- Offcanvas Cart -->
            <!-- <button type="button" class="btn py-1 text-center text-dark" 
                    title="Mon panier" 
                    data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvasRight" aria-controls="cartOffcanvasRight">
              <i class="d-block mx-auto fa-solid fa-cart-shopping fs-2">5</i>
              <div class="mt-1 lh-1 text-center small">
                <div>Panier</div>
                <div id="cartContent">vide</div>
              </div>
            </button> -->
            <!-- Cart Offcanvas -->
            <!-- <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvasRight" aria-labelledby="cartOffcanvasRightLabel">
              <div class="offcanvas-header">
                <h5 id="cartOffcanvasRightLabel">Mon panier</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                ...
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </header>

<?php
  }


  /**
   * @function genNavBar()
   * @summary  Function to generate Site page navbar
   * @param    $config => Config parameters object
   */
  public static function genNavBar( $config ) {
?>

    <nav class="navbar navbar-expand-lg navbar-light kltr-bg-toolbar-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-between align-items-center fw-bold fs-5 text-uppercase">
            <li class="nav-item">
              <a class="btn btn-primary text-white fw-bold fs-5" aria-current="page" href="../home/index.php">Nouveautés</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../universe/show.php?id=1">Livres</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../universe/show.php?id=2">Musique</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../universe/show.php?id=3">Films</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../universe/show.php?id=4">Documentaires</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-success fw-bold fs-5" href="#">Bons plans</a>
            </li>
            <li class="nav-item">
              <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
              </form>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<?php
  }

  
  /**
   * @function genFooter()
   * @summary  Function to generate Site page footer
   * @param    $config => Config parameters object
   * @param    $scripts => List of js scripts to include
   */
  public static function genFooter( $config, $scripts = [] ) {
?>
    <footer class="container-fluid px-3">
      <!-- Copyright -->
      <div class="ml-md-4 mr-md-5 my-5 text-center copyright">
        Copyright © 2022 <a href="<?php echo $config['siteUrl']; ?>"><?php echo $config['siteName']; ?></a>. Tous droits réservés.
      </div>
    </footer>

    <script src="../../../../3rdparty/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../../../3rdparty/jquery/datatables/jquery.dataTables.complete-1.11.5.min.js"></script>
    <script src="../../../../3rdparty/jquery/datatables/jquery.dataTables.responsive.min.js"></script>
    <script src="../../../../3rdparty/font-awesome/fa-6.1.0.all.min.js"></script>
    <script src="../../../../3rdparty/bootstrap/bootstrap-5.1.3.bundle.min.js"></script>
    <?php if ( in_array('validationForm', $scripts) ) { ?>
      <script src="../../../../js/common/validationForm.js"></script>
    <?php } ?>
    <!-- Main scripts -->
    <script src="../../../../js/site/site.js"></script>

  </body>
  </html>
<?php

  }


  /**
   * @function genRatingStars()
   * @summary  Function to generate Rating stars html code
   * @param    ratingValue => Rating value (from 0 to 5)
   * @param    ratingNum   => Number of rates
   * @return   html code
   */
  public static function genRatingStars( $ratingValue ) {
    $html = "<span class='stars'>";
    for ( $i = 1; $i <= 5; $i++ ) {
        if ( round( $ratingValue - .25 ) >= $i ) {
          $html .= '<i class="fa-solid fa-star"></i>'; //fas fa-star for v5
        } elseif ( round( $ratingValue + .25 ) >= $i ) {
          $html .= '<i class="fa-solid fa-star-half-stroke"></i>'; //fas fa-star-half-alt for v5
        } else {
          $html .= '<i class="fa-regular fa-star"></i>'; //far fa-star for v5
        }
    }
    $html .= "</span>";
    return $html;
  }


}

?>




