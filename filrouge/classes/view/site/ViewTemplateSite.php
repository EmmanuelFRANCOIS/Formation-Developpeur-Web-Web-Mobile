<?php
session_start();

/**
 * @class   ViewTemplateSite
 * @summary Class for View templating for Site side
 */
class ViewTemplateSite {


  public static function genHead( $pageTitle, $config ) {
?>
    <!DOCTYPE HTML>  
    <html>
    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?php echo $pageTitle . ' - ' . $config['siteName']; ?></title>
      <!-- 3rd Party stylesheets -->
      <link rel="stylesheet" href="../../../../3rdparty/font-awesome/fa-6.1.0.all.min.css" />
      <link rel="stylesheet" href="../../../../3rdparty/bootstrap/bootstrap-5.1.3.min.css" />
      <!-- Custom Styles stylesheet -->
      <link rel="stylesheet" href="../../../../css/site/site.css" />
    </head>
    <body>
<div></div>
<?php
  }

  public static function genHeader( $pageTitle, $config ) {
    $connected = false;
    if ( isset( $_SESSION['id'] ) ) {
      $connected = true;
    }
?>
    <header class="container-fluid">
      <div class="container d-flex justify-content-between align-items-center">
        <img src="../../../../images/logo/brainfood.svg" height="48" alt="<?php echo $config['siteName']; ?>">
        <h4 class="ms-2 me-auto fs-1 text-uppercase"><?php echo $config['siteName']; ?></h4>
        <h3 class="mx-auto fw-bold text-center text-uppercase"><?php echo $pageTitle; ?></h3>
        <!-- Customer login & menu -->
        <?php if ( !$connected ) { ?>
          <div class="ms-auto me-0 login">
            <a href="../customer/login.php" class="btn text-dark" title="Connexion" id="customerLogin">
              <i class="fa-solid fa-user-large fs-4"></i>
            </a>
          </div>
        <?php } else if ( $connected ) { ?>
          <div class="ms-auto me-0 dropdown customerMenu">
            <?php echo isset($_SESSION['id']) ? 'Bonjour ' . $_SESSION['firstname'] : ''; ?>
            <a class="btn text-primary dropdown-toggle text-success" type="button" id="customerMenu" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user-lock fs-4"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="customerMenu">
              <li><a class="dropdown-item" href="#">Mon compte</a></li>
              <li><a class="dropdown-item" href="#">Mes commandes</a></li>
              <li><a class="dropdown-item" href="#">Mes favoris</a></li>
              <li><a class="dropdown-item" href="../customer/sheet.php">Mon profil</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="../customer/logout.php">Déconnexion</a></li>
            </ul>
          </div>
        <?php } ?>
          </div>
      </div>
    </header>

<?php
  }

  public static function genFooter() {
?>
    <footer class="container-fluid px-3">
      <!-- Copyright -->
      <div class="ml-md-4 mr-md-5 my-5 text-center copyright">Copyright © 2022 Emmanuel FRANCOIS. Tous droits réservés.</div>
    </footer>

    <script src="../../../../3rdparty/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../../../3rdparty/font-awesome/fa-6.1.0.all.min.js"></script>
    <script src="../../../../3rdparty/bootstrap/bootstrap-5.1.3.bundle.min.js"></script>
    <!-- Main scripts -->
    <!-- <script src="../../js/site/main.js"></script> -->

  </body>
  </html>
<?php

  }
}

?>




