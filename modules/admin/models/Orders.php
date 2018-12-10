<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property string $id
 * @property string $master_id
 * @property string $user_id
 * @property string $name_orders
 * @property string $description
 * @property string $date_added
 * @property string $date_reject_or_accept
 * @property string $date_close
 * @property string $foto
 * @property string $category_id
 * @property integer $status_id
 * @property string $email
 * @property string $username
 * @property string $phone
 * @property string $city
 *
 * @property Users $user
 * @property Categories $category
 * @property OrderStatus $status
 */
class Orders extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['master_id', 'name_orders', 'description', 'date_added', 'date_reject_or_accept', 'date_close', 'foto', 'category_id', 'email', 'username', 'phone', 'city'], 'required'],
            [['master_id', 'user_id', 'date_added', 'date_reject_or_accept', 'date_close', 'category_id', 'status_id'], 'integer'],
            [['description'], 'string'],
            [['name_orders', 'foto', 'email', 'username', 'phone', 'city'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::className(), 'targetAttribute' => ['status_id' => 'value']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'master_id' => 'Master ID',
            'user_id' => 'User ID',
            'name_orders' => 'Name Orders',
            'description' => 'Description',
            'date_added' => 'Date Added',
            'date_reject_or_accept' => 'Date Reject Or Accept',
            'date_close' => 'Date Close',
            'foto' => 'Foto',
            'category_id' => 'Category ID',
            'status_id' => 'Status ID',
            'email' => 'Email',
            'username' => 'Username',
            'phone' => 'Phone',
            'city' => 'City',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory() {
        return $this->hasMany(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatus() {
        return $this->hasOne(OrderStatus::className(), ['value' => 'status_id']);
    }

    public function getMaster() {
        return $this->hasOne(Users::className(), ['id' => 'master_id']);
    }

    public function MasterToApplications($user_id) {
        //echo $user_id;
        $applications_not_master = Orders::find()->asArray()->where(['status_id' => 5])->all();
        $application_reject = Orders::find()->asArray()->where(['status_id' => 4])->all();
        $application_no_accept = Orders::find()->asArray()->where(['status_id' => 0])->all();
        $applications_not_master_keys = [];
        $application_reject_keys = [];
        $application_no_accept_keys = [];
        $id1 = null;
        $id2 = null;
        foreach ($applications_not_master as $value) {
            $applications_not_master_keys[] = $value['id'];
        }
        if (!empty($applications_not_master_keys)) {

            for ($i = 0; $i < 1; $i++) {
                $id1 = $applications_not_master_keys[0];
                $id2 = $applications_not_master_keys[1];
                unset($applications_not_master_keys[0]);
                unset($applications_not_master_keys[1]);
            }

            /*  echo '<pre>';
              print_r($id1.$id2);
              echo '</pre>'; */
        }
        Orders::updateAll(['master_id' => $user_id, 'status_id' => 0], ['id' => [$id1, $id2]]);
        /*  echo '<pre>';
          print_r($applications_not_master_keys);
          echo '</pre>'; */
    }

}
