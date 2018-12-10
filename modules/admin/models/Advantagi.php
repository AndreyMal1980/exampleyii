<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "advantagi".
 *
 * @property string $id
 * @property string $image
 * @property string $description
 */
class Advantagi extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $gallery;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'advantagi';
    }

    /**
     * @inheritdoc
     */
     public function behaviors()
    {
        return [
            'imageFile' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
    
    public function rules()
    {
        return [
           // [['imageFile', 'description'], 'required'],
            [['description'], 'string'],
             [['description','imageFile'], 'safe'],
           // [['image'], 'string', 'max' => 255],
             [['imageFile'], 'file', 'extensions' => 'png, jpg'],
            //[['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'imageFile' => 'Изображение',
            'description' => 'Преимущество',
        ];
    }
     public function upload(){
       
        if($this->validate()){
            $path = 'upload/store/'.$this->imageFile->baseName.'.'.$this->imageFile->extension;
            $this->imageFile->saveAs($path);
            $this->attachImage($path,true);
            unlink($path);
           
            return true;
        } else {
            return false;
        }
    }
    
}
