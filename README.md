# Portable DataBase(PDB)

### What is this?

A portable DataBase or PDB is a simplifyed version of SQLi. This uses JSON files as a database with 
inclusive secureaty. Along with a admin panel that will require a login/register prompt. Secure
any database if you have SSL(secured socket layer) and more...

### How to use?

In your codes enter this line of code what is going to require codes
```html
<?php require('./libs/pdb.lib.php')?>
<html>
<head>
<title>PDB - demo</title>
</head>
<body>
...
</body>
</html>
```

### Usable actions

| Function | Usage 		   | Default  | return | support |
| -------- | ------------- | ------- | ------ | ------ |
| createStorage() | PDB::createStorage($name, $storagePath) | "db", CURR_ROOT | boolean | 0.0.1<X  |
| createDB() | PDB::createDB($name, $storagePath) | undefined, ROOT_DB | boolean | 0.0.1<X |
| queryDB() | PDB::queryDB($name, $storagePath) | undefined, ROOT_DB | boolean | 0.0.1<X |
| queryDB()->read()   | PDB::queryDB($name, $storagePath)->read() | null | string | 0.0.1<X |
| queryDB()->write() | PDB::queryDB($name, $storagePath)->write($str) | undefined | boolean | 0.0.1<X |
| queryDB()->test()  | PDB::queryDB($name, $storagePath)->test() | null | boolean | 0.0.1<X |
| queryDB()->ignore() | PDB::queryDB($name, $storagePath)->ignore() | null | undefined | 0.0.1<X |
| queryDB()->select() | PDB::queryDB($name, $storagePath)->select($query) | undefined | string | 0.0.1<X |
