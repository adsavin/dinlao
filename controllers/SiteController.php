<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\Currency;
use app\models\District;
use app\models\DocType;
use app\models\LoginForm;
use app\models\Menu;
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

    public function actionView($id) {
        $model = $this->findProduct($id);
        $this->layout = "view";
        return $this->render("viewLand", ['model' => $model]);
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

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub

        if(Yii::$app->language != Yii::$app->session->get("lang") ) {
            Yii::$app->language = Yii::$app->session->get("lang");
        }
    }

    public function actionChangelang() {
        if(Yii::$app->language == "en-US") {
            Yii::$app->language = "la-LA";
        } else {
            Yii::$app->language = "en-US";
        }
        Yii::$app->session->set("lang", Yii::$app->language);
        return $this->goBack();
    }
}
