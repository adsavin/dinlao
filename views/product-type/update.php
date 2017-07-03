<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Product Type',
]) . (Yii::$app->language == "la-LA"?$model->namelao:$model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (Yii::$app->language == "la-LA"?$model->namelao:$model->name), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="product-type-update">

    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
