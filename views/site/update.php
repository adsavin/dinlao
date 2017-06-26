<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-update">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'docTypes' => $docTypes,
        'currencies' => $currencies,
        'provinces' => $provinces,
        'districts' => $districts,
        'units' => $units
    ]) ?>

</div>
