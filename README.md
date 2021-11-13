# Portable DataBase(PDB)

### What is this?

A portable DataBase or PDB is a simplifyed version of SQLi. This uses JSON files as a database with 
inclusive secureaty. Along with a admin panel that will require a login/register prompt. Secure
any database if you have SSL(secured socket layer) and more...

### How to use?

In your codes enter this line of code what is going to require codes
```html
<?php
 require('./libs/pdb.lib.php');
 include('./libs/pdb.sql.php');
?>
<html>
<head>
<title>PDB - demo</title>
</head>
<body>
...
</body>
</html>
```

### functions

| Function | Usage 		   | Default  | return | support |
| -------- | ------------- | ------- | ------ | ------ |
| createStorage() | PDB::createStorage($name, $storagePath) | "db", ROOT | boolean | 0.0.1<X  |
| createDB() | PDB::createDB($name, $storagePath) | undefined, ROOT_DB | boolean | 0.0.1<X |
| queryDB() | PDB::queryDB($name, $storagePath) | undefined, ROOT_DB | boolean | 0.0.1<X |
| queryDB()->read()   | PDB::queryDB($name, $storagePath)->read() | null | string | 0.0.1<X |
| queryDB()->write() | PDB::queryDB($name, $storagePath)->write($str) | undefined | boolean | 0.0.1<X |
| queryDB()->test()  | PDB::queryDB($name, $storagePath)->test() | null | boolean | 0.0.1<X |
| queryDB()->ignore() | PDB::queryDB($name, $storagePath)->ignore() | null | undefined | 0.0.1<X |
| queryDB()->select() | PDB::queryDB($name, $storagePath)->select($query) | undefined | string | 0.0.1<X |
| ArrToStr() | PDB::ArrToStr($arr) | undefined | string | 0.0.1<X |
| StrToArr() | PDB::StrToArr($arr) | undefined | array | 0.0.1<X |
| toFloat()  | PDB::toFloat($str)  | undefined | int | 0.0.1<X |
| toString() | PDB::toString($int) | undefined | string | 0.0.1<X |
| encode64() | PDB::encode64($str) | undefined | string | 0.0.1<X |
| encode32() | PDB::encode32($str) | undefined | string | 0.0.1<X |
| decode64() | PDB::decode64($str) | undefined | string | 0.0.1<X |
| decode32() | PDB::decode32($str) | undefined | string | 0.0.1<X |
| hash | PDB::hash($algo, $str) | undefined, undefined | string | 0.0.1<X |
| encrypt(SSL required) | PDB::encrypt($data,$cipher_algo,$passphrase,$options,$iv,$tag,$aad,$tag_length) | undefined, undefined, undefined, 0, "", null, "", 16 | string | 0.0.1<X |
| decrypt(SSL required) | PDB::decrypt($data,$cipher_algo,$passphrase,$options,$iv,$tag,$aad) | undefined, undefined, undefined, 0, "", "", "" | string | 0.0.1<X |

### Keywords

| Keywords | value |
| ------- | ------ |
| ROOT    | ../current             |
| ROOT_DB | ../current/STORAGE/  |
| STORAGE | {create_storage}       |

***

## Export SQL database
 
 If you want to use `mySQL` database you would have you use these following codes
 
 | function | usage | default | return |
 | -------- | ----- | ------ | -------- |
 | connect()|mySQL::connect($host, $user, $psw, $db)| undefined, undefined, undefined, undefined | boolean |
 | exportAll() | mySQL::exportAll($table) | undefined | boolean |
 | export() | mySQL::export($table, $select) | undefined, undefined | boolean |
 
