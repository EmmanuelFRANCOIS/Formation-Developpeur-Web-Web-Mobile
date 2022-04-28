<?php


/**
 * @class   ViewTemplateSite
 * @summary Class for View templating for Site side
 */
class ViewTemplateSite {

  
  public static function genHead( $config, $pageTitle ) {
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
      <style>
        .errorInput { border: 2px solid red !important; }
        .errorMessage { color: red !important; }
      </style>
    </head>
    <body>
<?php
  }

  public static function genHeader( $config, $pageTitle ) {
    $connected = false;
    if ( isset( $_SESSION['site']['id'] ) ) {
      $connected = true;
    }
?>
    <header class="container-fluid">
      <div class="container d-flex justify-content-between align-items-center">
        <a class="d-flex align-items-center text-dark text-decoration-none" href="<?php echo $config['siteUrl']; ?>">
          <img src="../../../../images/logos/brainfood.svg" height="48" alt="<?php echo $config['siteName']; ?>">
          <h4 class="ms-2 me-auto fs-3 text-uppercase"><?php echo $config['companyName']; ?></h4>
        </a>
        <h3 class="mx-auto fw-bold text-center text-uppercase"><?php echo $pageTitle; ?></h3>
        <!-- Customer login & menu -->
        <?php if ( !$connected ) { ?>
          <div class="mx-0 login">
            Connexion
            <a href="../customer/login.php" class="btn text-dark" title="Connexion" id="customerLogin">
              <i class="fa-solid fa-user-large fs-4"></i>
            </a>
          </div>
        <?php } else if ( $connected ) { ?>
          <div class="mx-0 dropdown customerMenu">
            <?php echo isset($_SESSION['site']['id']) ? 'Bonjour ' . $_SESSION['site']['firstname'] : ''; ?>
            <a class="btn dropdown-toggle text-success" type="button" id="customerMenu" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-user-lock fs-4"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="customerMenu">
              <li><a class="dropdown-item" href="../customer/account.php">Mon compte</a></li>
              <li><a class="dropdown-item" href="../orders/list.php">Mes commandes</a></li>
              <li><a class="dropdown-item" href="../favorite/list.php">Mes favoris</a></li>
              <li><a class="dropdown-item" href="../customer/profile.php">Mon profil</a></li>
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


  public static function genNavBar( $config ) {
?>

    <nav class="navbar navbar-expand-lg navbar-light kltr-bg-toolbar-light">
      <div class="container">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
          <a class="navbar-brand" href="#"><?php echo $config['companyName'] ?></a>
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled">Disabled</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
<?php
  }

  public static function genFooter( $config, $scripts = [] ) {
?>
    <footer class="container-fluid px-3">
      <!-- Copyright -->
      <div class="ml-md-4 mr-md-5 my-5 text-center copyright">
        Copyright © 2022 <a href="<?php echo $config['siteUrl']; ?>"><?php echo $config['siteName']; ?></a>. Tous droits réservés.
      </div>
    </footer>

    <script src="../../../../3rdparty/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../../../3rdparty/font-awesome/fa-6.1.0.all.min.js"></script>
    <script src="../../../../3rdparty/bootstrap/bootstrap-5.1.3.bundle.min.js"></script>
    <?php if ( in_array('validationForm', $scripts) ) { ?>
      <script src="../../../../js/common/validationForm.js"></script>
    <?php } ?>
    <!-- Main scripts -->
    <!-- <script src="../../js/site/main.js"></script> -->

  </body>
  </html>
<?php

  }


}

?>




