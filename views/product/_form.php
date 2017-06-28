<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
?>
<div class="product-form">
    <?php
    $form = ActiveForm::begin([
        'id' => 'form',
        'layout' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template' => "<div class=\"column is-12\">{label}\n{input}\n{error}</div>",
            'horizontalCssClasses' => [
                'error' => 'help is-danger',
            ],
        ],
        'errorCssClass' => 'is-danger'
    ]); ?>
    <div class="columns">
        <div class="column is-4">
            <?= $form->field($model, 'photofile')->fileInput(['class'=>'is-hidden','accept' => 'image/*'])->label(false) ?>
            <button type="button" class="button is-fullwidth" id="addphoto"><i class="fa fa-camera"></i> </button>
            <figure class="has-text-centered">
                <img id="previewphoto" src="<?= isset($model->photo)?'upload/photo/'.$model->photo:'' ?>"/>
            </figure>
        </div>
        <div class="column is-8">
            <?= $form->field($model, 'doc_type_id', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList(\yii\helpers\ArrayHelper::map($docTypes, "id", "name")) ?>
            <div class="columns">
                <div class="column is-9">
                    <?= $form->field($model, 'price')->textInput(['class'=>'input', 'maxlength' => true]) ?>
                </div>
                <div class="column is-3">
                    <?= $form->field($model, 'currency_id', [
                        'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
                    ])->dropDownList(\yii\helpers\ArrayHelper::map($currencies, "id" ,"code")) ?>
                </div>
            </div>
            <div class="columns">
                <div class="column is-9">
                    <?= $form->field($model, 'area')->textInput(['class'=>'input', 'maxlength' => true]) ?>
                </div>
                <div class="column is-3">
                    <?= $form->field($model, 'unit_id', [
                        'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
                    ])->dropDownList(\yii\helpers\ArrayHelper::map(
                        $units, "id", "code"
                    )) ?>
                </div>
            </div>
            <div class="columns">
                <div class="column is-half">
                    <?= $form->field($model, 'width')->textInput(['class'=>'input', 'maxlength' => true]) ?>
                </div>
                <div class="column is-half">
                    <?= $form->field($model, 'height')->textInput(['class'=>'input', 'maxlength' => true]) ?>
                </div>
            </div>
        </div>
    </div>
    <hr />
    <h1 class="subtitle"><?= Yii::t("app", "Attached Photos") ?></h1>
        <div class="columns">
            <?php
            $pictures =$model->getPictures()->all();

            for($j=0; $j<4; $j++): ?>
            <div class="column is-3">
                <?= $form->field($model, "photofiles[".$j."]")->fileInput(["class" => "is-hidden photos", 'accept' => 'image/*', "data-id" =>$j])->label(false) ?>
                <button type="button" class="button is-fullwidth addphoto" data-id="<?= $j ?>">
                    <span class="icon"><i class="fa fa-camera"></i></span>
                </button>
                <figure class="has-text-centered">
                    <img id="previewphoto-<?= $j ?>" src="<?= isset($pictures[$j])?'upload/photo/'.$pictures[$j]->filename:'' ?>">
                </figure>
            </div>
            <?php endfor; ?>
        </div>

    <div class="columns">
        <div class="column is-12">
            <?= $form->field($model, 'description')->textarea(['class'=>'input', 'rows' => 6]) ?>
        </div>
    </div>

    <hr />
    <h1 class="title is-4"><?= Yii::t("app", "Location") ?></h1>
    <h1 class="subtitle is-5"><?= Yii::t("app", "Click on map to locate the location") ?></h1>
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
            $map->appendScript("var markers = []");
            $onclick = new \dosamigos\google\maps\Event([
                "trigger" => "click",
                "js" => "
                    for (var i = 0; i < markers.length; i++) markers[i].setMap(null);
                    document.getElementById('product-lat').value = event.latLng.lat();
                    document.getElementById('product-lon').value = event.latLng.lng();
                    markers.push(new google.maps.Marker({
                        position: {lat: event.latLng.lat(), lng: event.latLng.lng()},
                        map: gmap0,
                      }));
                "
            ]);
            $map->addEvent($onclick);
            if (isset($model->lat) && isset($model->lon)) {
                $marker = new \dosamigos\google\maps\overlays\Marker([
                    'position' => $coor,
                    'title' => $model->village
                ]);

                // Provide a shared InfoWindow to the marker
                $marker->attachInfoWindow(
                    new \dosamigos\google\maps\overlays\InfoWindow([
                        'content' => '<p>' . $model->village . '</p>'
                    ])
                );
                $map->addOverlay($marker);
            }
            echo $map->display();
            ?>
        </div>
    </div>

    <div class="columns">
        <div class="column is-half">
            <?= $form->field($model, 'lat')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-half">
            <?= $form->field($model, 'lon')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
    </div>

    <div class="columns">
        <div class="column is-one-third">
            <?= $form->field($model, 'province_id', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList(\yii\helpers\ArrayHelper::map($provinces, "id", "name")) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'district_id', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList(\yii\helpers\ArrayHelper::map($districts, "id", "name")) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'village')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
    </div>

    <hr />
    <h1 class="subtitle"><?= Yii::t("app", "Contact Information") ?></h1>
    <div class="columns">
        <div class="column is-one-third">
            <?= $form->field($model, 'tel')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'whatsapp')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'line')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
    </div>
    <div class="columns">
        <div class="column is-one-third">
            <?= $form->field($model, 'facebook')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'wechat')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'email')->textInput(['class'=>'input', 'maxlength' => true]) ?>
        </div>
    </div>
    <div class="columns">
        <div class="column is-12 has-text-centered">
            <?= $form->field($model, 'status', [
                'inputTemplate' => '<p class="control" style="text-align: center"><span class="select">{input}</span></p>',
            ])->dropDownList([
                "A" => 'Available',
                "H" => 'Hide',
                "S" => 'Show',
            ]) ?>
        </div>
    </div>
    <div class="has-text-centered">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' =>'button is-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$this->registerJs("
    $(\".addphoto\").click(function() {
        var id = $(this).data(\"id\");
        $(\"#product-photofiles-\"+id).click();
    });

    $(\".photos\").change(function () {
        var id = $(this).data(\"id\");
        previewImage(this, $(\"#previewphoto-\"+id));
    })
    
    $('#addphoto').click(function() {
        $(\"#product-photofile\").click();
    });
    
    $('#product-photofile').change(function() {
        previewImage(this, $(\"#previewphoto\"));
    });      
     
    $('#product-province_id').change(function() {
        $('#product-district_id').empty();
        var id = $(this).val();
        $.get('index.php?r=site/getdistricts', {'province': id}, function(responses) {
            try{
                responses = JSON.parse(responses);
            } catch(ex) {
                alert('Error');
            }
            if(responses) {
                for(var i=0;i<responses.length;i++) {
                    $('#product-district_id').append('<option value=\"'+responses[i].id+'\">'+responses[i].name+'</option>');
                }
            }
        });
    });

  function previewImage(input, \$preview) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
            \$preview.attr('src', e.target.result);
          };
          reader.readAsDataURL(input.files[0]);
        }
  }");
?>