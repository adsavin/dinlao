<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductType */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-type-form">
    <?php
    $form = \yii\bootstrap\ActiveForm::begin([
        'id' => 'form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "<div class=\"column is-12\">{label}\n{input}\n{error}</div>",
            'horizontalCssClasses' => [
                'error' => 'help is-danger',
            ],
        ],
        'errorCssClass' => 'is-danger'
    ]);
    ?>
    <?= $form->field($model, 'code')->textInput(['class'=>'input', 'maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['class'=>'input', 'maxlength' => true]) ?>
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'button is-primary']) ?>
    <?php ActiveForm::end(); ?>

</div>
