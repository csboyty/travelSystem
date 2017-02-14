<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use backend\models\ALiYun;
use common\components\AccessRule;
use common\models\User;

/**
 * Class ALiYunController
 * @package backend\controllers
 */
class ALiYunController extends \yii\web\Controller
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
                            User::ROLE_ADMIN,
                            User::ROLE_SUPER_ADMIN
                        ],
                    ]
                ],
            ]
        ];
    }

    public function actionGetSignature(){

        $aLiYun=new ALiYun();
        $expireEnd=$aLiYun->getExpireEnd();
        $expiration=$aLiYun->gmtIso8601($expireEnd);
        $policy=$aLiYun->generatePolicy($expiration);

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $response = array();
        $response['accessKey'] = $aLiYun->accessKey;
        $response['host'] = $aLiYun->host;
        $response['policy'] = $policy;
        $response['signature'] = $aLiYun->generateSignature($policy);
        $response['expire'] = $expireEnd;

        return $response;
    }
}
