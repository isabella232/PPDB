/*
* previewImage
*
* @aurthor     SurveyBuilderTeams
* @copyright   (c) 2021-2022
* @license     https://www.apache.org/licenses/LICENSE-2.0.html
* @package     PPDB
* @version     1.2.3
* @update      01-13-22
*/
function previewImg(target, url, width, height, alt){
    if(/\.(gif|jpe?g|tiff?|png|webp|bmp)$/.test(url)){
        let con = document.createElement("span");
        con.className = "previewImage container";
        let img = '<img style="margin:15px;" class="rounded mx-auto previewImg" src="'+url+'" width="'+width+'" height="'+height+'" alt="'+alt+'" data-toggle="tooltip" data-placement="left" title="'+alt+'"/>';
        con.innerHTML = img
         document.querySelector(target).appendChild(con);
    }else{
        let con = document.createElement("span");
        con.className = "previewImage container";
        let img = 'Error invalid image type: ' + url;
        con.innerHTML = img
        document.querySelector(target).appendChild(con);
    }
}
function returnImg(url, width, height, alt){
	  if(/\.(gif|jpe?g|tiff?|png|webp|bmp)$/.test(url)){
        let img = '<span class="previewImage container"><img style="margin:15px;" class="rounded mx-auto previewImg" src="'+url+'" width="'+width+'" height="'+height+'" alt="'+alt+'" data-toggle="tooltip" data-placement="left" title="'+alt+'"/></span>';
         return img;
    }else{
        let img = '<span class="previewImage container">Error invalid image type: ' + url + "</span>";
        return img;
    }
}