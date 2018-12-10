<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property string $id
 * @property string $username
 * @property string $userfamily
 * @property string $avatar
 * @property string $phone
 * @property string $desc
 * @property string $city
 * @property string $email
 * @property string $birthday
 * @property string $street
 * @property string $hourse
 * @property string $password
 * @property integer $type
 * @property integer $verificated
 * @property integer $ban
 * @property string $auth_key
 *
 * @property MasterToCategory[] $masterToCategories
 * @property MasterToPackade[] $masterToPackades
 * @property Orders[] $orders
 * @property Reviews[] $reviews
 * @property Reviews[] $reviews0
 */
class Users extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['username', 'userfamily', 'avatar', 'phone', 'desc', 'city', 'email', 'birthday', 'street', 'hourse', 'password', 'type', 'verificated', 'ban', 'auth_key'], 'required'],
            [['desc'], 'string'],
            [['birthday', 'type', 'verificated', 'ban'], 'integer'],
            [['username', 'userfamily', 'avatar', 'phone', 'city', 'email', 'street', 'hourse', 'password', 'auth_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [

            'id' => 'ID',
            'username' => 'Имя',
            'userfamily' => 'Фамилия',
            'avatar' => 'Фото',
            'phone' => 'Телефон',
            'desc' => 'Навыки',
            'city' => 'Город',
            'email' => 'Email',
            'birthday' => 'Дата рождения',
            'street' => 'Улица',
            'hourse' => 'Дом',
            'password' => 'Пароль',
            'type' => 'Type',
            'verificated' => 'Верификация',
            'auth_key' => 'Auth Key',
            'ban' => 'Ban',
            'auth_key' => 'Auth Key',
        ];
    }
      public function behaviors()
    {
        return [
            'avatar' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasterToCategories() {
        return $this->hasMany(MasterToCategory::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMasterToPackades() {
        return $this->hasMany(MasterToPackade::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders() {
        return $this->hasMany(Orders::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews() {
        return $this->hasMany(Reviews::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReviews0() {
        return $this->hasMany(Reviews::className(), ['master_id' => 'id']);
    }
    
   
}
