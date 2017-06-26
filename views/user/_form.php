<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="user-form">
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
    <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'class' => 'input']) ?>
    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'class' => 'input']) ?>
    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'class' => 'input']) ?>
    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'class' => 'input']) ?>
    <?= $form->field($model, 'birthdate')->textInput(['class' => 'input']) ?>
    <?= $form->field($model, 'picture')->fileInput(['class' => 'input']) ?>
    <div class="columns">
        <div class="column is-half">
            <?= $form->field($model, 'status', [
                'inputTemplate' => '<p class="control is-fullwidth"><span class="select is-fullwidth">{input}</span></p>',
            ])->dropDownList([
                "A" => "Active",
                "D" => "Disabled",
            ]) ?>
        </div>
        <div class="column is-half">
            <?= $form->field($model, 'role', [
                'inputTemplate' => '<p class="control is-fullwidth"><span class="select is-fullwidth">{input}</span></p>',
            ])->dropDownList([
                "A" => "Admin",
                "M" => "Member",
                "U" => "User"
            ]) ?>
        </div>
    </div>
    <div class="has-text-centered">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'button is-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
