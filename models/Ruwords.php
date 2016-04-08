<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "ruwords".
 *
 * @property integer $id
 * @property string $name
 */
class Ruwords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ruwords';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslation()
    {
        return $this->hasMany(Burtranslations::className(), ['ruword_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getTranslate()
    {
        return implode('|| ', ArrayHelper::getColumn($this->translation, 'name'));
    }
}
