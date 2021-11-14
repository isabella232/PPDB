<?php
define("DS", "\\", false);
define("ROOT", dirname(__FILE__), false);
define("ROOT_DB", dirname(__FILE__).DS."libs".DS."db", false);
define("PDB_CONNECT", $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'], false);
define("PDB_SERVER_NAME", $_SERVER['SERVER_NAME'], false);
define("PDB_SERVER_PORT", $_SERVER['SERVER_PORT'], false);
?>