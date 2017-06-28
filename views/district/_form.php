<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\District */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="district-form">
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
    <?= $form->field($model, 'namelao')->textInput(['class'=>'input', 'maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['class'=>'input', 'maxlength' => true]) ?>
    <?= $form->field($model, 'province_id', [
        'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
    ])
        ->dropDownList(\yii\helpers\ArrayHelper::map($provinces, "id", "name"), ["wraperClass" => "select"]) ?>
    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'button is-primary']) ?>
    <?php ActiveForm::end(); ?>
</div>
