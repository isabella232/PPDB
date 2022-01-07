function previewImg(target, url, width, height, alt){
    if(/\.(gif|jpe?g|tiff?|png|webp|bmp)$/.test(url)){
        let con = document.createElement("div");
        con.className = "previewImage container";
        let img = '<img style="margin:15px;" class="rounded mx-auto previewImg" src="'+url+'" width="'+width+'" height="'+height+'" alt="'+alt+'" data-toggle="tooltip" data-placement="left" title="'+alt+'"/>';
        con.innerHTML = img
        document.querySelector(target).appendChild(con);
    }else{
        let con = document.createElement("div");
        con.className = "previewImage container";
        let img = 'Error invalid image type: ' + url;
        con.innerHTML = img
        document.querySelector(target).appendChild(con);
    }
}