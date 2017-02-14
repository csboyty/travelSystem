<?php
/**
 * Created by JetBrains PhpStorm.
 * User: TY
 * Date: 17-2-9
 * Time: 上午10:59
 * To change this template use File | Settings | File Templates.
 */
namespace backend\models;

use Yii;
use yii\base\Model;

class ALiYun extends Model
{
    public $bucket;
    public $accessKey;
    public $secretKey;
    public $handleHost;
    public $host;

    public function __construct(){
        $this->bucket=Yii::$app->params["aLiYun"]['bucket'];
        $this->accessKey=Yii::$app->params["aLiYun"]['accessKey'];
        $this->secretKey=Yii::$app->params["aLiYun"]['secretKey'];
        $this->handleHost=Yii::$app->params["aLiYun"]['handleHost'];
        $this->host=Yii::$app->params["aLiYun"]['host'];
    }

    /**
     * 生成iso8601的时间
     * @param $time
     * @return string
     */
    public function gmtIso8601($time){
        $dtStr = date("c", $time);
        $mydatetime = new \DateTime($dtStr);
        $expiration = $mydatetime->format(\DateTime::ISO8601);
        $pos = strpos($expiration, '+');
        $expiration = substr($expiration, 0, $pos);
        return $expiration."Z";
    }

    public function getExpireEnd(){
        $now = time();
        $expire = 300; //设置该policy超时时间是30s. 即这个policy过了这个有效时间，将不能访问
        $end = $now + $expire;

        return $end;
    }

    public function generatePolicy($expiration){

        //最大文件大小.用户可以自己设置
        $condition = array(0=>'content-length-range', 1=>0, 2=>1048576000);
        $conditions[] = $condition;

        $arr = array('expiration'=>$expiration,'conditions'=>$conditions);
        $policy = json_encode($arr);

        return base64_encode($policy);
    }

    public function generateSignature($policy){
        $signature = base64_encode(hash_hmac('sha1', $policy, $this->secretKey, true));

        return $signature;
    }
}