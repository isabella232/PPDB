/*
* bgcolor
*
* @aurthor     SurveyBuilderTeams
* @copyright   (c) 2021-2022
* @license     https://www.apache.org/licenses/LICENSE-2.0.html
* @package     PPDB
* @version     1.2
* @update      01-01-22
*/

function bgcolor(color, sel){
	let conv = '{"bg": "'+color+'"}';
	let obj = JSON.parse(conv);
	document.querySelector(sel).style.backgroundColor = obj.bg;
}