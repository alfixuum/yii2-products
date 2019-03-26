<?php

namespace app\models;


use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class ImageUpload extends Model{


    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png']
        ];
    }


    public function uploadFile(UploadedFile $file)
    {
        $this->image = $file;

        if ($this->validate())
        {

            $filename = strtolower(md5(uniqid($file->baseName)) . '.' . $file->extension);

            $file->saveAs($this->getFolder() . $filename);

            return $filename;
        }
    }

    public function getFolder()
    {
        return Yii::getAlias('@web') . 'uploads/';
    }

    public function deleteCurrentImages($currentImage)
    {
        if (file_exists($this->getFolder() . $currentImage ))
        {
            unlink($this->getFolder(). $currentImage);
        }
    }

    public function fileExists($currentImage)
    {
        return file_exists($this->getFolder(). $currentImage);
    }
}
