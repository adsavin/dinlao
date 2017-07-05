<?php
/* @var $model \app\models\Product */
?>
<meta property="og:image"         content="http://dinlao.com/web/upload/photo/<?= $model->photo ?>" />
<div class="hero is-primary" style="height: 13rem;padding-top: 3rem">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="columns">
                <div class="column is-12 has-text-right is-hidden">
                    DINLAO.COM
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: -10%">
    <div class="columns">
        <div class="column is-4 is-offset-4">
            <figure class="image">
                <img src="upload/photo/<?= $model->photo ?>" alt="Image" >
            </figure>
        </div>
    </div>

    <div class="columns">
        <?php foreach ($model->pictures as $picture): ?>
        <div class="column">
            <figure>
                <img class="" src="upload/photo/<?= $picture->filename ?>"/>
            </figure>
        </div>
        <?php endforeach; ?>
    </div>
    <div class="columns">
        <div class="column has-text-right">
            <div class="fb-like"
                 data-href="http://dinlao.com/web/index.php?r=site/view&amp;id=<?= $model->id ?>"
                 data-layout="button_count"
                 data-action="like"
                 data-size="large"
                 data-show-faces="true"
                 data-share="true">
            </div>
        </div>
    </div>

    <?php if($model->productType->code == "R" && isset($model->productDetails)):
        if(count($model->productDetails) > 0):
        ?>
            <div class="box">
                <p class="content has-text-right"><small class=""><strong><?= date('d/m/Y H:i:s', strtotime($model->created_date)) ?></strong></small></p>
                <div class="columns">
                    <div class="column is-6 is-offset-3">
                        <p class="title has-text-centered">
                            <?= Yii::$app->language=="la-LA"?$model->productType->namelao:$model->productType->name ?>
                        </p>
                        <table class="table">
                            <thead>
                            <tr>
                                <th><?= Yii::t('app', 'Width') ?></th>
                                <th><?= Yii::t('app', 'Height') ?></th>
                                <th style="text-align: right"><?= Yii::t('app', 'Price') ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($model->productDetails as $detail): ?>
                                <tr>
                                    <td><?= number_format($detail->width). $model->unit->code ?></td>
                                    <td><?= number_format($detail->height). $model->unit->code ?></td>
                                    <td style="text-align: right"><?= number_format($detail->price). " ".$model->currency->code ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="columns">
                    <div class="column">
                            <p class="subtitle has-text-centered"><?= Yii::t('app', 'Document Type') ?></p>
                            <p class="title has-text-centered">
                                <?= Yii::$app->language=="la-LA"?$model->docType->namelao:$model->docType->name ?>
                            </p>

                            <p class="subtitle has-text-centered"><?= Yii::t('app', 'Address') ?></p>
                            <p class="title has-text-centered">
                                <?= $model->village . ", " . (Yii::$app->language == "la-LA"?$model->district->namelao:$model->district->name) .", ". (Yii::$app->language == "la-LA"?$model->district->province->namelao:$model->district->province->name) ?>
                            </p>

                        <p class="content has-text-centered">
                            <?= $model->description ?>
                        </p>

                        <?php if ($model->tel != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"> <i class="fa fa-phone"></i> <?= Yii::t("app", "Telephone") ?></p>
                                    <p class="title"><?= $model->tel ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->whatsapp != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"><i class="fa fa-whatsapp"></i><?= Yii::t("app", "Whatsapp") ?> </p>
                                    <p class="title"><?= $model->whatsapp ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->facebook != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"><i class="fa fa-facebook"></i><?= Yii::t("app", "acebook") ?> </p>
                                    <p class="title"><?= $model->facebook ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->email != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"> <i class="fa fa-envelope"></i> <?= Yii::t("app", "Email") ?></p>
                                    <p class="title"><?= $model->email ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->wechat != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"><i class="fa fa-wechat"></i><?= Yii::t("app", "Wechat") ?> </p>
                                    <p class="title"><?= $model->wechat ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->line != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"><i class="fa fa-line-chart"></i><?= Yii::t("app", "Line") ?> </p>
                                    <p class="title"><?= $model->line ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-10 is-offset-1">
                        <div id="map" style="height: 500px"></div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-6 is-offset-3">
                        <div class="fb-comments" data-href="http://dinlao.com/web/index.php?r=site/view&amp;id=<?= $model->id ?>" data-numposts="5"></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php else: ?>
            <div class="box">
                <div class="columns">
                    <div class="column is-7">
                        <p class="content has-text-right"><small class=""><strong><?= date('d/m/Y H:i:s', strtotime($model->created_date)) ?></strong></small></p>

                        <?= \yii\widgets\DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                [
                                    'attribute' => 'price',
                                    'value' => number_format($model->price) ." ". $model->currency->code
                                ],
                                [
                                    'attribute' => 'area',
                                    'format' =>'raw',
                                    'value' => number_format($model->area) ." ".$model->unit->code."<sup>2</sup> (".number_format($model->width). " ". $model->unit->code ." x ". number_format($model->height). " ".$model->unit->code.")",
                                ],
                                [
                                    'attribute' => 'doc_type_id',
                                    'label' => Yii::t('app','Document Type'),
                                    'value' => Yii::$app->language == "la-LA"?$model->docType->namelao:$model->docType->name
                                ],
                                [
                                    'label' => Yii::t('app', 'Address'),
                                    'value' => $model->village . ", " . (Yii::$app->language == "la-LA"?$model->district->namelao.", ".$model->district->province->namelao
                                            :$model->district->name) .", ".$model->district->province->name
                                ],
                            ],
                        ]) ?>
                        <p class="content has-text-centered">
                            <?= $model->description ?>
                        </p>

                        <?php if ($model->tel != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"> <i class="fa fa-phone"></i> <?= Yii::t("app", "Telephone") ?></p>
                                    <p class="title"><?= $model->tel ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->whatsapp != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"><i class="fa fa-whatsapp"></i><?= Yii::t("app", "Whatsapp") ?> </p>
                                    <p class="title"><?= $model->whatsapp ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->facebook != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"><i class="fa fa-facebook"></i><?= Yii::t("app", "acebook") ?> </p>
                                    <p class="title"><?= $model->facebook ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->email != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"> <i class="fa fa-envelope"></i> <?= Yii::t("app", "Email") ?></p>
                                    <p class="title"><?= $model->email ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->wechat != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"><i class="fa fa-wechat"></i><?= Yii::t("app", "Wechat") ?> </p>
                                    <p class="title"><?= $model->wechat ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if ($model->line != "") : ?>
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <p class="subtitle"><i class="fa fa-line-chart"></i><?= Yii::t("app", "Line") ?> </p>
                                    <p class="title"><?= $model->line ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="column is-5">
                        <div id="map" style="height: 500px"></div>
                    </div>
                </div>
                <div class="columns">
                    <div class="column is-6 is-offset-3">
                        <div class="fb-comments" data-href="http://dinlao.com/web/index.php?r=site/view&amp;id=<?= $model->id ?>" data-numposts="5"></div>
                    </div>
                </div>
            </div>
    <?php endif; ?>

</div>

<script type="text/javascript">
    function initMap() {
        var myLatLng = {lat: <?= $model->lat ?>, lng: <?= $model->lon ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            animation: google.maps.Animation.BOUNCE
        });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLYB1UvUkxUnghDV35dT1vQx886cN-Cac&callback=initMap"> </script>