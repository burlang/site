<?php

declare(strict_types=1);

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

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
            ['type', 'in', 'range' => [self::TYPE_BURYAT, self::TYPE_RUSSIAN]],
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

    public static function add(string $name, int $type): void
    {
        $model = new self();
        $model->name = \strlen($name) > 255
            ? mb_substr($name, 0, 254)
            : $name;
        $model->type = $type;
        if (!$model->save()) {
            Yii::error(
                \sprintf(
                    'Failed to save SearchData. Attributes: (%s). Errors: (%s).',
                    json_encode(
                        $model->getAttributes(),
                        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                    ),
                    json_encode(
                        ArrayHelper::flatten($model->getErrors()),
                        JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
                    )
                )
            );
        }
    }
}
