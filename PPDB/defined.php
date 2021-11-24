<?php
define("DS", "\\", false);
define("DS_FOWARD", "/", false);
define("ROOT", dirname(__FILE__).DS, false);
define("ROOT_DB", dirname(__FILE__).DS."db".DS, false);
define("ROOT_FOWARD", dirname(__FILE__).DS_FOWARD, false);
define("ROOT_DB_FOWARD", dirname(__FILE__).DS_FOWARD."db".DS_FOWARD, false);
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
define("FILE_INFO", ["created", "updated", "size", "type"], false);
?>
