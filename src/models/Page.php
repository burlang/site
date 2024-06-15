<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "page".
 *
 * @property int $id
 * @property string $menu_name
 * @property string $title
 * @property string $link
 * @property string $description
 * @property string $content
 * @property int $active
 * @property int $static
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Page extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'page';
    }

    public function rules(): array
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

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributeLabels(): array
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
