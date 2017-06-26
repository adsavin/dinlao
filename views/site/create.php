<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $code == "L"? Yii::t('app', 'Post New Land') : Yii::t('app', 'Post New House');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">
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
