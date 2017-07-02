<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProvinceSearch */
/* @var $dataProviderForMobile$dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'All Post');
$this->params['breadcrumbs'][] = $this->title;
$dataProviderForMobile = $dataProvider;
$dataProviderForMobile->pagination = false;
$products = $dataProviderForMobile->models;
?>
<div class="hero is-primary" style="margin-bottom: 50px;padding-top: 4rem">
    <div class="hero-body">
        <div class="container">
            <h1 class="title has-text-right is-5-mobile"><?= Yii::$app->params["domain"] ?></h1>
            <h1 class="subtitle has-text-right">
                <?= Yii::t("app","Properties Advertisement") ?><br />
                <?= Yii::t('app', 'Where buyers & sellers meet') ?> <br />
                <a href="index.php?r=site/about" class="button"><?= Yii::t('app','What we do') ?></a>
            </h1>
        </div>
    </div>
</div>
<div class="container">
    <h1 class="title has-text-centered"><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_search', [
        'model' => $searchModel,
        "provinces" => $provinces,
        "docTypes" => $docTypes,
        'currencies' => \app\models\Currency::find()->all(),
        'units' => \app\models\Unit::find()->all()
    ]); ?>
<hr/>
    <p class="title has-text-centered">
        <?= Yii::t('app', 'Search Result') ?>
    </p>
    <p class="subtitle has-text-centered">
        <?= count($products)." " .Yii::t('app', 'Rows') ?>
    </p>
    <div class="columns is-hidden-mobile">
        <div class="column">
    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'is-hidden-mobile'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => Yii::t('app', 'Province'),
                'attribute' => 'province_id',
                'value' => function($data) {
                    return Yii::$app->language == "la-LA"?$data->district->province->namelao:$data->district->province->name;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->all(), "id" ,Yii::$app->language == "la-LA"?"namelao":"name"),
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'label' => Yii::t('app', 'District'),
                'attribute' => 'district_id',
                'value' => function($data) {
                    return Yii::$app->language == "la-LA"?$data->district->namelao:$data->district->name;
                },
                'filterInputOptions' => ['class'=>'select'],
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\District::find()->all(), "id" ,Yii::$app->language == "la-LA"?"namelao":"name"),
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'village',
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'price',
                'value' => function($data) {
                    return number_format($data->price). " ". $data->currency->code;
                },
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'area',
                'format' => 'html',
                'value' => function($data) {
//                    $output = "";
//                    $output .= isset($data->area) ? number_format($data->area). $data->unit->code ."<sup>2</sup> " : "-";
//                    $output .= isset($data->width) ? number_format($data->width). $data->unit->code : "-";
//                    $output .= isset($data->height) ? number_format($data->height). $data->unit->code : "-";
                    return number_format($data->area). $data->unit->code ."<sup>2</sup> (".number_format($data->width).$data->unit->code." x ".number_format($data->height).$data->unit->code.")";
                },
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'label' => Yii::t('app', 'View'),
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a("<i class='fa fa-search'></i>", ["view", "id" => $data->id], ["class" => "button"]);
                }
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
        </div>
    </div> 
    <div class="columns is-hidden-desktop">
         <?php
         foreach ($products as $key => $product): ?>
            <div class="column is-10-mobile is-offset-1-mobile">
                <a href="index.php?r=site/view&id=<?= $product->id ?>">
                    <div class="card">
                        <div class="card-content">
                            <div class="media">
                                <div class="media-middle">
                                    <figure class="image is-48x48 is-hidden-desktop has-text-centered">
                                        <img src="upload/photo/<?= $product->photo ?>" alt="Image">
                                    </figure>
                                </div>
                                <div class="media-content">
                                    <p class="title is-4 has-text-right"><strong><?= number_format($product->price)." ". $product->currency->code ?></strong></p>
                                    <p class="subtitle is-5 has-text-right">
                                        <strong><?= number_format($product->width) ." " . $product->unit->code." x ". number_format($product->height) ." " . $product->unit->code ?></strong>
                                        <br/><?= $product->district->province[Yii::$app->language == "la-LA"?"namelao":"name"] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="content has-text-right">
                                <article class="is-hidden-mobile">
                                    <?= $product->description ?>
                                </article>
                                <?php if($product->tel!= ""): ?>
                                    <strong><span class="icon"><i class="fa fa-phone"></i></span><?= $product->tel ?></strong><br/>
                                <?php endif; ?>
                                <?php if($product->whatsapp !=""): ?>
                                    <strong><span class="icon"><i class="fa fa-whatsapp"></i></span><?= $product->whatsapp ?></strong><br/>
                                <?php endif; ?>
                            </div>
                            <small><?= date('d/m/Y H:i:s', strtotime($product->created_date))  ?></small>
                        </div>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</div>
