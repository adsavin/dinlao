<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SourceMessage */

$this->title = $model->message;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Source Messages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="source-message-view">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'button is-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'button is-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'category',
            'message:ntext',
        ],
    ]) ?>
    <h1 class="subtitle is-3"><?= Yii::t('app', 'Translations') ?></h1>
    <table class="table">
        <thead>
        <tr>
            <th><?= Yii::t('app', 'Language') ?></th>
            <th><?= Yii::t('app', 'Translation') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($model->messages as $message): ?>
        <tr>
            <td><?= $message->language ?></td>
            <td><?= $message->translation ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
