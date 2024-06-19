<?php
ob_start();
date_default_timezone_set('Africa/Luanda');
$webroot = "C:xampp/htdocs";
define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT', $webroot.DS.'www.dadec_decoracao.com'.DS.'admin');
define('INCLUDES_PATH', SITE_ROOT.DS.'include');
require_once(INCLUDES_PATH.DS."Helper.php");
require_once(INCLUDES_PATH.DS."config.php");
require_once(INCLUDES_PATH.DS."database.php");
require_once(INCLUDES_PATH.DS."db_object.php");
require_once(INCLUDES_PATH.DS."Session.php");
require_once(INCLUDES_PATH.DS."Accounts.php");
require_once(INCLUDES_PATH.DS."Account_Details.php");
require_once(INCLUDES_PATH.DS."Booking.php");
require_once(INCLUDES_PATH.DS."Material.php");
require_once(INCLUDES_PATH.DS."Guest.php");
require_once(INCLUDES_PATH.DS."Categories.php");
require_once(INCLUDES_PATH.DS."Features.php");
require_once(INCLUDES_PATH.DS."EventWedding.php");
require_once(INCLUDES_PATH.DS."Gallery.php");
require_once(INCLUDES_PATH.DS."Users.php");
require_once(INCLUDES_PATH.DS."Events.php");
require_once(INCLUDES_PATH.DS."Liquidation.php");
require_once(INCLUDES_PATH.DS."Cliente.php");
require_once(INCLUDES_PATH.DS."Pagamento.php");
require_once(INCLUDES_PATH.DS."Pagamento1.php");
require_once(INCLUDES_PATH.DS."Funcionario.php");
?>