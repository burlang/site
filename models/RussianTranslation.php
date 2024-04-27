<?php

namespace app\models;

use app\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "russian_translation".
 *
 * @property integer $id
 * @property integer $ruword_id
 * @property string $name
 * @property integer|null $dict_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property RussianWord $russianWord
 * @property User $createdBy
 * @property User $updatedBy
 */
class RussianTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritDoc}
     */
    public static function tableName()
    {
        return 'russian_translation';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['ruword_id', 'name'], 'required'],
            [['ruword_id', 'dict_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [
                ['ruword_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => RussianWord::class,
                'targetAttribute' => ['ruword_id' => 'id'],
            ],
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
            'ruword_id' => 'Русское слово',
            'name' => 'Перевод',
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

    public function getRussianWord(): ActiveQuery
    {
        return $this->hasOne(RussianWord::class, ['id' => 'ruword_id']);
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
}
