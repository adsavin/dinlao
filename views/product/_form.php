<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="product-form">
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
        <div class="column is-half">
            <?= $form->field($model, 'product_type_id', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList(
                \yii\helpers\ArrayHelper::map($productTypes, "id", "name")
            ) ?>
        </div>
        <div class="column is-half">
            <?= $form->field($model, 'doc_type_id', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList(\yii\helpers\ArrayHelper::map($docTypes, "id", "name")) ?>
        </div>
    </div>

    <?= $form->field($model, 'description')->textarea(['class'=>'input', 'rows' => 6]) ?>

    <div class="columns">
        <div class="column is-10">
            <?= $form->field($model, 'price')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-2">
            <?= $form->field($model, 'currency_id', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList(\yii\helpers\ArrayHelper::map($currencies, "id" ,"code")) ?>
        </div>
    </div>

    <div class="columns">
        <div class="column is-10">
            <?= $form->field($model, 'area')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-2">
            <?= $form->field($model, 'unit_id', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList(\yii\helpers\ArrayHelper::map(
                $units, "id", "code"
            )) ?>
        </div>
    </div>

    <div class="columns">
        <div class="column is-half">
    <?= $form->field($model, 'width')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-half">
    <?= $form->field($model, 'height')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
    </div>

    <div class="columns">
        <div class="column is-one-third">
    <?= $form->field($model, 'province_id', [
        'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
    ])->dropDownList(\yii\helpers\ArrayHelper::map($provinces, "id", "name")) ?>
        </div>
        <div class="column is-one-third">
    <?= $form->field($model, 'district_id', [
        'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
    ])->dropDownList([]) ?>
        </div>
        <div class="column is-one-third">
    <?= $form->field($model, 'village')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
    </div>

    <div class="columns">
        <div class="column is-half">
            <?= $form->field($model, 'lat')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-half">
            <?= $form->field($model, 'lon')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
    </div>

    <div class="columns">
        <div class="column is-one-third">
            <?= $form->field($model, 'tel')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'whatsapp')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'line')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
    </div>
    <div class="columns">
        <div class="column is-one-third">
            <?= $form->field($model, 'facebook')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'wechat')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'email')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'photo')->textInput(['class'=>'input', 'maxlength' => true]) ?>
    <?= $form->field($model, 'status', [
        'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
    ])->dropDownList([
        "A" => 'Available',
        "H" => 'Hide',
        "S" => 'Show',
    ]) ?>
    <div class="has-text-centered">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' =>'button is-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>