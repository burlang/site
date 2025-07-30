<?php

declare(strict_types=1);

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Exception;

/**
 * This is the model class for table "search_data".
 *
 * @property int $id
 * @property string $name
 * @property int $type
 * @property int $created_at
 * @property int $updated_at
 */
class SearchData extends ActiveRecord
{
    public const TYPE_BURYAT = 0;
    public const TYPE_RUSSIAN = 1;

    public static function tableName(): string
    {
        return 'search_data';
    }

    public function rules(): array
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'type' => 'Тип',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,
        ];
    }

    public static function store(string $word, int $type): void
    {
        $model = new self();
        $model->name = \strlen($word) > 255
            ? mb_substr($word, 0, 254)
            : $word;
        $model->type = $type;
        if (!$model->save()) {
            throw new Exception('Не удалось добавить данные');
        }
    }
}
