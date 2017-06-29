<?php
/* @var $model \app\models\Product */
?>

<div class="hero is-primary" style="height: 13rem;padding-top: 3rem">
    <div class="hero-body">
        <div class="container has-text-centered">
            <div class="columns">
                <div class="column is-4 is-offset-4">
                    <figure class="image" style="">
                        <img src="upload/photo/<?= $model->photo ?>" alt="Image" >
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 20%">
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
            <div class="fb-share-button"
                 data-href="http://dinlao.com/web/index.php?r=site/view&amp;id=1"
                 data-layout="button" data-size="large"
                 data-mobile-iframe="true">
                <a class="fb-xfbml-parse-ignore" target="_blank"
                   href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fdinlao.com%2Fweb%2Findex.php%3Fr%3Dsite%252Fview%26id%3D<?= $model->id ?>&amp;src=sdkpreparse">
                    <?= Yii::t('app', 'Share to Facebook') ?>
                </a>
            </div>
        </div>
    </div>
    <div class="box">
        <div class="columns">
            <div class="column is-5">
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
                    'mapTypeId' => 'hybrid',
                ]);
                if (isset($model->lat) && isset($model->lon)) {
                    $marker = new \dosamigos\google\maps\overlays\Marker([
                        'position' => $coor,
                        'title' => $model->village,
                        'animation' => \dosamigos\google\maps\overlays\Animation::BOUNCE,
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
                            'value' => $model->docType->name
                        ],
                        [
                            'label' => Yii::t('app', 'Address'),
                            'value' => $model->village . ", " . $model->district->name .", ". $model->district->province->name
                        ],
                    ],
                ]) ?>
                <p class="content has-text-centered">
                    <?= $model->description ?>
                </p>

                <nav class="level">
                    <?php if ($model->tel != "") : ?>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading"> <i class="fa fa-phone"></i> <?= Yii::t("app", "Telephone") ?></p>
                                <p class="title"><?= $model->tel ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($model->whatsapp != "") : ?>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading"><i class="fa fa-whatsapp"></i><?= Yii::t("app", "Whatsapp") ?> </p>
                                <p class="title"><?= $model->whatsapp ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </nav>

                <nav class="level">
                    <?php if ($model->facebook != "") : ?>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading"><i class="fa fa-facebook"></i><?= Yii::t("app", "acebook") ?> </p>
                                <p class="title"><?= $model->facebook ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($model->email != "") : ?>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading"> <i class="fa fa-envelope"></i> <?= Yii::t("app", "Email") ?></p>
                                <p class="title"><?= $model->email ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </nav>
                <nav class="level">
                    <?php if ($model->wechat != "") : ?>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading"><i class="fa fa-wechat"></i><?= Yii::t("app", "Wechat") ?> </p>
                                <p class="title"><?= $model->wechat ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if ($model->line != "") : ?>
                        <div class="level-item has-text-centered">
                            <div>
                                <p class="heading"><i class="fa fa-line-chart"></i><?= Yii::t("app", "Line") ?> </p>
                                <p class="title"><?= $model->line ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                </nav>
            </div>
        </div>
        <div class="fb-comments" data-href="<?= $model->facebook_url ?>" data-numposts="5"></div>
    </div>
</div>