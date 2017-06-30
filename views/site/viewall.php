<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProvinceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'All Post');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hero is-primary" style="margin-bottom: 50px;padding-top: 4rem">
    <div class="hero-body">
        <div class="container">
            <h1 class="title has-text-right is-5-mobile"><?= Yii::$app->params["domain"] ?></h1>
            <h1 class="subtitle has-text-right">
                <?= Yii::t("app","Properties Advertisement") ?><br />
                <?= Yii::t('app', 'Where buyers & sellers meet') ?> <br />
                <a href="index.php?r=site/aboutus" class="button"><?= Yii::t('app','What we do') ?></a>
            </h1>
        </div>
    </div>
</div>
<div class="container">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'village',
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'label' => Yii::t('app', 'District'),
                'attribute' => 'district_id',
                'value' => function($data) {
                    return Yii::$app->language == "la-LA"?$data->district->namelao:$data->distict->name;
                },
                'filterInputOptions' => ['class'=>'select'],
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\District::find()->all(), "id" ,Yii::$app->language == "la-LA"?"namelao":"name"),
                'filterInputOptions' => ['class'=>'select'],
            ],
            [
                'label' => Yii::t('app', 'Province'),
                'attribute' => 'province_id',
                'value' => function($data) {
                    return Yii::$app->language == "la-LA"?$data->district->province->namelao:$data->distict->province->name;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Province::find()->asArray()->all(), "id" ,Yii::$app->language == "la-LA"?"namelao":"name"),
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'village',
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'price',
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'area',
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'label' => Yii::t('app', 'Actions'),
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a("<i class='fa fa-search'></i>", ["view", "id" => $data->id], ["class" => "is-info"]);
                }
            ],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
