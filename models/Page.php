<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "page".
 *
 * @property integer $id
 * @property string $menu_name
 * @property string $title
 * @property string $link
 * @property string $description
 * @property string $content
 * @property integer $active
 * @property integer $created_at
 * @property integer $updated_at
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className()
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['menu_name', 'title', 'link', 'content', 'active'], 'required'],
            [['content'], 'string'],
            [['active', 'created_at', 'updated_at'], 'integer'],
            [['menu_name', 'title', 'description'], 'string', 'max' => 255],
            [['link'], 'string', 'max' => 100],
            [['link'], 'unique'],
            [['link'], 'filter', 'filter' => 'trim'],
            [['link'], 'match', 'pattern' => '/^[a-zа-я0-9-_]{1,100}$/'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'menu_name' => Yii::t('app', 'Menu name'),
            'title' => Yii::t('app', 'Title'),
            'link' => Yii::t('app', 'Link'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'active' => Yii::t('app', 'Active'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
