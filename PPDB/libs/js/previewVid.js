/*
* previewImage
*
* @aurthor     SurveyBuilderTeams
* @copyright   (c) 2021-2022
* @license     https://www.apache.org/licenses/LICENSE-2.0.html
* @package     PPDB
* @version     1.0.0
* @update      01-17-22
*/
function previewVid(target, url, width, height, alt){
    if(/\.(mp4|mov?|wmv|avi|avchd)$/.test(url)){
        let con = document.createElement("span");
        con.className = "previewVideo container";
        let vid = '<video style="margin:15px;" controls="" class="previewVideo" src="'+url+'" width="'+width+'" height="'+height+'" alt="'+alt+'" data-toggle="tooltip" data-placement="left" title="'+alt+'"></video>';
        con.innerHTML = vid
         document.querySelector(target).appendChild(con);
    }else{
        let con = document.createElement("span");
        con.className = "previewVideo container";
        let vid = 'Error invalid video type: ' + url;
        con.innerHTML = vid
        document.querySelector(target).appendChild(con);
    }
}
function returnVid(url, width, height, alt){
	  if(/\.(mp4|mov?|wmv|avi|avchd)$/.test(url)){
        let vid = '<span class="previewVideo container"><video controls="" style="margin:15px;" class="previewVideo" src="'+url+'" width="'+width+'" height="'+height+'" alt="'+alt+'" data-toggle="tooltip" data-placement="left" title="'+alt+'"></video></span>';
         return vid;
    }else{
        let vid = '<span class="previewVideo container">Error invalid video type: ' + url + "</span>";
        return vid;
    }
}