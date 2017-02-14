/**
 * Created with JetBrains PhpStorm.
 * User: TY
 * Date: 17-2-9
 * Time: 下午3:50
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){
    functions.createUploader({
        multiSelection:false,
        maxSize:config.uploader.sizes.img,
        uploadBtn:"btn",
        uploadContainer:document.getElementById('container'),
        multipartParams:null,
        filter:config.uploader.filters.img
    })
});
