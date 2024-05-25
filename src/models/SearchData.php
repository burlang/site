<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "search_data".
 *
 * @property integer $id
 * @property string $name
 * @property integer $type
 * @property integer $created_at
 * @property integer $updated_at
 */
class SearchData extends ActiveRecord
{
    public const TYPE_BURYAT = 0;
    public const TYPE_RUSSIAN = 1;

    /**
     * {@inheritDoc}
     */
    public static function tableName()
    {
        return 'search_data';
    }

    /**
     * {@inheritDoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['type', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'type' => 'Тип',
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
        ];
    }
}
