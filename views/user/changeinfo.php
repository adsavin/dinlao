<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::t('app', 'Change User Information');
$this->params['breadcrumbs'][] = Yii::t('app', 'Change Info');
?>
<div class="user-update">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>

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

        <div class="columns">
            <div class="column is-one-third">
                <?= $form->field($model, 'picturefile')->fileInput(['class'=>'is-hidden','accept' => 'image/*'])->label(false) ?>
                <button type="button" class="button is-fullwidth" id="addphoto"><i class="fa fa-camera"></i> </button>
                <figure class="has-text-centered">
                    <img id="previewphoto" src="<?= isset($model->picture)?'upload/picture/'.$model->picture:'' ?>"/>
                </figure>
            </div>
            <div class="column is-two-third">
                <?= $form->field($model, 'firstname')->textInput(['maxlength' => true, 'class' => 'input']) ?>
                <?= $form->field($model, 'lastname')->textInput(['maxlength' => true, 'class' => 'input']) ?>
                <?= $form->field($model, 'birthdate')->textInput(['class' => 'input']) ?>
                <div class="has-text-centered">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'button is-primary']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#addphoto').click(function() {
            $('#user-picturefile').click();
        });

        $('#user-picturefile').change(function() {
            previewImage(this, $('#previewphoto'));
        });
    });

    function previewImage(input, $preview) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $preview.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>