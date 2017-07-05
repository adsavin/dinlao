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
            <div class="columns">
                <div class="column">
                    <?= $form->field($model, 'product_type_id', [
                        'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
                    ])->dropDownList(\yii\helpers\ArrayHelper::map($productTypes, "id", Yii::$app->language == "la-LA"?"namelao":"name")) ?>
                </div>
                <div class="column">
                    <?= $form->field($model, 'doc_type_id', [
                        'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
                    ])->dropDownList(\yii\helpers\ArrayHelper::map($docTypes, "id", Yii::$app->language == "la-LA"?"namelao":"name")) ?>
                </div>
            </div>
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
                    <div class="column is-4">
                        <?= $form->field($model, 'width')->textInput(['class'=>'input', 'maxlength' => true]) ?>
                    </div>
                    <div class="column is-4">
                        <?= $form->field($model, 'height')->textInput(['class'=>'input', 'maxlength' => true]) ?>
                    </div>
                    <div class="column is-2">
                        <?= $form->field($model, 'unit_id', [
                            'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
                        ])->dropDownList(\yii\helpers\ArrayHelper::map(
                            $units, "id", "code"
                        )) ?>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                        <?= $form->field($model, 'area')->textInput(['class'=>'input', 'maxlength' => true]) ?>
                    </div>
                </div>
        </div>
    </div>

    <?php
    if(isset($model->productDetails)):
        if(count($model->productDetails) > 0) : ?>
            <table class="table">
                <thead>
                    <tr>
                        <th><?= Yii::t('app', 'Width') ?></th>
                        <th><?= Yii::t('app', 'Height') ?></th>
                        <th><?= Yii::t('app', 'Price') ?></th>
                        <th><span class="is-hidden-mobile"><?= Yii::t('app', 'Remove') ?></span> </th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($model->productDetails as $key => $detail): ?>
                    <tr data-id="<?= $detail->id ?>" >
                        <td><?= $detail->width ?></td>
                        <td><?= $detail->height ?></td>
                        <td><?= $detail->price ?></td>
                        <td><button type="button" class="button is-danger deleteproductdetail" data-id="<?= $detail->id ?>"><i class="fa fa-minus"></i> </button> </td>
                    </tr>
                    <?php
                endforeach;?>
                </tbody>
            </table>
            <?php
        endif;
    endif;
    ?>

    <div class="productdetail <?= ($model->productType->code == "R")?'':'is-hidden' ?>">
        <h1 class="title"><?= Yii::t('app', 'Retails Lands Details') ?></h1>
        <div class="columns">
            <div class="column is-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th><?= Yii::t('app', 'Width') ?></th>
                            <th><?= Yii::t('app', 'Height') ?></th>
                            <th><?= Yii::t('app', 'Price') ?></th>
                            <th><span class="is-hidden-mobile"><?= Yii::t('app', 'Remove') ?></span> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr data-id="0">
                            <td><input class="input" name="Product[productDetails][0][width]"></td>
                            <td><input class="input" name="Product[productDetails][0][height]"></td>
                            <td><input class="input" name="Product[productDetails][0][price]"></td>
                            <td></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="has-text-centered">
                                <button type="button" class="button is-success btnaddrow"><span class="icon"><i class="fa fa-plus"></i></span></button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
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
            <?= $form->field($model, 'description')->textarea(['class'=>'textarea', 'rows' => 6]) ?>
        </div>
    </div>

    <hr />
    <h1 class="title is-4"><?= Yii::t("app", "Location") ?></h1>
    <h1 class="subtitle is-5"><?= Yii::t("app", "Click on map to locate the location") ?></h1>
    <div class="columns">
        <div class="column is-10 is-offset-1" id="map" style="height: 500px">

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
            ])->dropDownList(\yii\helpers\ArrayHelper::map($provinces, "id", $this->title = Yii::$app->language == "la-LA"?"namelao":"name")) ?>
        </div>
        <div class="column is-one-third">
            <?= $form->field($model, 'district_id', [
                'inputTemplate' => '<p class="control"><span class="select">{input}</span></p>',
            ])->dropDownList(\yii\helpers\ArrayHelper::map($districts, "id", $this->title = Yii::$app->language == "la-LA"?"namelao":"name")) ?>
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
                "A" => Yii::t('app','Available'),
                "H" => Yii::t('app','Hidden'),
                "S" => Yii::t('app','Sold'),
            ]) ?>
        </div>
    </div>
    <div class="has-text-centered">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' =>'button is-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var totalrow = 0;
        $('.btnaddrow').click(function() {
            totalrow++;
            var $tr = $('<tr>');
            $tr.append("<td><input class='input' name='Product[productDetails]["+totalrow+"][width]' /></td>")
                .append("<td><input class='input' name='Product[productDetails]["+totalrow+"][height]' /></td>")
                .append("<td><input class='input' name='Product[productDetails]["+totalrow+"][price]' /></td>")
                .append("<td><button type='button' onclick='$(this).parent().parent().remove()' class='button is-danger'><span><i class='fa fa-minus'></i></span></button></td>");
            $('.table tbody').append($tr);
        });

        $('.deleteproductdetail').click(function() {
            var id = $(this).data('id');
            $.post('index.php?r=product/deleteproductdetail', {'id': id}, function(data) {
                if(!$.isNumeric(data)) alert(data);
                else $('tr[data-id='+id+']').remove();
            });
        });

        $('#product-product_type_id').change(function() {
            var id = $(this).val();
            if(id==3) $('.productdetail').removeClass('is-hidden');
            else $('.productdetail').addClass('is-hidden');
        });

        $(".addphoto").click(function() {
            var id = $(this).data("id");
            $("#product-photofiles-"+id).click();
        });

        $(".photos").change(function () {
            var id = $(this).data("id");
            previewImage(this, $("#previewphoto-"+id));
        })

        $('#addphoto').click(function() {
            $("#product-photofile").click();
        });

        $('#product-photofile').change(function() {
            previewImage(this, $("#previewphoto"));
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
                        $('#product-district_id').append('<option value="'+responses[i].id+'">'+responses[i].name+'</option>');
                    }
                }
            });
        });
        $('#product-width, #product-height').change(function() {
            var w = $('#product-width').val().replace(/[^0-9]/g, '');
            var h = $('#product-height').val().replace(/[^0-9]/g, '');
            if(w !='' && h != '') $('#product-area').val(w*h);
        });
        $('#product-unit_id').change(function() {
            var u = $(this).val();
            var t = $('#product-unit_id option[value="'+u+'"]').html();
            $('label[for="product-area"]').html('<?= Yii::t('app', 'Area') ?> ('+t+'<sup>2</sup>)');
        });
        $('#product-unit_id').change();
    });

    function previewImage(input, $preview) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $preview.attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    function initMap() {
        var center = {lat: <?= isset($model->lat) ? $model->lat : 17.96333505412437 ?>, lng: <?= isset($model->lon) ? $model->lon : 102.60682459920645 ?>};
        var marker = new google.maps.Marker();
        <?php if(!$model->isNewRecord && isset($model->lat) && isset($model->lon)): ?>
            marker.setPosition({lat: <?= $model->lat ?>, lng: <?= $model->lon ?>});
        <?php endif; ?>
        marker.setAnimation(google.maps.Animation.BOUNCE);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: center,
            width: '100%',
            height: '500px',
            mapTypeId: 'hybrid'
        });

        map.addListener('click', function(e) {
            marker.setPosition({lat: e.latLng.lat(), lng: e.latLng.lng()});
            marker.setMap(this);
            document.getElementById('product-lat').value = e.latLng.lat();
            document.getElementById('product-lon').value = e.latLng.lng();
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLYB1UvUkxUnghDV35dT1vQx886cN-Cac&callback=initMap" async defer></script>