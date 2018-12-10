<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Orders extends ActiveRecord {

    public $reg;
    public $foto;
    public $del_foto;

    public static function tableName() {
        return 'orders';
    }

    public function upload() {


        $this->foto->saveAs('uploads/' . $this->foto->baseName . '.' . $this->foto->extension);
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            // [['name_orders', 'description', 'category_id', 'email', 'username', 'phone', 'city', 'foto'], 'required', 'message' => 'Поле обязательно для заполнения'],
            [['name_orders', 'description', 'category_id', 'email', 'username', 'phone', 'city', 'user_id', 'foto'], 'safe'],
                //  [['foto'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function attributeLabels() {
        return[
            'name_orders' => 'Название задачи',
            'description' => '',
            'date_added' => 'Дата публикации',
            'status_id' => 'Статус',
            'category_id' => '',
            'email' => '',
            'username' => '',
            'phone' => '',
            'city' => '',
            'reg' => 'Зарегестрироваться на портале',
            'foto' => 'Image',
            'del_foto' => 'Delete image?',
        ];
    }

    public function getUsers() {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }
    
    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    public function getStatus()
    {
        return $this->hasMany(OrderStatus::className(), ['value' => 'status_id']);
    }
  
    
}

//$order = new Orders;
//$order->MasterToApplications();
