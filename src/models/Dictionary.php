<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "dictionary".
 *
 * @property int $id
 * @property string $name
 * @property string $info
 * @property string $isbn
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BuryatTranslation[] $buryatTranslation
 * @property User $createdBy
 * @property User $updatedBy
 */
class Dictionary extends ActiveRecord
{
    public static function tableName()
    {
        return 'dictionary';
    }

    public function rules()
    {
        return [
            [['name', 'info'], 'required'],
            [['name'], 'string', 'max' => 80],
            [['info'], 'string', 'max' => 255],
            [['isbn'], 'string', 'max' => 30],
            [['created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
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

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'info' => 'Информация',
            'isbn' => 'ISBN',
            'created_by' => 'Создал',
            'updated_by' => 'Изменил',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    public function getBuryatTranslation(): ActiveQuery
    {
        return $this->hasMany(BuryatTranslation::class, ['dict_id' => 'id']);
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
