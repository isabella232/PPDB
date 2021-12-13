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
| VIEW_ALL | -1 | D & L |

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
<?php 
session_start();
 
require('libs/ppdb.lib.php');
 ?>
<html>
	<head>
		<title>Panel -
			<?php echo $_SERVER['HTTP_HOST'];?>
</title>
<!--Javascript-->
<?php
echo PPDB::createJSLink("https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js");
?>

		<!-- CSS only -->
			<?php
			echo PPDB::createCSSLink("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css","sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3", "anonymous");
			echo PPDB::createPanelCSS();
			?>
		</head>
		<body>
			<?php
echo PPDB::userUI(ROOT);
if(!file_exists(ROOT.'user.json')){
		session_unset();
}
if(isset($_POST['regbtn'])){
		$username = $_POST['username'];
		$psw = $_POST['psw'];
		# Password, min, max, lower, upper, number, symbols
		if(PPDB::CHECK_VALID_PASSWORD($psw, 8, 20, true, true, true, true)){
			PPDB::INSTALL(ROOT, $username, $psw);
		$_SESSION['username'] = $username;
		}
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
	# Storage
	if(isset($_POST['store'])){
		echo "<br/><br/><form method='post'>
		<input type='submit' value='Create Storage' name='cs'/><br/><br/>
		<input type='submit' value='Remove Storage' name='rs'/>
		</form>";
	}
		if(isset($_POST['cs'])){
			if(!PPDBLogic::storageExists(ROOT)){
				PPDB::createStorage(ROOT); # ROOT or ROOT_FORWARD
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Storage created<p>';	
		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Storage already exists<p>';	
		}
		}
		if(isset($_POST['rs'])){
		if(PPDBLogic::storageExists(ROOT)){
		PPDB::removeStorage(ROOT, DS); # ROOT/ROOT_FORWARD || DS/DS_FORWARD
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Storage Removed<p>';	
		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Storage does not exist.<p>';	
		}
		
			
		}
	# Database
	
	if(isset($_POST['db'])){
			echo "<br/><br/><form method='post'>
			<input type='text' placeholder='Enter Database Name' name='dbname' require/><br/>
			<br/>
			<input type='text' placeholder='Enter Table Name' onchange='writeTable(this.value)' name='tbname' require/><br/>
			<br/>
			<textarea placeholder='Enter JSON code' id='dbarr' name='dbarr' style='margin-left:5px;width:60%;height:40%;'></textarea>
			<br/>
			<br/>
			<input type='submit' value='Create/Update' name='dbsubmit'/><br/><br/>
			<input type='submit' value='Remove' name='dbremove'/><br/><br/>
			<input type='submit' value='Rename' name='dbrename'/><br/><br/>
			<input type='submit' value='Info' name='dbinfo'/>
		</form>"; 
	}
	if(isset($_POST['dbsubmit'])){
		$fileName = $_POST['dbname'];
				$args = PPDB::JSONTOARRAY($_POST['dbarr']);
		if(!PPDBLogic::dbExists(ROOT_DB, $fileName)){ # ROOT_DB/ROOT_DB_FORWARD
			PPDB::createDB(ROOT_DB, $fileName, $args); # ROOT_DB/ROOT_DB_FORWARD
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Created<p>';
		}else{
			$READER->select(ROOT_DB, $fileName)->update($args);
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Updated<p>';
		}
	
}
	if(isset($_POST['dbremove'])){
			$fileName = $_POST['dbname'];
		if(PPDBLogic::dbExists(ROOT_DB, $fileName)){
			PPDB::removeDB(ROOT_DB, $fileName);
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Removed<p>';
		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';	
		}
	}
if(isset($_POST['dbrename'])){
			$fileName = $_POST['dbname'];
			$replace = explode(">", $fileName);
		if(PPDBLogic::dbExists(ROOT_DB, $replace[0])){
			if(strpos($fileName, ">")){

			PPDB::renameDB(ROOT_DB, $replace[0], $replace[1]);
			echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database Renamed<p>';
			}else{
				echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Textbox does not have ">" to change name<p>';
			}

		}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';	
		}
	}
if(isset($_POST['dbinfo'])){
	$fileName = $_POST['dbname'];
	if(PPDBLogic::dbExists(ROOT_DB, $fileName)){
		echo '<p style="'.PPDB::COLOR(0,255,0,1).PPDB::BOLD().PPDB::SIZE(15).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'"> Created: '.PPDB::infoDB(ROOT_DB,$fileName)['created'].'<br/> Updated: '.PPDB::infoDB(ROOT_DB,$fileName)['updated'].'<br/> Size: '.PPDB::infoDB(ROOT_DB,$fileName)['size'].'<br/> Type: '.PPDB::infoDB(ROOT_DB,$fileName)['type'].'<p>';
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}

# Table

if(isset($_POST['table'])){
	echo '<br/><br/><form method="post">
	<input type="text" name="dbname" placeholder="Enter Database Name"/><br/></br>
	<input type="text" name="dbarr" placeholder="Enter data(use \',\' split)"/><br/></br>
	<input type="text" name="dbmain" placeholder="Enter Table Name"/><br/></br>
	<input type="submit" name="LoadTable" value="Load Table"/><br/></br>
	<input type="submit" name="LoadLinkedTable" value="Load Linked Table"/>
	</form>';
}
if(isset($_POST['LoadTable'])){
	$name = $_POST['dbname'];
	$isdata = preg_replace("/\s*/m","",$_POST['dbarr']);
	$data = explode(",",$isdata);
	$main = $_POST['dbmain'];
	if(PPDBLogic::dbExists(ROOT_DB,$name)){
		echo $READER->allowSearch(0);
		echo $READER->allowPageLimit();
		echo $READER->createTable($data, PPDB::JSONTOARRAY(file_get_contents(ROOT_DB.$name.'.json')), $main ,$data)->view(VIEW_ALL);
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
}
if(isset($_POST['LoadLinkedTable'])){
	$name = $_POST['dbname'];
	$isdata = preg_replace("/\s*/m","",$_POST['dbarr']);
	$data = explode(",",$isdata);
	$main = $_POST['dbmain'];
	if(PPDBLogic::dbExists(ROOT_DB,$name)){
		echo $READER->allowSearch(0);
		echo $READER->allowPageLimit();
		echo $READER->createLinkedTable($data, PPDB::JSONTOARRAY(file_get_contents(ROOT_DB.$name.'.json')), $main ,$data)->view(VIEW_ALL);
	}else{
		echo '<p style="'.PPDB::COLOR(255,0,0,1).PPDB::BOLD().PPDB::SIZE(32).PPDB::ALIGN(CENTER).PPDB::TXTRANS(UPPERCASE).'">Database does not exist.<p>';
	}
	
}
?>




			<!-- JavaScript Bundle with Popper -->
			<?php
			echo PPDB::createJSLink("https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js", true, "sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p", "anonymous");
			echo PPDB::createJS("function writeTable(type){document.querySelector('#dbarr').value = '{\\n\"'+type+'\": [{\\n\\n}]\\n}';}","")
			?>
		</body>
	</html>
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

Changing Password:
```php
PPDB::CHANGE_PSW((ROOT/ROOT_FORWARD), $old, $new);
```

Check valid Password:
```php
PPDB::CHECK_VALID_PASSWORD($psw, $min_length, $max_length, $include_lowercase_str, $include_uppercase_str, $include_int, $include_symbol);
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
if(PPDBLogic::isNumber($value)){
//return true
}else{
//false
}
```

isString():
```php
if(PPDBLogic::isString($value)){
//return true
}else{
//false
}
```

isBoolean():
```php
if(PPDBLogic::isBoolean($value)){
//return true
}else{
//false
}
```

isArray():
```php
if(PPDBLogic::isArray($value)){
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

`$dir` eaither is`ROOT_DB` or `ROOT_DB_FORWARD`

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
$READER->export($dom, $Split, $dir, $tdir, $name, $type);
```


more variables

`$dom` eaiter `true` or `false`

`$Split` eaither `DS` or `DS_FORWARD` 

`$dir` eaither `ROOT_DB` or `ROOT_DB_FORWARD`

`$tdir` eaither `ROOT_TEMP` or `ROOT_TEMP_FORWARD`

`$name` is database name

`$type` eaither is `JSON` or `PHP_ARRAY`


Create Tabele:

```php
$READER->createTable($tbs, $trs, $main, $cels)->view($int);
```

or 

```php
$READER->createLinkedTable($tbs, $trs, $main, $cels)->view($int)
```

`$tbs` is the array to display as the "&lt;th&gt;" tag (array)
	
`$trs` user PPDB::JSONTOARRAY(file_get_contents(file-to-database))
	
`$main` your table name/first name of your array: go to [Coding PHP and JSON format](https://github.com/surveybuilderteams/PPDB#9-coding-php-and-json-format) to learn more
	
`$cels` list what needs to be displated (exact as `$tbs`)

`$int` displays what row you want to view use `-1` or `VIEW_ALL` to list all values

Search bar Table:

```php
$READER->allowSearch($int);
```

`$int` displays what row column you want to search by


Limiting Viewing Table:

```php
$READER->allowPageLimit($arg);
```

`$arg` is the array of numbers that will display on a select box to limit on how much you want to see

List Database Files:

```php
$READER->listFiles($dir)[$int];
```

`$dir` is eaither a ROOT_DB or ROOT_DB_FORWARD

`$int` is the index of the selector you want

### 7. Styling(CSS)

Styling your page is simple as well

Linking:

```php 
PPDB::createCSSLink($url, $inter="", $crossorigin="");
```

`$url` enter valid css `URL/path`
`$inter` enter a valid `integrity`
`$crossorgin` enter a vlaid `crossorigin setting`

Creating:

```php
PPDB::createCSS($css);
```

`$css` enter CSS code, YOU DO NOT NEED THE STYLE TAG

### 8. scripting(JS)

Same thing as [Styling](#7-stylingcss)

Linking:

```php
PPDB::createJSLink($url, $onLoad=true, $integrity="", $crossorigin="", $referrerpolicy="");
```

`$url` enter valid JS `url/path`

`$onLoad` run code on load

`$integrity` enter valid `integrity`

`$crossorigin` enter valid `crossorigin setting`

`$referrerpolicy` enter valid `referrerpolicy`

Creating:

```php
PPDB::createJS($JS, $id, $onLoad=true);
```

`$JS` enter `JavaScript code`

`$id` enter `ID`

`$onLoad` run code on load

### 9. Coding PHP and JSON format

This is a strict type of database, all database are required to have a table

JSON example: 

```json
{
"users": [{
"__comment__": "Use only arrays, strings, numbers, no extra string"
}]
}
```
"users" is the table of the setting

PHP example:

```php
array (
  'users' => 
  array (
    0 => 
    array (
      '__comment__' => 'Use only arrays, strings, numbers, no extra string',
    ),
  ),
)
```

in PHP this will select `users=>0` being `__comment__`
