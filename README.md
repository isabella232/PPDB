# PHP Program DataBase(PPDB)
 
### What is this?

A portable DataBase or PDB is a simplifyed version of SQLi. This uses JSON files as a database with 
inclusive security. Along with a admin panel that will require a login/register prompt. Secure
any database if you have SSL(secured socket layer) and more...

***
 
### How to install?

In your code enter this line of code:
```php
PPDB::Install($username, $password);
```
or if `panel.php` use the register/login prompt


### How to use?

In your codes enter this line of code what is going to require codes
```html
<?php
 require('./libs/ppdb.lib.php');
?>
<html>
<head>
<title>PPDB - Panel</title>
</head>
<body>
...
</body>
</html>
```

or

You can use our `panel.php` as a baseplate of plugins and other database extentions for non-developers

***

# Developer tools
This can be used as a `Developer tools` This is also be a documentation as well...

### Defined variables 

L = Localhost | D = Domain
| Define | output | Allow |
| ------ | ------ | ----- |
| DS     |  "\\"   | L |
| DS_FORWARD | "/" | D |
| ROOT | dirname(__FILE__).DS | L |
| ROOT_FORWARD | dirname(__FILE__).DS_FORWARD | D |
| ROOT_DB | dirname(__FILE__).DS."db".DS | L |
| ROOT_DB_FORWARD | dirname(__FILE__).DS_FORWARD."db".DS_FORWARD | D |
| ROOT_TEMP | dirname(__FILE__).DS."libs".DS."temp".DS | L |
| ROOT_TEMP_FORWARD | dirname(__FILE__).DS_FORWARD."libs".DS_FORWARD."temp".DS_FORWARD | D |
| DOC_ROOT | $_SERVER['DOCUMENT_ROOT'] | D |
| DOC_ROOT_BACKWARDS | str_replace("/","\\", $_SERVER['DOCUMENT_ROOT']) | L |
| PPDB_CONNECT | $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] | D & L |
| PPDB_SERVER_NAME | $_SERVER['SERVER_NAME'] | D & L |
| PPDB_SERVER_PORT | $_SERVER['SERVER_PORT'] | D & L |
| SESSION_USER | $_SESSION['username'] | D & L |
| JUSTIFY | justify | D & L |
| LEFT | left | D & L |
| CENTER | center | D & L |
| RIGHT | right | D & L |
| CAPITALIZE | capitalize | D & L |
| UPPERCASE | uppercase | D & L |
| LOWERCASE | lowercase | D & L |
| FILE_INFO | ["created", "updated", "size", "type"] | D & L |




 
