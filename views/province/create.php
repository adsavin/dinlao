<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Province */

$this->title = Yii::t('app', 'Add Province');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="province-create">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
