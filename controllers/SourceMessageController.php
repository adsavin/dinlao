<?php

namespace app\controllers;

use app\models\Message;
use Yii;
use app\models\SourceMessage;
use app\models\SourceMessageSearch;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SourceMessageController implements the CRUD actions for SourceMessage model.
 */
class SourceMessageController extends Controller
{
    public $layout = "home";

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if(Yii::$app->language != Yii::$app->session->get("lang") ) {
            Yii::$app->language = Yii::$app->session->get("lang");
        }

        if(!isset(Yii::$app->user->identity) && isset(Yii::$app->session['user'])) {
            Yii::$app->user->login(Yii::$app->session['user']);
        } else {
            Yii::$app->user->logout();
            return $this->redirect(["site/login"]);
        }
    }

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
     * Lists all SourceMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SourceMessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SourceMessage model.
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
     * Creates a new SourceMessage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SourceMessage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SourceMessage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(isset($model->messages))
            if(count($model->messages) > 0) {
                $model->translation = $model->messages[0]->translation;
            }

        if ($model->load(Yii::$app->request->post())) {
            $connection = Yii::$app->db->beginTransaction();
            try {
                if(!$model->save())
                    throw new Exception(Yii::t('app', json_encode($model->errors)));
                $message = Message::findOne($model->id);
                if(!isset($message)) {
                    $message = new Message();
                    $message->id = $model->id;
                }
                $post = Yii::$app->request->post("SourceMessage");
                $message->translation = $post["translation"];
                $message->language = "la-LA";
                if(!$message->save())
                    throw new Exception(Yii::t('app', json_encode($model->errors)));
                $connection->commit();
                return $this->redirect(['index']);
            } catch (Exception $ex) {
                $connection->rollBack();
                Yii::$app->session->setFlash("danger", json_encode($ex->getMessage()));
                return $this->redirect(["source-message/update", "id" => $id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SourceMessage model.
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
     * Finds the SourceMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SourceMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SourceMessage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
