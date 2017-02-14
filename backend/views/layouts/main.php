<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/app/logo_title_32X32.ico" type="image/x-icon" />
    <link rel="icon" href="images/app/logo_title_32X32.ico" type="image/x-icon" />
    <link rel="icon" href="images/app/logo_title.png" type=" image/png" >
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode("MARKOR-CSR | ".$this->title) ?></title>
    <base href="<?php echo Yii::$app->request->hostInfo.Yii::$app->request->baseUrl; ?>/">
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="header">
    <h1 class="logo">旅游景点展示系统</h1>
    <nav class="topNav">
        <ul>
            <li><a href="account/edit-pwd" class="editpwd">修改密码</a></li>
            <li><a href="site/logout" class="logout">退出</a></li>
        </ul>
    </nav>
    
    
</div>

<div class="left">
    <ul class="menu">
        <?php
        if(isset(Yii::$app->user->identity)&&Yii::$app->user->identity->role=="SUPER_ADMIN"){
        ?>
            <li class="item">
                <span class="glyphicon glyphicon-cog"></span>
                <a class="link" href="setting/index">模块设置</a>
            </li>

        <?php
            }else{
        ?>

            <li class="item">
                <span class="glyphicon glyphicon-pencil"></span>
                <a class="link" href="post/index">文章</a>
            </li>
            <li class="item">
                <span class="glyphicon glyphicon-facetime-video"></span>
                <a class="link" href="video/index">视频</a>
            </li>
            <li class="item">
                <span class="glyphicon glyphicon-music"></span>
                <a class="link" href="music/index">音乐</a>
            </li>
        <?php
        }
        ?>
    </ul>
</div>

<div class="right">
    <div class="main">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title"><?= Html::encode($this->title) ?></h1>
            </div>
            <div class="panel-body">
                <?= $content ?>
            </div>
        </div>
    </div>
</div>


<div class="loading hidden" id="loading">
    <span class="text">Loading...</span>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
