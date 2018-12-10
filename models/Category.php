<?php
namespace app\models;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    
    public static function tableName() {
        parent::tableName();
        return 'categories';
    }
    
     public function getOrders() {
        return $this->hasMany(Orders::className(), ['id' => 'id']);
    }
    
}