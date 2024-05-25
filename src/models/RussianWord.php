<?php

namespace app\models;

use app\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "russian_word".
 *
 * @property integer $id
 * @property string $name
 * @property integer|null $dict_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property RussianTranslation[] $translations
 * @property User $createdBy
 * @property User $updatedBy
 */
class RussianWord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritDoc}
     */
    public static function tableName()
    {
        return 'russian_word';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'unique'],
            [['dict_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
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
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'dict_id' => 'Словарь',
            'created_by' => 'Создал',
            'updated_by' => 'Изменил',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
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

    public function getDictionary(): ActiveQuery
    {
        return $this->hasOne(Dictionary::class, ['id' => 'dict_id']);
    }

    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    public function getUpdatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }

    public function getTranslations(): ActiveQuery
    {
        return $this->hasMany(RussianTranslation::class, ['ruword_id' => 'id']);
    }
}
