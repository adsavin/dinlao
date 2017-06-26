<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Menu */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Menu',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->label, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="menu-update">

    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
