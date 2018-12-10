<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property string $id
 * @property integer $parent_id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $image
 * @property string $date_added
 * @property string $date_modificate
 *
 * @property MasterToCategory[] $masterToCategories
 * @property Orders[] $orders
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'title', 'image'], 'required'],
            [['parent_id'], 'integer'],
            [['description'], 'string'],
            [['date_added', 'date_modificate'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['keywords', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№ категории',
            'parent_id' => 'Родительская категория',
            'title' => 'Имя',
            'description' => 'Описание',
            'keywords' => 'Ключевые слова',
            'image' => 'Изображенеие',
            'date_added' => 'Дата создания',
            'date_modificate' => 'Дата изменения',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasterToCategories()
    {
        return $this->hasMany(MasterToCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['category_id' => 'id']);
    }
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'parent_id']);
    }
}
