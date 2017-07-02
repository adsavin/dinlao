<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PictureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pictures');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-index">
    <h1 class="title is-3"><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p class="is-fullwidth text-right pull-right">
        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('app', 'Add'), ['create'], ['class' => 'button is-primary']) ?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'filename',
                'format' => 'html',
                'value' => function($data) {
                    return Html::img("upload/picture/". $data->filename);
                }
            ],
            [
                'attribute' => 'product_id',
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
