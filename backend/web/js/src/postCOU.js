var videoCOU=(function(config,functions){
    return{
        submitForm:function(form){
            var me=this;
            functions.showLoading();
            $(form).ajaxSubmit({
                dataType:"json",
                success:function(response){
                    if(response.success){
                        $().toastmessage("showSuccessToast",config.messages.optSuccess);
                        setTimeout(function(){
                            window.location.href="post/index";
                        },3000);
                    }else{
                        functions.ajaxReturnErrorHandler(response.error_code);
                    }
                },
                error:function(){
                    functions.ajaxErrorHandler();
                }
            });
        }
    }
})(config,functions);

$(document).ready(function(){
    $("#date").date_input();

    tinymce.init({
        selector: "#content",
        height:300,
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        //image_advtab: true,
        plugins : 'link image preview fullscreen table textcolor colorpicker code',
        setup: function (ed) {
            ed.on('blur', function (e) {
                $("#content").val(ed.getContent());
                if(ed.getContent()){
                    $(".error[for='content']").remove();
                }
            });
        }
    });

    functions.createUploader({
        multiSelection:false,
        maxSize:config.uploader.sizes.all,
        uploadBtn:"uploadBtn",
        uploadContainer:document.getElementById('uploadContainer'),
        multipartParams:null,
        filter:config.uploader.filters.all,
        filesAddedCb:function(files,up){
            functions.showLoading();
        },
        progressCb:null,
        uploadedCb:function(info,file,up){
            functions.hideLoading();

            var image = new Image();
            image.onload=function(){
                var width = image.width;
                var height = image.height;
                if(width/height==1&&400<=width&&width<=8000){
                    $("#imageUrl").val(info.url);

                    $("#image").attr("src",info.url);

                    $(".error[for='imageUrl']").remove();
                }else{
                    $().toastmessage("showErrorToast",config.messages.imageSizeError);
                }
            };
            image.src= info.url;

        }
    });
    $("#myForm").validate({
        ignore:[],
        rules:{
            thumb:{
                required:true
            },
            date:{
                required:true
            },
            title:{
                required:true,
                maxlength:32
            },
            description:{
                required:true,
                maxlength:255
            },
            url:{
                required:true,
                maxlength:128
            }
        },
        messages:{
            thumb:{
                required:config.validErrors.required
            },
            date:{
                required:config.validErrors.required
            },
            title:{
                required:config.validErrors.required,
                maxlength:config.validErrors.maxLength.replace("${max}",32)
            },
            description:{
                required:config.validErrors.required,
                maxlength:config.validErrors.maxLength.replace("${max}",255)
            },
            url:{
                required:config.validErrors.required,
                maxlength:config.validErrors.maxLength.replace("${max}",128)
            }
        },
        submitHandler:function(form) {
            videoCOU.submitForm(form);
        }
    });
});
