<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProvinceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'My Post');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="province-index">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="is-fullwidth text-right pull-right">
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('app', 'Add'), ['create'], ['class' => 'button is-primary']) ?>
    </p>
    <?php
    Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'village',
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'price',
                'format' => 'html',
                'value' => function($data) {
                    return "<p class='has-text-right'>".number_format($data->price)."</p>";
                },
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'area',
                'header' => Yii::t('app', 'Area'),
                'format' => 'html',
                'value' => function($data) {
                    return Yii::t('app', '{a} {u}<sup>2</sup> ({w}{u} x {h}{u})', [
                        'w' => number_format($data->width),
                        'a' => number_format($data->area),
                        'u' => $data->unit->code,
                        'h' => number_format($data->height)
                    ]);
                },
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data) {
                    switch ($data->status) {
                        case "A":
                            return "<p class='has-text-centered'><span class='tag is-primary'>".Yii::t('app', 'Active')."</span></p>";
                        case "H":
                            return "<p class='has-text-centered'><span class='tag is-warning'>".Yii::t('app', 'Hidden')."</span></p>";

                    }
                },
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'label' => Yii::t('app', 'Actions'),
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a("<i class='fa fa-search'></i>", ["view", "id" => $data->id], ["class" => "is-info"])
                        ." " .Html::a("<i class='fa fa-pencil'></i>", ["update", "id" => $data->id], ["class" => "is-primary"])
                        ." " .Html::a("<i class='fa fa-trash is-danger'></i>", ["delete", "id" => $data->id], ["class" => "is-danger"]);
                }
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
