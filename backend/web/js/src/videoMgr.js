$(document).ready(function(){

    var mgr=new Mgr(function createTable(){

        var ownTable=$("#myTable").dataTable({
            "bServerSide": true,
            "sAjaxSource": config.ajaxUrls.videoGetAll,
            "bInfo":true,
            "bProcessing":true,
            "bLengthChange": false,
            "bFilter": false,
            "bSort":false,
            "bAutoWidth": false,
            "iDisplayLength":config.perLoadCounts.table,
            "sPaginationType":"full_numbers",
            "oLanguage": {
                "sUrl":config.dataTable.langUrl
            },
            "aoColumns": [
                { "mDataProp": "thumb",
                    "fnRender":function(oObj){
                        return "<img class='thumb' src='"+oObj.aData.thumb+"'>";
                    }
                },
                { "mDataProp": "name"},
                { "mDataProp": "date"},
                { "mDataProp": "is_featured",
                    "fnRender":function(oObj){
                        return config.status.is_featured[oObj.aData.is_featured];
                    }
                },
                { "mDataProp": "opt",
                    "fnRender":function(oObj){
                        return '<a href="video/update?id='+oObj.aData.id+'">修改</a>&nbsp;' +
                            '<a class="delete" href="video/delete?id='+oObj.aData.id+'">删除</a>';
                    }
                }
            ] ,
            "fnServerParams": function ( aoData ) {

            },
            "fnServerData": function(sSource, aoData, fnCallback) {

                //回调函数
                $.ajax({
                    "dataType":'json',
                    "type":"get",
                    "url":sSource,
                    "data":aoData,
                    "success": function (response) {
                        if(response.success===false){
                            functions.ajaxReturnErrorHandler(response.error_code);
                        }else{
                            var json = {
                                "sEcho" : response.sEcho
                            };

                            for (var i = 0, iLen = response.aaData.length; i < iLen; i++) {
                                response.aaData[i].opt="opt";
                            }

                            json.aaData=response.aaData;
                            json.iTotalRecords = response.iTotalRecords;
                            json.iTotalDisplayRecords = response.iTotalDisplayRecords;
                            fnCallback(json);
                        }

                    }
                });
            },
            "fnFormatNumber":function(iIn){
                return iIn;
            }
        });

        return ownTable;
    });

    mgr.initFunc();
});

