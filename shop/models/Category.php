<?php

namespace app\models;

use Yii;


class Category extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'category';
    }


    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    public function getProducts()
    {
        return $this->hasMany(Products::className(),['category_id' => 'id']);
    }
}
