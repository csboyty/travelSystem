<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "video".
 *
 * @property integer $id
 * @property string $name
 * @property string $date
 * @property string $description
 * @property string $thumb
 * @property string $url
 * @property integer $is_featured
 */
class Video extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'video';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['is_featured'], 'integer'],
            [['name'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 255],
            [['thumb', 'url'], 'string', 'max' => 128]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date' => 'Date',
            'description' => 'Description',
            'thumb' => 'Thumb',
            'url' => 'Url',
            'is_featured' => 'Is Featured',
        ];
    }
}
