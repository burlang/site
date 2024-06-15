<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "buryat_translation".
 *
 * @property int $id
 * @property int $burword_id
 * @property int $dict_id
 * @property string $name
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property BuryatWord $buraytWord
 * @property Dictionary $dictionary
 * @property User $createdBy
 * @property User $updatedBy
 */
class BuryatTranslation extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'buryat_translation';
    }

    public function rules(): array
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
     * @return array<string, string>
     */
    public function attributeLabels(): array
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

    public function behaviors(): array
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
