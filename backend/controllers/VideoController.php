<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\components\AccessRule;
use common\models\User;
use backend\models\Video;

/**
 * Class ActivityController 活动控制器
 * @package backend\controllers
 */
class VideoController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // We will override the default rule config with the new AccessRule class
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => [
                            User::ROLE_ADMIN
                        ],
                    ]
                ],
            ]
        ];
    }

    /**
     * 快乐美术教室历年活动
     * @return string
     */
    public function actionIndex(){
        return $this->render("index");
    }

    public function actionCreate(){

        $model=new Video();

        return $this->render('cOU',[
            'model' => $model,
        ]);
    }

    public function actionUpdate($id){

        //这样获取会将isNewRecord设置为false
        $model = $this->findModel($id);

        return $this->render('cOU',[
            'model' => $model,
        ]);
    }

    public function actionList(){
        $params=Yii::$app->request->queryParams;
        $limit=$params["iDisplayLength"];
        $offset=$params["iDisplayStart"];
        $sEcho = $params["sEcho"];
        $query=Video::find();

        $count=$query->count();
        $aaData=$query
            ->asArray()
            ->limit($limit)
            ->orderBy(['date' => SORT_DESC])
            ->offset($offset)
            ->all();

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        return [
            'success' => true,
            'aaData' => $aaData,
            "iTotalRecords"=>$count,
            "iTotalDisplayRecords"=>$count,
            "sEcho"=>$sEcho
        ];

    }

    /**
     *新增和修改提交
     * @return array
     */
    public function actionSubmit(){

        $params=Yii::$app->request->post();

        if(isset($params["id"])){
            $model = $this->findModel($params["id"]);
        }else{
            $model=new Video();
        }

        $data=array();

        //yii自动生成的form参数是Xxx["name"]这种形式，获取后就会是在一个Xxx中
        $data["Video"]=$params;

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($model->load($data) && $model->save()) {
            return [
                "success"=>true
            ];
        }else{
            return [
                "success"=>false,
                "error_code"=>1
            ];
        }
    }

    public function actionDelete($id)
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if($this->findModel($id)->delete()){
            return [
                "success"=>true
            ];
        }else{
            return [
                "success"=>false,
                "error_code"=>1
            ];
        }

    }

    /**
     * Finds the Notice model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notice the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Video::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
