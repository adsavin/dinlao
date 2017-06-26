<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Province */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Province',
]) . $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="province-update">

    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
