<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Picture */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="picture-form">
    <?php $form = ActiveForm::begin([
        'id' => 'form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"column is-12\">{label}\n{input}\n{error}</div>",
            'horizontalCssClasses' => [
                'error' => 'help is-danger',
            ],
        ],
        'errorCssClass' => 'is-danger'
    ]); ?>
    <?= $form->field($model, 'filename')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'product_id')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'button is-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>