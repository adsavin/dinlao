<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SourceMessage */

$this->title = Yii::t('app', 'Add Source Message');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Source Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-create">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
