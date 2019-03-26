<?php

namespace app\controllers;
use app\models\Category;
use app\models\Products;
use Yii;

class ProductController extends AppController
{

    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');

        $product = Products::findOne($id);
//        $product = Products::find()->witch('category')->where(['id' => $id)]);
        return $this->render('view', compact('product'));
    }
}