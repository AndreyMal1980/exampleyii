<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class CallbackMasterForm  extends Model
{
    public $username;
    public $phone;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username','phone'], 'required'],
            // rememberMe must be a boolean value
         
        ];
    }

     public function attributeLabels() {
        return[
           
            'phone' => '',
            'name' => '',
           
        ];
    }
  
}
