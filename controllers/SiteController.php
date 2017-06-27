<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\Currency;
use app\models\District;
use app\models\DocType;
use app\models\LoginForm;
use app\models\Picture;
use app\models\Product;
use app\models\ProductType;
use app\models\Province;
use app\models\Unit;
use app\models\User;
use Yii;
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }

    public function onAuthSuccess($client)
    {
        try {
            $userAttributes = $client->getUserAttributes();
            $user = User::find()
                ->where(isset($userAttributes['email'])? ["email" => $userAttributes['email']] :["facebookid" => $userAttributes['id']] )
                ->one();
            if(!isset($user)) {
                $user = new User();
                $user->registerd_date = date("Y:m:d H:i:s");
                $user->password = $userAttributes["id"];
                $user->facebookid = $userAttributes["id"];
                $user->email = isset($userAttributes["email"])? $userAttributes["email"]:$userAttributes["id"];
                $user->status = "A";
            }
            $user->facebookname = $userAttributes["name"];
            $user->firstname = $userAttributes["first_name"];
            $user->lastname = $userAttributes["last_name"];
            $user->birthdate = date('Y-m-d H:i:s', strtotime($userAttributes["birthday"]));
            $user->role = "U";
            if(!$user->save()) {
                print_r($user->errors);
                exit;
            }
            $user->password = "";
            Yii::$app->user->login($user, 0);
            Yii::$app->session->set("username", $userAttributes["name"]);
            Yii::$app->session->set("user", $user);
            return $this->redirect(["home"]);
        } catch (Exception $ex) {
            Yii::error($ex);
            print_r($ex);
            exit;
        }
    }

    public function actionHome() {
        $this->layout = "home";
        return $this->render("home");
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $models = ProductType::find()->all();
        $this->layout = "index";
        return $this->render('index', [
            "models" => $models
        ]);
    }

    public function actionView($id) {
        $this->layout = "index";
        return $this->render("view", ['model' => $this->findProduct($id)]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest)
            return $this->goHome();

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login())
//            return $this->goBack();
            return $this->redirect(["home"]);
        $this->layout = "index";
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(["site/index"]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionViewland($id) {
        $model = $this->findProduct($id);
        $this->layout = "view";
        return $this->render("viewLand", ['model' => $model]);
    }

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
                $model->user_id=$user->id;
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

                $model->photofiles = UploadedFile::getInstance($model, "photofiles");
                if(isset($model->photofiles))
                    foreach ($model->photofiles as $file) {
                        if(!isset($file)) continue;
                        $photo = new Picture();
                        $photo->product_id = $model->id;
                        $photo->filename = date("YmdHis"). rand(100, 999) . ".".$file->extension;
                        $filename = "upload/photo/".$photo->filename;
                        $filenames[] = $filename;
                        if(!file_exists($filename))
                            if(!$file->saveAs($file))
                                throw new Exception(Yii::t("app", "Cannot Upload Photo ". $file->error));

                    }

                $transaction->commit();
                Yii::$app->session->setFlash("success", Yii::t("app", "Successful"));
                return $this->redirect(["site/view", "id" => $model->id]);
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
        $model = $this->findProduct($id);
        if(!isset($model)) {
            Yii::$app->session->setFlash("warning", Yii::t("app", "Not Found"));
            return $this->redirect(["site/home"]);
        }
        $provinces = Province::find()->orderBy(["id"])->asArray();
        $districts = count($provinces)>0? District::find()->where(["province_id" => $provinces[0]["id"]])->asArray():[];
        return $this->render("create", [
            "model" => $model,
            'code' => $model->productType->code,
            'docTypes' => DocType::find()->all(),
            'currencies' => Currency::find()->all(),
            'provinces' => $provinces,
            'districts' => $districts,
            'units' => Unit::find()->all()
        ]);
    }

    public function actionGetdistricts($province) {
        $models = District::find()->where(["province_id" => $province])->orderBy(["id" => "asc"])->asArray()->all();
        echo json_encode($models);
    }

    protected function findProduct($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
