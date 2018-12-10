<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "packages".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $price
 *
 * @property MasterToPackade[] $masterToPackades
 */
class Packages extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'packages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'price'], 'required'],
            [['description'], 'string'],
            [['name', 'price'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasterToPackades()
    {
        return $this->hasMany(MasterToPackade::className(), ['package_id' => 'id']);
    }
}
