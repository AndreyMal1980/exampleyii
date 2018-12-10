<?php

namespace app\models;

use yii\db\ActiveRecord;

class User extends ActiveRecord implements \yii\web\IdentityInterface {

    public $auth_key = true;
    public $birthday_day;
    public $birthday_month;
    public $birthday_year;
    public $avatar;
    public $gallery;

    public static function tableName() {
        return 'users';
    }

   

    public function upload() {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->avatar->baseName . '.' . $this->avatar->extension;
            $this->avatar->saveAs($path);
            $this->attachImage($path);
            unlink($path);
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            // [['username', 'password', 'city', 'phone', 'email'], 'required', 'message' => 'Поле обязательно для заполнения'],
            [['username','userfamily', 'password','avatar','type','auth_key', 'city', 'phone', 'email', 'type','birthday','desc','street','hourse'], 'safe'],
            [['image'], 'file', 'extensions' => 'png, jpg'],
           // ['email', 'unique','message'=> 'Данный E-mail уже занят'],
          //  ['phone', 'unique','message'=> 'Данный телефон уже занят'],

                // rememberMe must be a boolean value
                //['rememberMe', 'boolean'],
                // ['email' => 'email'],
                // ['email', 'unique'],
                // ['phone', 'unique'],
                // password is validated by validatePassword()
                // ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return[
            'username' => 'Имя',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'city' => 'Город',
            'password' => 'Пароль',
            'auth_key' => 'Запомнить меня'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        //return static::findOne(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($email, $phone) {
        return static::findOne(['email' => $email, 'phone' => $phone]);
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {

        return $this->password === $password;
        //return \Yii::$app->security->validatePassword($password, $this->password);
    }

    public function getOrders() {
        return $this->hasMany(Orders::className(), ['id' => 'id']);
    }

    public function setPassword($password) {
        // $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = \Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }

    public static function getTypeUser($user_id) {
        $type = User::findBySql("SELECT type FROM `users` WHERE id = " . (int) ($user_id))->one();
        return $type->type;
    }

      public function behaviors()
    {
        return [
            'avatar' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
}
