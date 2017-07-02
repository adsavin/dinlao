<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app','Register');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="hero is-primary" style="margin-bottom: 50px;padding-top: 4rem">
    <div class="hero-body">
        <div class="container">
            <h1 class="title has-text-right is-5-mobile"><?= Yii::$app->params["domain"] ?></h1>
            <h1 class="subtitle has-text-right">
                <?= Yii::t("app","Properties Advertisement") ?><br />
                <?= Yii::t('app', 'Where buyers & sellers meet') ?> <br />
                <a href="index.php?r=site/about" class="button"><?= Yii::t('app','What we do') ?></a>
            </h1>
        </div>
    </div>
</div>
<div class="container">
    <div class="columns">
        <div class="column is-6 is-6 is-offset-3 has-text-centered">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'options' => [
                    'class' => 'box',
                ],
                'fieldConfig' => [
                    'template' => "<div class=\"column is-12 has-text-centered\">{label}\n{input}\n{error}</div>",
                    'horizontalCssClasses' => [
                        'error' => 'help is-danger',
                    ],
                ],
                'errorCssClass' => 'is-danger'
            ]); ?>
            <p class="title"><?= Html::encode($this->title) ?></p>
            <p class="subtitle"><?= Yii::t('app', 'Please fill out the following fields to register') ?></p>
            <?= $form->field($model, 'email')->textInput(['class' => 'input has-text-centered', 'placeholder' => Yii::t('app','Email')]) ?>
            <?= $form->field($model, 'password')->passwordInput(['class' => 'input has-text-centered', 'placeholder' => Yii::t('app', 'Password')]) ?>
            <?= $form->field($model, 'confirmpassword')->passwordInput(['class' => 'input has-text-centered', 'placeholder' => Yii::t('app', 'Confirm Password')]) ?>
            <?= $form->field($model, 'firstname')->textInput(['class' => 'input has-text-centered', 'placeholder' => Yii::t('app','Firstname')]) ?>
            <?= $form->field($model, 'lastname')->textInput(['class' => 'input has-text-centered', 'placeholder' => Yii::t('app','Lastname')]) ?>
<!--            I'm not robot-->
            <div class="column is-12">
                <?= Html::submitButton(Yii::t('app','Register'), ['class' => 'button is-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
