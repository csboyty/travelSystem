<?php

use yii\helpers\Html;
use backend\assets\AppAsset;

$this->title = '新建/修改视频';

$this->registerCssFile("@web/css/lib/date_input.css");
?>
    <form class="form-horizontal" id="myForm" action="video/submit" method="post">
        <?php
        if($model->id){
            ?>
            <input type="hidden" name="id" value="<?php echo $model->id; ?>">
        <?php
        }
        ?>
        <div class="form-group">
            <label class="control-label col-md-2">封面图*</label>
            <div class="col-md-10" id="uploadContainer">
                <a href="#" class="btn btn-success" id="uploadBtn">上传</a>
                <p class="help-block">请上传1:1的jpg，png，宽度400px-800px</p>
                <img  id="image"  style="width:100px"
                      src="<?php echo $model->thumb?$model->thumb:'images/app/defaultThumb.png'; ?>"/>
                <input type="hidden" id="imageUrl" name="thumb" value="<?php echo $model->thumb; ?>">
            </div>
        </div>
        <div class="form-group">
            <label  class="control-label col-md-2">标题*</label>
            <div class="col-md-8">
                <input type="text" class="form-control" value="<?php echo $model->name; ?>" name="name">
            </div>
        </div>
        <div class="form-group">
            <label  class="control-label col-md-2">日期*</label>
            <div class="col-md-8">
                <input type="text" class="form-control" id="date" value="<?php echo $model->date; ?>" name="date">
            </div>
        </div>
        <div class="form-group">
            <label  class="control-label col-md-2">描述*</label>
            <div class="col-md-8">
                <textarea class="form-control"  name="description" rows="3"><?php echo $model->description; ?></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2">地址*</label>
            <div class="col-md-8">
                <input type="text" class="form-control" value="<?php echo $model->url; ?>" name="url">
            </div>
        </div>
        <div class="form-group">
            <label for="name" class="control-label col-md-2">置顶*</label>
            <div class="col-md-8">
                <select name="is_featured" class="form-control">
                    <?php
                    $values=[
                        [
                            "name"=>"不置顶",
                            "value"=>0
                        ],
                        [
                            "name"=>"置顶",
                            "value"=>1
                        ]
                    ];
                    foreach($values as $v){
                        ?>

                        <option
                            <?php if(isset($model)&&$model->is_featured==$v["value"]){
                                echo "selected";
                            } ?>
                            value="<?php echo $v["value"]; ?>"><?php echo $v["name"]; ?>
                        </option>

                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-offset-2 col-md-8">
                <button type="submit" class="btn btn-success form-control">确定</button>
            </div>
        </div>
    </form>

<?php
$this->registerJsFile("@web/js/lib/jquery.date_input.js",['depends' => [backend\assets\AppAsset::className()]]);
$this->registerJsFile("@web/js/src/videoCOU.js",['depends' => [backend\assets\AppAsset::className()]]);
?>