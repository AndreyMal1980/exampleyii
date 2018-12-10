<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class HelperSelectMasterForm extends Model
{
    public $phone;
 
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['phone'], 'required'],
            // email has to be a valid email address
           
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
          'phone' => ''
        ];
    }

   
}
