<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class News extends ActiveRecord {

     public static function tableName() {
        return 'news';
    }
    
    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
           
         
        ];
    }

    public function attributeLabels() {
        return[
          
        
        ];
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
