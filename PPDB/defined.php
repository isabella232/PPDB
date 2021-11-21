<?php
define("DS", "\\", false);
define("ROOT", dirname(__FILE__).DS, false);
define("ROOT_DB", dirname(__FILE__).DS."libs".DS."db", false);
define("PPDB_CONNECT", $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'], false);
define("PPDB_SERVER_NAME", $_SERVER['SERVER_NAME'], false);
define("PPDB_SERVER_PORT", $_SERVER['SERVER_PORT'], false);
define("SESSION_USER", $_SESSION['username'], false);
define("JUSTIFY", "justify", false);
define("LEFT", "left", false);
define("CENTER", "center", false);
define("RIGHT", "right", false);
define("CAPITALIZE", "capitalize", false);
define("UPPERCASE", "uppercase", false);
define("LOWERCASE", "lowercase", false);
?>
