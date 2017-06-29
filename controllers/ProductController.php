<?php

namespace app\controllers;

use app\models\Currency;
use app\models\District;
use app\models\DocType;
use app\models\Picture;
use app\models\Product;
use app\models\ProductSearch;
use app\models\ProductType;
use app\models\Province;
use app\models\Unit;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    public $layout = "home";

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

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if(Yii::$app->language != Yii::$app->session->get("lang") ) {
            Yii::$app->language = Yii::$app->session->get("lang");
        }

        if(!isset(Yii::$app->user->identity) && isset(Yii::$app->session['user'])) {
            Yii::$app->user->login(Yii::$app->session['user']);
        }
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        if($model->user_id != Yii::$app->user->identity->getId()) {
            Yii::$app->session->setFlash('danger', Yii::t('app', "Permission denied"));
            return $this->redirect(["product/mypost"]);
        }
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($code) {
        if(!in_array($code, ["L", "H"])) {
            Yii::$app->session->setFlash("danger", Yii::t("app", "Not Found!"));
            return $this->redirect(["site/home"]);
        }

        $type = ProductType::find()->where(["code" => "L"])->one();
        $model = new Product();
        if(isset($type)) {
            $model->product_type_id = $type->id;
        }

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            $filename = "";
            $filenames = [];
            try {
                $user = Yii::$app->session->get("user");
                $model->user_id = $user->id;
                $model->created_date = date("Y-m-d H:i:s");
                $model->photofile = UploadedFile::getInstance($model, "photofile");
                if(isset($model->photofile)) {
                    $model->photo = date("YmdHis") . rand(100, 999) . "." . $model->photofile->extension;
                    if(!$model->save()) {
                        throw new Exception(json_encode($model->errors));
                    }
                    $filename = "upload/photo/" . $model->photo;
                    if (!file_exists($filename))
                        if (!$model->photofile->saveAs($filename)) {
                            throw new Exception(Yii::t("app", "Cannot Upload Photo " . $model->photofile->error));
                        }
                }

                $model->photofiles = UploadedFile::getInstances($model, "photofiles");
                if(isset($model->photofiles))
                    foreach ($model->photofiles as $file) {
                        if(!isset($file)) continue;
                        $photo = new Picture();
                        $photo->product_id = $model->id;
                        $photo->filename = date("YmdHis"). rand(100, 999) . ".".$file->extension;
                        if(!$photo->save())
                            throw new Exception(Yii::t("app", "Cannot Save Photo Record ". json_encode($photo->errors)));
                        $filename = "upload/photo/".$photo->filename;
                        $filenames[] = $filename;
                        if(!file_exists($filename))
                            if(!$file->saveAs($filename))
                                throw new Exception(Yii::t("app", "Cannot Upload Photo ". $file->error));
                    }

                $transaction->commit();
                Yii::$app->session->setFlash("success", Yii::t("app", "Successful"));
                return $this->redirect(["product/view", "id" => $model->id]);
            } catch (Exception $ex) {
                $transaction->rollback();
                try {
                    if($filename != "" && file_exists($filename))
                        unlink($filename);
                } catch (Exception $ex) {

                }
                foreach ($filenames as $fn) {
                    try{
                        if($fn != "" && file_exists($fn))
                            unlink($fn);
                    } catch (Exception $ex) {
                    }
                }
                Yii::$app->session->setFlash("danger", $ex->getMessage());
            }
        }

        $this->layout = "home";
        $provinces = Province::find()->orderBy(['id'=> "asc"])->asArray()->all();
        $districts = count($provinces)>0? District::find()->where(["province_id" => $provinces[0]["id"]])->asArray()->all():[];
        return $this->render("create", [
            "model" => $model,
            'code' => $code,
            'docTypes' => DocType::find()->all(),
            'currencies' => Currency::find()->all(),
            'provinces' => $provinces,
            'districts' => $districts,
            'units' => Unit::find()->all()
        ]);
    }

    public function actionUpdate($id) {
        $model = $this->findModel($id);
        if(!isset($model)) {
            Yii::$app->session->setFlash("warning", Yii::t("app", "Not Found"));
            return $this->redirect(["product/mypost"]);
        }
        $user = Yii::$app->session->get('user');
        if($model->user_id != $user->id) {
            Yii::$app->session->setFlash("warning", Yii::t("app", "Permission denied!"));
            return $this->redirect(["product/mypost"]);
        }

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            $filename = "";
            $filenames = [];
            try {
                $photo = UploadedFile::getInstance($model, "photofile");
                if(isset($photo)) {
                    $model->photo = date("YmdHis") . rand(100, 999) . "." . $photo->extension;
                    $filename = "upload/photo/" . $model->photo;
                    if (!file_exists($filename))
                        if (!$photo->saveAs($filename))
                            throw new Exception(Yii::t("app", "Cannot Upload Photo " . $photo->error));
                }

                if(!$model->save())
                    throw new Exception(json_encode($model->errors));

                $photos = UploadedFile::getInstances($model, "photofiles");
                if(isset($photos)) {
                    foreach ($photos as $key => $photo) {
                        if(!isset($photo)) continue;
                        if(isset($model->pictures[$key])) {
                            $f = "upload/photo/".$model->pictures[$key]->filename;
                            if(file_exists($f)) {
                                unset($f);
                            }
                            Picture::deleteAll(['filename' => $model->pictures[$key]->filename, 'product_id' => $model->pictures[$key]->product_id]);
                        }
                        $newphoto = new Picture();
                        $newphoto->product_id = $model->id;
                        $newphoto->filename = date("YmdHis"). rand(100, 999) . "." . $photo->extension;
                        if(!$newphoto->save())
                            throw new Exception(Yii::t("app", "Cannot Save Photo Record ". json_encode($photo->errors)));
                        $filename = "upload/photo/".$newphoto->filename;
                        $filenames[] = $filename;
                        if(!file_exists($filename))
                            if(!$photo->saveAs($filename))
                                throw new Exception(Yii::t("app", "Cannot Upload Photo ". $photo->error));
                    }
                }


                $transaction->commit();
                Yii::$app->session->setFlash("success", Yii::t("app", "Successful"));
                return $this->redirect(["product/view", "id" => $model->id]);
            } catch (Exception $ex) {
                $transaction->rollback();
                try {
                    if($filename != "" && file_exists($filename))
                        unlink($filename);
                } catch (Exception $ex) {

                }
                foreach ($filenames as $fn) {
                    try{
                        if($fn != "" && file_exists($fn))
                            unlink($fn);
                    } catch (Exception $ex) {
                    }
                }
                Yii::$app->session->setFlash("danger", $ex->getMessage());
            }
        }

        $this->layout = "home";
        $provinces = Province::find()->orderBy(['id'=> "asc"])->asArray()->all();
        $districts = count($provinces)>0? District::find()->where(["province_id" => $provinces[0]["id"]])->asArray()->all():[];
        return $this->render("update", [
            "model" => $model,
            'code' => $model->productType->code,
            'docTypes' => DocType::find()->all(),
            'currencies' => Currency::find()->all(),
            'provinces' => $provinces,
            'districts' => $districts,
            'units' => Unit::find()->all()
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionMypost() {
        $searchModel = new ProductSearch();
        $searchModel->user_id = Yii::$app->user->identity->getId();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->layout = "home";
        return $this->render('mypost', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
