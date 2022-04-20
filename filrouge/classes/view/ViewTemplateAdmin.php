<?php
class ViewTemplateAdmin {

  public static function genHead($pageTitle) {
?>
    <!DOCTYPE HTML>  
    <html>
    <head>
      <title><?php echo $pageTitle; ?></title>
      <!-- 3rd Party stylesheets -->
      <link rel="stylesheet" href="../../../../3rdparty/font-awesome/fa-6.1.0.all.min.css" />
      <link rel="stylesheet" href="../../../../3rdparty/bootstrap/bootstrap-5.1.3.min.css" />
      <link rel="stylesheet" href="../../../../3rdparty/jquery/datatables/jquery.dataTables.complete-1.11.5.min.css"></link>
      <link rel="stylesheet" href="../../../../3rdparty/jquery/datatables/jquery.dataTables.responsive.min.css"></link>
      <!-- Custom Styles stylesheet -->
      <link rel="stylesheet" href="../../../../css/admin/admin.css" />
    </head>
    <body>

<?php
  }

  public static function genHeader($pageTitle, $navPage) {
    $listAriaCurrent = $navPage === 'list' ? ' aria-current="page"' : '';
    $addAriaCurrent = $navPage === 'add' ? ' aria-current="page"' : '';
?>
    <!-- ──────────────────────────────────────────────────────────────── -->
    <!--                        HEADER                            -->
    <!-- ──────────────────────────────────────────────────────────────── -->
    <header class="container-fluid px-4 w-100 kltr-bg-toolbar-light kltr-text-toolbar-dark">
      <nav class="navbar navbar-light">
      <!-- <nav class="navbar navbar-expand-lg navbar-light"> -->
        <div class="col d-flex">
          <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="border rounded-3 p-1 text-decoration-none"><i class="fa-solid fa-bars fs-2"></i></a>
          <h1 class="fw-bold text-uppercase"><?php echo $pageTitle; ?></h1>
        </div>
        <div class="col-2">
          <div class="collapse navbar-collapse">
            <ul class="navbar-nav w-100 pe-0 text-end">
              <li class="nav-item ms-2">
                <a class="btn btn-primary text-uppercase"<?php echo $listAriaCurrent; ?> href="#"><i class="fa-solid fa-list me-2"></i>List</a>
              </li>
              <li class="nav-item ms-2">
                <a class="btn btn-success text-uppercase"<?php echo $addAriaCurrent; ?> href="add.php"><i class="fa-solid fa-plus me-2"></i>Créer</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-1 pe-4 text-end text-nowrap">
          <!-- Light/Dark Mode Switcher -->
          <a href="#" class="ms-3 text-decoration-none" id="lightDarkSwitcher">
            <i class="fa-solid fa-moon fs-3" id="lightDarkIcon"></i>
          </a>
          <!-- Settings button -->
          <a href="#" class="ms-3 text-decoration-none" id="btnSettings">
            <i class="fa-solid fa-gear fs-3"></i>
          </a>
        </div>
      </nav>
    </header>

<?php
  }


  public static function getMenu() {
    return 
    [
      [ "type" => "sep",  "link" => "",                       "label" => "Tableau de bord", "icon" => "fa-solid fa-chart-area" ],
      [ "type" => "link", "link" => "dashboard/admin.php",    "label" => "Administration",  "icon" => "fa-solid fa-person-dots-from-line" ],
      [ "type" => "link", "link" => "dashboard/sales.php",    "label" => "Commercial",      "icon" => "fa-solid fa-handshake-simple" ],
      [ "type" => "link", "link" => "dashboard/support.php",  "label" => "Support",         "icon" => "fa-solid fa-headset" ],
      [ "type" => "link", "link" => "dashboard/stocks.php",   "label" => "Magasin",         "icon" => "fa-solid fa-cubes-stacked" ],

      [ "type" => "sep",  "link" => "",                   "label" => "Activité",        "icon" => "fa-solid fa-wave-square" ],
      [ "type" => "link", "link" => "customer/list.php",  "label" => "Clients",         "icon" => "fa-solid fa-person-breastfeeding" ],
      [ "type" => "link", "link" => "orders/list.php",    "label" => "Commandes",       "icon" => "fa-solid fa-file-invoice" ],
      [ "type" => "link", "link" => "product/list.php",   "label" => "Produits",        "icon" => "fa-solid fa-cubes" ],

      [ "type" => "sep",  "link" => "",                   "label" => "Listes",          "icon" => "fa-solid fa-rectangle-list" ],
      [ "type" => "link", "link" => "universe/list.php",  "label" => "Univers",         "icon" => "fa-solid fa-warehouse" ],
      [ "type" => "link", "link" => "category/list.php",  "label" => "Catégories",      "icon" => "fa-solid fa-rectangle-list" ],
      [ "type" => "link", "link" => "brand/list.php",     "label" => "Marques",         "icon" => "fa-solid fa-city" ],
      [ "type" => "link", "link" => "carrier/list.php",   "label" => "Transporteurs",   "icon" => "fa-solid fa-truck-fast" ],

      [ "type" => "sep",  "link" => "",                   "label" => "Administration",  "icon" => "fa-solid fa-person-military-pointing" ],
      [ "type" => "link", "link" => "role/list.php",      "label" => "Rôles",           "icon" => "fa-solid fa-shield-halved" ],
      [ "type" => "link", "link" => "user/list.php",      "label" => "Utilisateurs",    "icon" => "fa-solid fa-user-shield" ],
      [ "type" => "link", "link" => "settings.php",       "label" => "Settings",        "icon" => "fa-solid fa-gear" ],
    ];
  }


  public static function genSidebar($pageTitle) {
    $menuList = ViewTemplateAdmin::getMenu();
?>
    <div class="col-auto p-0 pt-2 kltr-bg-toolbar-light kltr-text-toolbar-dark">
        <div class="collapse collapse-horizontal show border-end">
          <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
            <div class="sidebar-header">
              <!-- Logo & Brand -->
              <a href="#" class="d-block mb-4 text-center text-decoration-none">
                <img class="d-block mx-auto logo" height="32" src="images/myStocks-logo.svg" alt="myStocks brand logo" />
                <div class="d-none d-md-block fs-5 fw-bold company">KULTUR.com</div>
              </a>
              <!-- User -->
              <div class="mt-4 mb-3 text-center user">
                <img src="images/avatar_0_thumb.png" alt="jean LOUIS magasinier" height="64" class="avatar">
                <div class="mt-1 nom">Jean LOUIS</div>
                <div class="d-none d-md-block text-uppercase fonction">Magasinier</div>
              </div>
            </div>
            <!-- Side Menu -->
            <div class="">
              <ul class="nav nav-pills flex-column mb-auto">
                <?php foreach($menuList as $item) { ?>
                  <?php if($item['type'] === 'sep') { ?>
                    <li class="nav-item">
                      <h4 class="nav-link mx-3 px-0 pt-3 pb-0 border-bottom border-secondary" title="<?php echo $item['label'] ?>">
                        <i class="<?php echo $item['icon'] ?> me-1 fs-5"></i><span class="d-none d-md-block d-lg-inline text-nowrap fw-bold fs-5"><?php echo $item['label'] ?></span>
                      </h4>
                    </li>
                  <?php } else if ($item['type'] === 'link') { ?>
                    <li class="nav-item ms-2 d-flex justify-content-between align-items-center py-0 px-3">
                      <div class="col-1 fs-5"><i class="<?php echo $item['icon'] ?>"></i></div>
                      <a href="<?php echo $item['link'] ?>" class="nav-link col-10" title="<?php echo $item['label'] ?>">
                        <span class="d-none d-md-block d-lg-inline text-nowrap"><?php echo $item['label'] ?></span>
                      </a>
                      <small class="col-1"><i class="fa-solid fa-lock ms-auto me-0"></i></small>
                    </li>
                  <?php } ?>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
    </div>
<?php
  }


  public static function genFooter() {
?>
    <footer class="container-fluid p-0 w-100">
      <!-- Copyright -->
      <div class="ml-md-4 mr-md-5 my-5 text-center copyright">Copyright © 2022 Emmanuel FRANCOIS. Tous droits réservés.</div>
    </footer>

    <!-- 3rd Party scripts -->
    <script src="../../../../3rdparty/jquery/jquery-3.6.0.min.js"></script>
    <script src="../../../../3rdparty/jquery/datatables/jquery.dataTables.complete-1.11.5.min.js"></script>
    <script src="../../../../3rdparty/jquery/datatables/jquery.dataTables.responsive.min.js"></script>
    <script src="../../../../3rdparty/jquery/datatables/ellipsis.js"></script>
    <script src="../../../../3rdparty/font-awesome/fa-6.1.0.all.min.js"></script>
    <script src="../../../../3rdparty/bootstrap/bootstrap-5.1.3.bundle.min.js"></script>
    <script src="../../../../3rdparty/bootstrap/light-switch-0.1.3.js"></script>
    <!-- Custom scripts -->
    <!-- Dark mode switch -->
    <script src="../../../../js/common/theme-switcher.js"></script>
    <script src="../../../../js/admin/category.js"></script>
    <script src="../../../../js/admin/admin.js"></script>

  </body>
  </html>
<?php

  }
}

?>




