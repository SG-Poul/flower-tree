<?php

namespace app\modules\product\controllers;

use Yii;
use app\modules\product\models\Products;
use app\modules\product\models\Category;
use app\modules\product\models\ProductsSearch;
use app\modules\product\models\ImageUploader;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritdoc
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

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $categories = [];
        $categoriesName = [];
        foreach (Category::find()->asArray()->indexBy('id')->all() as $item) {
            $categories[$item['id']] = $item['name'];
            $categoriesName[$item['name']] = $item['name'];
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'categoriesName' => $categoriesName,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();
        $uploadModel = new ImageUploader();

        $categories = [];
        foreach (Category::find()->asArray()->indexBy('id')->all() as $item) {
            $categories[$item['id']] = $item['name'];
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $uploadModel->uploadedFiles = UploadedFile::getInstances($uploadModel, 'uploadedFiles');
            if ($uploadModel->upload($model->id)) {
                return $this->redirect('index');
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'uploadModel' => $uploadModel,
                'categories' => $categories
            ]);
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $uploadModel = new ImageUploader();

        $categories = [];
        foreach (Category::find()->asArray()->indexBy('id')->all() as $item) {
            $categories[$item['id']] = $item['name'];
        }

        $images = $uploadModel->getProductImages($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $uploadModel->uploadedFiles = UploadedFile::getInstances($uploadModel, 'uploadedFiles');
            if ($uploadModel->upload($model->id)) {
                return $this->redirect(['update', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
                'uploadModel' => $uploadModel,
                'categories' => $categories,
                'images'=> $images,
            ]);
        }
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $model = new ImageUploader();
        $model->deleteAllImages($id);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionDeleteimg()
    {
        $imageName = Yii::$app->request->post('imageName');
        $model = new ImageUploader();
        $model->deleteImage($imageName);
    }

    public function actionSetimg()
    {
        $imageName = Yii::$app->request->post('imageName');
        $model = new ImageUploader();
        $model->setMain($imageName);
    }
}
