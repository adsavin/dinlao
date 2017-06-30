<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-search">
    <p class="subtitle"><?= Yii::t('app', 'Custom filter to search by your wants') ?></p>
    <?php $form = ActiveForm::begin([
        'action' => ['viewall'],
        'method' => 'get',
        'options' => [
                'class' => 'box'
        ]
    ]); ?>

    <div class="columns">
        <div class="column">
            <?= $form->field($model, 'currency_id', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList(\yii\helpers\ArrayHelper::map($currencies, 'id', 'code'))?>
        </div>
        <div class="column">
            <?= $form->field($model, 'pricemin')->textInput([
                "class" => "input"
            ]) ?>
        </div>
        <div class="column">
            <?= $form->field($model, 'pricemax')->textInput([
                "class" => "input"
            ]) ?>
        </div>
    </div>
<!--    -->
<!--    <div class="columns">-->
<!--        <div class="column">-->
<!--            --><?php // echo $form->field($model, 'province_id', [
//                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
//            ])
//                ->dropDownList(\yii\helpers\ArrayHelper::map($provinces, "id", Yii::$app->language=="la-LA"?"namelao":"name")) ?>
<!--        </div>-->
<!--        <div class="column">-->
<!--            --><?php // echo $form->field($model, 'district_id', [
//                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
//            ])->dropDownList([]) ?>
<!--        </div>-->
<!--        <div class="column">-->
<!--            --><?//= $form->field($model, 'village')->textInput(["class" => 'input']) ?>
<!--        </div>-->
<!--    </div>-->

    <?php // echo $form->field($model, 'product_type_id') ?>
    <?php  echo $form->field($model, 'doc_type_id', [
        'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
    ])->dropDownList(\yii\helpers\ArrayHelper::map($docTypes, "id", Yii::$app->language == "la-LA"?"namelao":"name")) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'button is-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'button is-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
