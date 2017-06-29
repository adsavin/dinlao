<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = Yii::t('app','Sign In');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hero is-primary" style="margin-bottom: 50px;padding-top: 4rem">
    <div class="hero-body">
        <div class="container">
            <h1 class="title has-text-right">
                DINLAO.COM - Properties Advertisement
            </h1>
            <h1 class="subtitle has-text-right">
                Where you buy & sell the land & house <br /><a class="button"><?= Yii::t('app','What we do') ?></a>
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
//                 'template' => "<div class=\"column is-12\">{input}</div>\n<div class=\"column is-12 help is-danger\">{error}</div>",
                    'template' => "<div class=\"column is-12 has-text-centered\">{label}\n{input}\n{error}</div>",
                    'horizontalCssClasses' => [
                        'error' => 'help is-danger',
                    ],
                ],
                'errorCssClass' => 'is-danger'
            ]); ?>
            <p class="title has-text-centered"><?= Yii::t('app', 'Sign in by facebook') ?></p>
            <a class="button is-primary is-fullwidth" href="index.php?r=site%2Fauth&amp;authclient=facebook" title="Facebook" data-popup-width="860" data-popup-height="480">
                <i class="fa fa-facebook"></i>
<!--                --><?//= Yii::t('app', 'Sign In') ?>
            </a>
            <hr/>
            <p class="title"><?= Html::encode($this->title) ?></p>
            <p class="subtitle">Please fill out the following fields to sign in:</p>
            <?= $form->field($model, 'email')->textInput(['class' => 'input has-text-centered', 'placeholder' => Yii::t('app','Email')]) ?>
            <?= $form->field($model, 'password')->passwordInput(['class' => 'input has-text-centered', 'placeholder' => Yii::t('app', 'Password')]) ?>
            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"column is-12\">{input} {label}</div>\n<div class=\"is-8\">{error}</div>",
            ]) ?>
            <div class="column is-12">
                <?= Html::submitButton(Yii::t('app','Sign In'), ['class' => 'button is-primary', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
