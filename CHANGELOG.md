# v1.0.0

- Released fully

# v1.0.1

- fixed export data, add `$Split` DS or DS_FORWARD

# v1.0.1.1

- Fixed export removed "false" syntax error

# v1.0.1.2

- Fixed export to fit domains

# v1.0.2

- Added createTable() in query reader

# v1.1.0

- Added `CHECK_VALID_PASSWORD` and `CHANGE_PSW`

# v1.2.0

- Added `view()` function addition to `createTable()` with added value selector
- Added New Defined `VIEW_ALL` with a value of `-1`

# v1.2.1

- Fixed $READER->listFiles($dir), now outputs an array not a single string

# v1.2.2

- updated Readme.md

# v1.2.3

- fixed `Reload::run()`
- made table for stylish for panel

# v1.3.0

- added `createLinkedTable()` function: this will give you a highlighted row of what you selected to make viewing easier
- added `allowSearch()` function: this will create a search bar and makes searching even easier

# v1.3.1

- added `allowPageLimit()` function: limits how much you want to see in the table
- fixed `Line Highlight` now highlights row on page load 

# v1.3.2

- moved `is` Logics to `bin/Logic.php` use `PPDBLogic::` to trigger a logic function

# v1.3.2.1000

- Added `LIBRARY_AUTHOR` credit in `bin/init.php`

# v1.3.3

- Fixed Panel UI - but you will need to config it if you on website

# v1.4.0

- Completed Panel UI add viewable table

# v1.4.1

- Added `mySQL exporter`

# v1.4.2

- Added `PPDB::minify()`

# v1.4.3

- Fixed Panel reload, now when `user.json` file is deleted, it will reload the page and will not leave panel open.

# v1.4.4

- Added URI class and allow users to use direct url `?type="storage"|"db"|"table"`

# v1.4.5

- Fixed `URIS` is now written as `URIS::config($plugin, $pluginConfig);`
- Edited `readme.md`

# v1.4.10

- Added new `URIS::config(PREVIEW_IMG, [$target, $url, $width, $height, $alt])` called `previewImg.js` total of 5 parameters
- Fixed URIS::config error
- Updated readme.md

# v1.4.11

- Fixed import mySQL where now it will be allowed on tables(your table is your database for the file)
- Edited readme.md

# v1.4.12

- Added new function `PPDB::checkDeletedFile($dir)` checks if `user.json` is deleted
- Edit readme.md
- Added new URIS(`preivewVid.js`) 
- `previewVid` and `previewImg` now have a `return` and a `appended` function

# v1.4.13

- Fixed `PPDB::minify()` now doesn't remove hashtags inside of qoutes and from => in arrays
- Export function now needs a `DS` or `DS_FORWARD` in 3rd parameter.

# v1.4.14

- Fixed `PPDB::minify()` now single line string will still remove anything its path, so make sure the `//` is on a new line or not inside of qoutes
- export now will identify which `Split` to decide to use DOC_ROOT or DOC_ROOT_BACKWARDS

# v1.4.15

Added `PPDB::rawText()` and `PPDB::encodeText()` functions.

# v1.4.16

- fixed any bugs/glitches

# v1.4.17

- Changed Password Hash
- Added New function `PPDB::PSW_VARIFY()`
- edit readme.md

# v1.4.18

- Added `LIBRARY_AUTOUPDATE` to allo you get notify if an update is available
- Added .HTACCESS to the database folder to prevent `random users` from viewing the database
- Fixed export to `PHP_ARRAY`
- edit readme.md

# v1.4.19

- Added upload JSON file for database(can be used after export)
- Added `PPDB::success();` and `PPDB::failed();` for alerts
