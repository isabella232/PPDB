<?php 
require('libs/pdb.lib.php');
 require('libs/pdb.sql.php');
 ?>
<html>
<head>
<title>Panel - <?php echo $_SERVER['HTTP_HOST'];?></title>
</head>
<body>
<?php
echo PDB::INSTALL("hi", "psw");
?>
</body>
</html>