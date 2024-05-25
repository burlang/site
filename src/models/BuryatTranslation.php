<?php

namespace app\models;

use app\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "buryat_translation".
 *
 * @property integer $id
 * @property integer $burword_id
 * @property integer $dict_id
 * @property string $name
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BuryatWord $buraytWord
 * @property Dictionary $dictionary
 * @property User $createdBy
 * @property User $updatedBy
 */
class BuryatTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritDoc}
     */
    public static function tableName()
    {
        return 'buryat_translation';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['name', 'burword_id'], 'required'],
            [['burword_id', 'dict_id', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 2000],
            [
                ['burword_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => BuryatWord::class,
                'targetAttribute' => ['burword_id' => 'id'],
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
            'burword_id' => 'Бурятское слово',
            'dict_id' => 'Словарь',
            'name' => 'Перевод',
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

    public function getBuryatWord(): ActiveQuery
    {
        return $this->hasOne(BuryatWord::class, ['id' => 'burword_id']);
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
