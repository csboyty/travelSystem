<?php

use yii\helpers\Html;
use backend\assets\AppAsset;

?>

    <a class="btn btn-success" href="post/create">
        <span class="glyphicon glyphicon-plus"></span> 新建
    </a>
    <div class="tableSearchContainer">
        <label>分类</label>
        <div class="col">
            <select class="form-control" id="category">
                <option value="">全部</option>
                <option value="风景">风景</option>
                <option value="人文">人文</option>
                <option value="物语">物语</option>
                <option value="社区">社区</option>
            </select>
        </div>
        <label style="margin-left: 10px;">置顶</label>
        <div class="col">
            <select class="form-control" id="filter">
                <option value="">全部</option>
                <option value="1">置顶</option>
                <option value="0">未置顶</option>
            </select>
        </div>
        <button id="searchBtn" class="btn btn-default" type="button">搜索</button>
    </div>
    <table id="myTable" class="dataTable">
        <thead>
        <tr>
            <th>图片</th>
            <th>标题</th>
            <th>时间</th>
            <th>分类</th>
            <th>推荐</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <!--<tr>
            <td>xxx</td>
            <td>xxx</td>
            <td>
            <a href="award/update">修改</a>&nbsp;
            <a href="1" class="delete">删除</a>
            </td>
        </tr>-->
        </tbody>
    </table>



<?php
$this->registerJsFile("@web/js/src/postMgr.js",['depends' => [backend\assets\AppAsset::className()]]);
?>