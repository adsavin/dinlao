<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Province */

$this->title = $model->code;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provinces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="province-view">
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
            'code',
            'name',
            'namelao',
        ],
    ]) ?>

    <?php if(isset($model->districts)) ?>
    <?php if(count($model->districts) > 0): ?>
    <h2 class="subtitle"><?= Yii::t('app', 'Districts') ?></h2>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th style="width: 40%"><?= Yii::t('app', 'Lao Name') ?></th>
                <th style="width: 40%"><?= Yii::t('app', 'Name') ?></th>
                <th><?= Yii::t('app', 'View') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($model->districts as $key => $district): ?>
                <tr>
                    <td><?= $key +1; ?></td>
                    <td><?= $district->namelao?></td>
                    <td><?= $district->name?></td>
                    <td><a class="button is-primary is-outlined" href="index.php?r=district/view&id=<?= $district->id ?>">
                            <i class="fa fa-search"></i><?= Yii::t('app', "View") ?>
                        </a> </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
