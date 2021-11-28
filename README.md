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

***

## Defined variables 

L = Localhost | D = Domain
| Define | output | Allow |
| ------ | ------ | ----- |
| DS     |  "\\"   | L |
| DS_FORWARD | "/" | D |
| ROOT | dirname( __ FILE __ ).DS | L |
| ROOT_FORWARD | dirname( __ FILE __ ).DS_FORWARD | D |
| ROOT_DB | dirname( __ FILE __ ).DS."db".DS | L |
| ROOT_DB_FORWARD | dirname( __ FILE __ ).DS_FORWARD."db".DS_FORWARD | D |
| ROOT_TEMP | dirname( __ FILE __ ).DS."libs".DS."temp".DS | L |
| ROOT_TEMP_FORWARD | dirname( __ FILE __ ).DS_FORWARD."libs".DS_FORWARD."temp".DS_FORWARD | D |
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

***

## PDDB FUNCTIONS

### 1. Creating/Removing storage
Creating storage is the first step, this will make it easier to store data, by your custom name of file, folder will always be `db`

Creating:
```php
PPDB::createStorage($dir)
```
Removing:
```php
PPDB::removeStorage($dir, $Slash);
```

`$dir` can be either `ROOT` or `ROOT_FORWARD` 

`$Slash` can be eaither `DS` or `DS_FORWARD`

### 2. User UI(only Panel use)
This line of code only works for panel uses aka: `panel.php`

Build prompt/panel (`panel.php`):
```php
echo PPDB::userUI(ROOT);
if(!file_exists(ROOT.'user.json')){
		session_unset();
}
if(isset($_POST['regbtn'])){
		$username = $_POST['username'];
		$psw = $_POST['psw'];
		
		PPDB::INSTALL(ROOT, $username, $psw);
		$_SESSION['username'] = $username;
	}
	if(isset($_POST['logbtn'])){
		$username = $_POST['username'];
		$psw = $_POST['psw'];
		$psw = PPDB::PSW_ENCRYPT($psw);
		$json = file_get_contents(ROOT."user.json");
		$query = json_decode($json);
		if($username === $query->user && $psw === $query->password){
			$_SESSION['username'] = $username;
				Reload::run();
		}else{
			echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(42).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Error: cannot login correctly!</p>';
		}
		
	}
	echo PPDB::loadPanel();
	echo PPDB::logout();
```

ok, lets break it down

creating the prompt:
```php
PPDB::ueserUI(ROOT/ROOT_FOWARD)
```

Creating user data: 
```php
PPDB::INSTALL((ROOT/ROOT_FORWARD), $username, $psw);
```

Encrypting Password:
```php
PPDB::PSW_ENCRYPT($psw);
```

Reloading Page:
```php
Reload::run();
```

Loading panel:
```php
echo PPDB::loadPanel();
```

Logout function/button:
```php
echo PPDB::logout();
```

That is the basic parts of the panel

### 3. Logics

isNumber():
```php
if(PPDB::isNumber($value)){
//return true
}else{
//false
}
```

isString():
```php
if(PPDB::isString($value)){
//return true
}else{
//false
}
```

isBoolean():
```php
if(PPDB::isBoolean($value)){
//return true
}else{
//false
}
```

isArray():
```php
if(PPDB::isArray($value)){
//return true
}else{
//false
}
```

### 4. creating/removing/renaming Database

This is easy

creating database:
```php
PPDB::createDB($dir, $name, $arr)
```

Removing database:
```php
PPDB::removeDB($dir, $name);
```

Renaming database:
```php
PPDB::renameDB($dir, $oldName, $newName);
```

`$dir` eaither is`ROOT` or `ROOT_FORWARD`

`$name` is the name of your database

`$oldName` is the current database name

`$newName` is to set a new name for the old database

`$arr` is the array which converts to JSON

### 5. Converting JSON to Array / ARRAY TO JSON

JSONTOARRAY():
```php
PPDB::JSONTOARRAY($JSON);
```
ARRAYTOJSON():
```php
PPDB::ARRAYTOJSON($ARRAY);
```

### 6. Query

This is defaulted to use `$READER` before doing a task

Selecting:
```php
$READER->select($sdir, $sname)
```

`$sdir` is eaither `ROOT_DB` or `ROOT_DB_FORWARD`

`$sname` is your database name

Reading:
```php
$READER->select($sdir, $sname)->read()
```

this will be converted to an array after read, put an array of items to access what needs to be shown

example(find user at array 0 name):
```php
echo $READER->select($sdir, $sname)->read()['user'][0]['name'];
```

Updating:

```php
$READER->select($sdir, $sname)->update($arr);
```

same variables but `$arr` means PHP array to convert to JSON

Export:

```php
$READER->export($dir, $tdir, $name, $type);
```

more variables

`$dir` eaither `ROOT_DB` or `ROOT_DB_FORWARD`

`$tdir` eaither `ROOT_TEMP` or `ROOT_TEMP_FORWARD`

`$name` is database name

`$type` eaither is `JSON` or `PHP_ARRAY`
