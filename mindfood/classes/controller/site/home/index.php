<?php
session_start();

require_once "../../../utils/config.php";
require_once "../../../view/site/ViewTemplateSite.php";
require_once "../../../view/site/ViewCustomerAuth.php";


ViewTemplateSite::genHead( 'Accueil Site', $config );
ViewTemplateSite::genHeader( 'Accueil Site', $config );
ViewTemplateSite::genFooter();

?>
