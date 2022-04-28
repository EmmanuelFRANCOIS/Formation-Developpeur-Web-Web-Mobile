<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";


ViewTemplateSite::genHead( $config, 'Accueil' );
ViewTemplateSite::genHeader( $config, '' );
ViewTemplateSite::genNavBar( $config );
ViewTemplateSite::genFooter( $config );

?>
