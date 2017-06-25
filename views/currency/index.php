<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CurrencySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Currencies');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-index">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="is-fullwidth text-right pull-right">
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('app', 'Add'), ['create'], ['class' => 'button is-primary']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'code',
                'filterInputOptions' => ['class'=>'input'],
            ],
            [
                'attribute' => 'name',
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
