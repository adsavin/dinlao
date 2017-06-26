<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="menu-form">

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

    <div class="columns">
        <div class="column is-6">
            <?= $form->field($model, 'parent', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList([
                "Favorite" => Yii::t("app", "Favorite"),
                "Profile" => Yii::t("app", "Profile"),
                "Web Master" => Yii::t("app", "Web Master"),
                "Administration" => Yii::t("app", "Administration"),
            ]) ?>
        </div>
        <div class="column is-3">
            <?= $form->field($model, 'role', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList([
                    "*" => Yii::t("app", "All"),
                    "A" => Yii::t("app", "Admin Only"),
                    "M" => Yii::t("app", "Member Only"),
                    "U" => Yii::t("app", "User Only"),
            ]) ?>
        </div>
    </div>
    <?= $form->field($model, 'label')->textInput(['maxlength' => true, 'class' => 'input']) ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'class' => 'input']) ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'button is-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
