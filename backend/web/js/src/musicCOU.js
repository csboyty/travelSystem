var musicCOU=(function(config,functions){
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
                            window.location.href="music/index";
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

    functions.createUploader({
        multiSelection:false,
        maxSize:config.uploader.sizes.all,
        uploadBtn:"uploadBtn",
        uploadContainer:document.getElementById('uploadContainer'),
        multipartParams:null,
        filter:config.uploader.filters.all,
        filesAddedCb:function(files,up){
            $("#urlShow").text("上传中...");
        },
        progressCb:null,
        uploadedCb:function(info,file,up){
            $("#urlShow").text(info.url);

            $("#url").val(info.url);

            $(".error[for='url']").remove();
        }
    });
    $("#myForm").validate({
        ignore:[],
        rules:{
            name:{
                required:true,
                maxlength:32
            },
            url:{
                required:true
            },
            date:{
                required:true
            },
            description:{
                required:true,
                maxlength:255
            }
        },
        messages:{
            name:{
                required:config.validErrors.required,
                maxlength:config.validErrors.maxLength.replace("${max}",32)
            },
            url:{
                required:config.validErrors.required
            },
            date:{
                required:config.validErrors.required
            },
            description:{
                required:config.validErrors.required,
                maxlength:config.validErrors.maxLength.replace("${max}",255)
            }
        },
        submitHandler:function(form) {
            musicCOU.submitForm(form);
        }
    });
});

