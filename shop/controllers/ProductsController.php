<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Products;

class ProductsController extends Controller
{
    public function actionIndex()
    {
        $model = Products::find()->all();
        return $this->render('index',['model'=>$model]);
    }

}
