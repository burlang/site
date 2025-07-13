<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "russian_translation".
 *
 * @property int $id
 * @property int $ruword_id
 * @property string $name
 * @property int|null $dict_id
 * @property int $created_by
 * @property int $updated_by
 * @property int $created_at
 * @property int $updated_at
 *
 * @property RussianWord $russianWord
 * @property User $createdBy
 * @property User $updatedBy
 */
class RussianTranslation extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'russian_translation';
    }

    public function rules(): array
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
     * @return array<string, string>
     */
    public function attributeLabels(): array
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

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
            BlameableBehavior::class,
        ];
    }

    /** @return ActiveQuery<RussianWord> */
    public function getRussianWord(): ActiveQuery
    {
        return $this->hasOne(RussianWord::class, ['id' => 'ruword_id']);
    }

    /** @return ActiveQuery<Dictionary> */
    public function getDictionary(): ActiveQuery
    {
        return $this->hasOne(Dictionary::class, ['id' => 'dict_id']);
    }

    /** @return ActiveQuery<User> */
    public function getCreatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /** @return ActiveQuery<User> */
    public function getUpdatedBy(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'updated_by']);
    }
}
