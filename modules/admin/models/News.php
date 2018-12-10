<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property string $date_added
 * @property string $image
 */
class News extends \yii\db\ActiveRecord
{
    public $imageFile;
    public $gallery;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

     public function behaviors()
    {
        return [
            'imageFile' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }
    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
           // [['title', 'description', 'image'], 'required'],
            [['description'], 'string'],
            [['date_added','title', 'description','imageFile'], 'safe'],
            [['title'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
           // [['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'description' => 'Текст',
            'date_added' => 'Дата добавления',
            'imageFile' => 'Изображение',
        ];
    }
    
    public function upload(){
          
        if($this->validate()){
            $path = 'upload/store/'.$this->imageFile->baseName.'.'.$this->imageFile->extension;
            $this->imageFile->saveAs($path,true);
            $this->attachImage($path);
           // unlink($path);
            return true;
        } else {
            return false;
        }
    }
}
