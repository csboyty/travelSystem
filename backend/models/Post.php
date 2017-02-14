<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $date
 * @property string $thumb
 * @property string $content
 * @property string $category
 * @property integer $is_featured
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['content'], 'required'],
            [['content'], 'string'],
            [['is_featured'], 'integer'],
            [['title'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 255],
            [['thumb'], 'string', 'max' => 128],
            [['category'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'description' => 'Description',
            'date' => 'Date',
            'thumb' => 'Thumb',
            'bg_image' => 'Bg Image',
            'content' => 'Content',
            'category' => 'Category',
            'is_featured' => 'Is Featured',
        ];
    }
}
