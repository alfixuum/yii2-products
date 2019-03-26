<?php

namespace app\modules\admin\controllers;

use app\models\Category;
use app\models\ImageUpload;
use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * {@inheritdoc}
     */


    public function behaviors()
    {

        return [
                'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $model->image = UploadedFile::getInstance($model, 'image');
            if ($model -> image){
               $model->upload();
            };
            unset($model->image);
            $model->gallery = UploadedFile::getInstances($model, 'gallery');
            $model->uploadGallery();

            Yii::$app->session->setFlash('success', "Товар {$model->title} обновлен");
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


//    public function actionSetImage($id)
//    {
//        $model = new ImageUpload;
//
//        if (Yii::$app->request->isPost)
//        {
//            $products = $this->findModel($id);
//            $file = UploadedFile::getInstance($model, 'image');
//
//            if ($products->saveImage($model->uploadFile($file))){
//                return $this->redirect(['view', 'id' =>$products->id]);
//            }
//        }
//
//        return $this->render('image', ['model'=>$model]);
//    }


    public function actionSetCategory($id)
    {

        $products = $this->findModel($id);
        $selectedCategory = $products->category->id;
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');

       if(Yii::$app->request->isPost)
       {
           $category = Yii::$app->request->post('category');
           if($products->saveCategory($category))
           {
               return $this->redirect(['view', 'id'=>$products->id]);
           }

       }


       return $this->render('category',[
           'products'=>$products,
           'selectedCategory'=>$selectedCategory,
           'categories'=>$categories
       ]);
    }
}
