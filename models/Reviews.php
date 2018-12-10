<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "reviews".
 *
 * @property string $id
 * @property string $autor
 * @property string $user_id
 * @property string $master_id
 * @property string $date_added
 * @property string $review
 * @property string $answer
 *
 * @property Users $user
 * @property Users $master
 */
class Reviews extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['autor',  'review'], 'required'],
            [['user_id', 'master_id', 'date_added'], 'integer'],
            [['review', 'answer'], 'string'],
            [['autor'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['master_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['master_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'autor' => 'Autor',
            'user_id' => 'User ID',
            'master_id' => 'Master ID',
            'date_added' => 'Date Added',
            'review' => 'Review',
            'answer' => 'Answer',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaster()
    {
        return $this->hasOne(Users::className(), ['id' => 'master_id']);
    }
}
