<?php
class ViewTemplateSite {

  public static function genHead($pageTitle) {
?>
    <!DOCTYPE HTML>  
    <html>
    <head>
      <title><?php echo $pageTitle; ?></title>
      <!-- Font-Awesome 6.1.0 stylesheet -->
      <!-- <link rel="stylesheet" href="../../3rdparty/font-awesome/fa-6.1.0.all.min.css" /> -->
      <!-- Bootstrap 5.1.3 stylesheet -->
      <link rel="stylesheet" href="../../3rdparty/bootstrap/bootstrap-5.1.3.min.css" />
      <!-- Custom Styles stylesheet -->
      <link rel="stylesheet" href="../../css/style.css" />
    </head>
    <body>

<?php
  }

  public static function genHeader($pageTitle) {
?>
    <header class="container-fluid">
      <h1 class="fw-bold text-center text-uppercase"><?php echo $pageTitle; ?></h1>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"><?php echo $pageTitle; ?></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">List</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="add.php">Add</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

<?php
  }

  public static function genFooter() {
?>
    <footer class="container-fluid px-3">
      <!-- Copyright -->
      <div class="ml-md-4 mr-md-5 my-5 text-center copyright">Copyright © 2022 Emmanuel FRANCOIS. Tous droits réservés.</div>
    </footer>

    <!-- <script src="../../3rdparty/jquery/jquery-3.6.0.min.js"></script> -->
    <!-- Font-Awesome 6.1.0 scripts -->
    <!-- <script src="../../3rdparty/font-awesome/fa-6.1.0.all.min.js"></script> -->
    <!-- Bootstrap 5.1.3 scripts -->
    <script src="../../3rdparty/bootstrap/bootstrap-5.1.3.bundle.min.js"></script>
    <!-- Main scripts -->
    <script src="../../js/main.js"></script>

  </body>
  </html>
<?php

  }
}

?>




