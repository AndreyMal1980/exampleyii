<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "articles".
 *
 * @property string $id
 * @property string $title
 * @property string $slug
 * @property string $excerpt
 * @property string $description
 * @property string $image
 * @property string $date_added
 * @property string $date_modificate
 * @property integer $show
 */
class Articles extends \yii\db\ActiveRecord {

    public $imageFile;
    public $gallery;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'articles';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
           // [['title', 'slug', 'excerpt', 'description', 'imageFile', 'show'], 'required'],
            [['description'], 'string'],
            [['date_added', 'date_modificate', 'imageFile', 'title', 'slug', 'excerpt', 'description', 'show'], 'safe'],
            [['show'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['slug', 'excerpt'], 'string', 'max' => 255],
            [['imageFile'], 'file', 'extensions' => 'png, jpg'],
            //[['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    public function behaviors() {
        return [
            'imageFile' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'slug' => 'Слаг',
            'excerpt' => 'Цитата',
            'description' => 'Содержание',
            'imageFile' => 'Картинка',
            'date_added' => 'Добавлена..',
            'date_modificate' => 'Изменена..',
            'show' => 'Show',
        ];
    }

    public function upload() {
        if ($this->validate()) {
            $path = 'upload/store/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            $this->imageFile->saveAs($path,true);
            $this->attachImage($path,true);
            unlink($path);
            return true;
        } else {
            return false;
        }
    }

}
