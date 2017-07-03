<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DocType */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Doc Type',
]) . (Yii::$app->language == "la-LA"?$model->namelao:$model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Doc Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Yii::$app->language == "la-LA"?$model->namelao:$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="doc-type-update">

    <h1 class="title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
