<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SourceMessage */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="source-message-form">

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
    <?= $form->field($model, 'message')->textInput(['class' => 'input']) ?>
    <?= $form->field($model, 'translation')->textInput(['class' => 'input']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'button is-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
