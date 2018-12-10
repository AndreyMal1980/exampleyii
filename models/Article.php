<?php
namespace app\models;
use yii\db\ActiveRecord;

class Article extends ActiveRecord
{
    
    public static function tableName() {
        parent::tableName();
        return 'articles';
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