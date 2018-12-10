<?php

namespace app\models;

use Yii;


/**
 * This is the model class for table "master_to_category".
 *
 * @property string $user_id
 * @property string $category_id
 *
 * @property Categories $category
 * @property Users $user
 */
class MasterToCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
   


    public static function tableName()
    {
        return 'master_to_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id'], 'required'],
            [['user_id', 'category_id'], 'integer'],
            [['user_id', 'category_id'], 'unique', 'targetAttribute' => ['user_id', 'category_id'], 'message' => 'The combination of User ID and Category ID has already been taken.'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
