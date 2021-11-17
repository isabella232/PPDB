# PHP Program DataBase(PPDB)

### What is this?

A portable DataBase or PDB is a simplifyed version of SQLi. This uses JSON files as a database with 
inclusive security. Along with a admin panel that will require a login/register prompt. Secure
any database if you have SSL(secured socket layer) and more...

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
 require('./libs/ppdb.sql.php');
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

### Developer tools

Until were finished I will put up a documentation that developers can use

***

## Export SQL database
 
 If you want to use `mySQL` database you would have you use these following codes
 
 | function | usage | default | return |
 | -------- | ----- | ------ | -------- |
 | connect()|mySQL::connect($host, $user, $psw, $db)| undefined, undefined, undefined, undefined | boolean |
 | exportAll() | mySQL::exportAll($table) | undefined | boolean |
 | export() | mySQL::export($table, $select) | undefined, undefined | boolean |
 
