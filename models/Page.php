<?php

namespace app\models;

use app\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

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
 * @property integer $static
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritDoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['menu_name', 'title', 'link', 'content', 'active'], 'required'],
            [['content'], 'string'],
            [['active', 'static', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['menu_name', 'title', 'description'], 'string', 'max' => 255],
            [['static'], 'default', 'value' => 0],
            [['link'], 'string', 'max' => 100],
            [['link'], 'unique'],
            [['link'], 'filter', 'filter' => 'trim'],
            [['link'], 'match', 'pattern' => '/^[a-zа-я0-9-_]{1,100}$/'],
            [
                ['created_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['created_by' => 'id'],
            ],
            [
                ['updated_by'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::class,
                'targetAttribute' => ['updated_by' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_name' => 'Название меню',
            'title' => 'Заголовок',
            'link' => 'Ссылка',
            'description' => 'Описание',
            'content' => 'Контент',
            'active' => 'Активный',
            'static' => 'Статический',
            'created_by' => 'Создал',
            'updated_by' => 'Изменил',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
