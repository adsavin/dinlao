<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::t('app', 'Change Password');
$this->params['breadcrumbs'][] = Yii::t('app', 'Change Password');
?>
<div class="user-update">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>

    <div class="user-form">
        <?php
        $form = ActiveForm::begin([
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

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true, 'class' => 'input']) ?>
                <?= $form->field($model, 'newpassword')->passwordInput(['maxlength' => true, 'class' => 'input']) ?>
                <?= $form->field($model, 'confirmpassword')->passwordInput(['maxlength' => true, 'class' => 'input']) ?>
                <div class="has-text-centered">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'button is-primary']) ?>
                </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#addphoto').click(function() {
            $('#user-picturefile').click();
        });

        $('#user-picturefile').change(function() {
            previewImage(this, $('#previewphoto'));
        });
    })

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