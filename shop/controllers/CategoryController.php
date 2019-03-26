<?php

namespace app\controllers;
use app\models\Category;
use app\models\Products;
use Yii;

class CategoryController extends AppController {

    public function actionView($id)
    {
        $id = Yii::$app->request->get('id');
        $products = Products::find()->where(['category_id'=>$id])->all();
//        debug($products);die;
        return $this->render('view', compact('products'));
    }
}