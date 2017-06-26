<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\DocType */

$this->title = Yii::t('app', 'Add Doc Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Doc Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="doc-type-create">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
