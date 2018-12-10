<?php
namespace app\models;
use yii\db\ActiveRecord;

class Advantagi extends ActiveRecord
{
    
    public static function tableName() {
        parent::tableName();
        return 'advantagi';
    }
    
     public function behaviors()
    {
        return [
            'imageFile' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
}