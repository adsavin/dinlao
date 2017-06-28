<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->village;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <p class="has-text-right">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'button is-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'button is-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="columns">
        <div class="column is-12 has-text-centered">
            <h1 class="title"><?= $model->productType->name ?></h1>
            <figure class="is-fullwidth">
                <img class="is-fullwidth" src="upload/photo/<?= $model->photo ?>">
            </figure>
        </div>
    </div>

    <div class="columns">
        <div class="column is-10 is-offset-1 has-text-centered">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'price',
                        'value' => number_format($model->price, 2) ." ". $model->currency->code
                    ],
                    [
                        'attribute' => 'area',
                        'format' =>'raw',
                        'value' => number_format($model->area, 2) ." ".$model->unit->code."<sup>2</sup> (W: ".number_format($model->width, 2) .", H: ". number_format($model->height, 2).")",
                    ],
                    [
                        'attribute' => 'doc_type_id',
                        'value' => $model->docType->name
                    ],
                    'village',
                    [
                        'label' => Yii::t("app", "District"),
                        'value' => $model->district->name
                    ],
                    [
                        'label' => Yii::t("app", "Province"),
                        'value' => $model->district->province->name
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="columns">
        <div class="column is-10 is-offset-1">
            <?php
            $coor = new \dosamigos\google\maps\LatLng([
                'lat' => isset($model->lat) ? $model->lat : 17.96333505412437,
                'lng' => isset($model->lon) ? $model->lon : 102.60682459920645
            ]);
            $map = new \dosamigos\google\maps\Map([
                'center' => $coor,
                'zoom' => 12,
                'width' => '100%',
                'height' => '400',
                'mapTypeId' => 'hybrid'
            ]);
            if (isset($model->lat) && isset($model->lon)) {
                $marker = new \dosamigos\google\maps\overlays\Marker([
                    'position' => $coor,
                    'title' => $model->village,
                    'animation' => \dosamigos\google\maps\overlays\Animation::BOUNCE
                ]);

                // Provide a shared InfoWindow to the marker
                $marker->attachInfoWindow(
                    new \dosamigos\google\maps\overlays\InfoWindow([
                        'content' => '<p>' . $model->village . '</p>',
                    ])
                );
                $map->addOverlay($marker);
            }
            echo $map->display();
            ?>
        </div>
    </div>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'description:ntext',
            [
                'label' => Yii::t("app", "Contact"),
                'format' => 'html',
                'value' => (isset($model->tel)? "<p><i class='fa fa-phone'></i> ". $model->tel."</p> ":"").
                    ($model->whatsapp !=""? "<p><i class='fa fa-whatsapp'></i> ".$model->whatsapp ."</p>":"").
                    ($model->facebook !=""? "<p><i class='fa fa-facebook'></i> ".$model->facebook ."</p>":"").
                    ($model->wechat !=""? "<p><i class='fa fa-wechat'></i> ".$model->whatsapp ."</p>":"").
                    ($model->line !=""? "<p><i class='fa fa-line-chart'></i> ".$model->line ."</p>":"").
                    ($model->email !=""? "<p><i class='fa fa-envelope'></i> ".$model->email ."</p>":"")
            ],
//            [
//                'attribute' => 'user_id',
//                'value' => $model->user->firstname . " ".$model->user->lastname . " (".$model->user->email.")"
//            ],
            'created_date:datetime',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => $model->status == "A"?"<span class='tag is-success is-medium'>".Yii::t("app", "Active")."</span>":"<span class='tag is-dark is-medium'>".Yii::t("app", "Hide")."</span>"
            ],
        ],
    ]) ?>

</div>
<style>
    th {
        width: 50%;
    }
    tr th:first-child {
        text-align: right;
    }
</style>