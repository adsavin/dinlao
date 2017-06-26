<?php

/* @var $this yii\web\View */

$this->title = 'DINDEE.COM - HOME';

$coor = new \dosamigos\google\maps\LatLng([
    'lat' => 17.96333505412437,
    'lng' => 102.60682459920645
]);
$map = new \dosamigos\google\maps\Map([
    'center' => $coor,
    'zoom' => 12,
    'width' => '100%',
    'height' => '600',
    'mapTypeId' => 'hybrid'
]);
?>
<div class="hero is-primary" style="margin-bottom: 50px;padding-top: 4rem">
    <div class="hero-body">
        <div class="container">
                    <h1 class="title has-text-right">
                        DINDEE.COM - Properties Advertisement
                    </h1>
                    <h1 class="subtitle has-text-right">
                        Where you buy & sell the land & house <br /><a class="button">What we do</a>
                    </h1>
        </div>
    </div>
</div>
<div class="container">
    <?php foreach ($models as $model):
        if(count($model->products) == 0) continue;
        ?>
        <div class="columns">
            <div class="column is-10">
                <h1 class="title is-3"><?= Yii::t('app', $model->name) ?></h1>
            </div>
            <div class="column is-2 has-text-right">
                <a href="index.php?r=site/land" class="button is-outlined is-primary">
                    <span><?= Yii::t('app', 'More') ?></span>
                    <span class="icon">
                  <i class="fa fa-plus-circle"></i>
                </span>
                </a>
            </div>
        </div>

        <div class="columns box">
            <div class="column is-12">
                <div class="columns">
                    <?php foreach ($model->products as $product):
                        if (isset($product->lat) && isset($product->lon)) {
                            $marker = new \dosamigos\google\maps\overlays\Marker([
                                'position' => new \dosamigos\google\maps\LatLng([
                                    'lat' => $product->lat,
                                    'lng' => $product->lon
                                ]),
                                'title' => $product->village,
                                'animation' => \dosamigos\google\maps\overlays\Animation::BOUNCE,
            //                    'animation' => \dosamigos\google\maps\overlays\Animation::DROP
                            ]);

                            $marker->attachInfoWindow(
                                new \dosamigos\google\maps\overlays\InfoWindow([
                                    'content' => '<a href="index.php?r=site/viewland&id='.$product->id.'">
                                        <p>' . $product->village . ' 
                                            <strong>'.number_format($product->width).' x '.number_format($product->height).' '.$product->unit->code.'</strong>
                                        </p>
                                    </a>'
                                ])
                            );
                            $map->addOverlay($marker);
                        }
                        ?>
                            <div class="column is-3">
                                <div class="card">
                                    <div class="card-image">
                                        <figure class="image is-4by3">
                                            <img src="upload/photo/<?= $product->photo ?>" alt="Image">
                                        </figure>
                                    </div>
                                    <div class="card-content">
                                        <div class="media">
                                            <div class="media-content">
                                                <p class="title is-4 has-text-centered"><strong><?= number_format($product->price, 2)." ". $product->currency->code ?></strong></p>
                                                <p class="subtitle is-6 has-text-centered">
                                                    <strong><?= $product->width ." " . $product->unit->code." x ".$product->height ." " . $product->unit->code ?></strong>
                                                </p>
                                            </div>
                                        </div>
                                        <a class="button is-fullwidth is-primary is-outlined" href="index.php?r=site/viewland&id=<?= $product->id ?>" ><?= Yii::t('app', 'Detail') ?></a>
                                        <div class="content has-text-centered">
                                            <article>
                                                <?= $product->description ?>
                                            </article>
                                            <?php if($product->tel!= ""): ?>
                                                <strong><span class="icon"><i class="fa fa-phone"></i></span><?= $product->tel ?></strong><br/>
                                            <?php endif; ?>
                                            <?php if($product->whatsapp !=""): ?>
                                                <strong><span class="icon"><i class="fa fa-whatsapp"></i></span><?= $product->whatsapp ?></strong><br/>
                                            <?php endif; ?>
                                            <?php if($product->facebook !=""): ?>
                                                <strong><span class="icon"><i class="fa fa-facebook"></i></span><?= $product->facebook ?></strong><br/>
                                            <?php endif; ?>
                                            <?php if($product->line !=""): ?>
                                                <strong><span class="icon"><i class="fa fa-line-chart"></i></span><?= $product->line ?></strong><br/>
                                            <?php endif; ?>
                                            <?php if($product->wechat !=""): ?>
                                                <strong><span class="icon"><i class="fa fa-wechat"></i></span><?= $product->wechat ?></strong><br/>
                                            <?php endif; ?>
                                            <?php if($product->email !=""): ?>
                                                <strong><span class="icon"><i class="fa fa-envelope"></i></span><?= $product->email ?></strong><br/>
                                            <?php endif; ?>
                                        </div>
                                        <small><?= date('d/m/Y H:i:s', strtotime($product->created_date))  ?></small>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                </div>
                <div class="columns">
                    <div class="column is-offset-half is-half box">
                        <nav class="pagination">
                            <a class="pagination-previous" title="This is the first page" disabled><i class="fa fa-arrow-left"></i></a>
                            <a class="pagination-next"><i class="fa fa-arrow-right"></i></a>
                            <ul class="pagination-list">
                                <li>
                                    <a class="pagination-link is-current">1</a>
                                </li>
                                <li>
                                    <a class="pagination-link">2</a>
                                </li>
                                <li>
                                    <a class="pagination-link">3</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <hr />
    <?php endforeach; ?>
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <h1 class="title is-2 has-text-centered"><?= Yii::t("app", "All in one map") ?></h1>
            <h1 class="subtitle has-text-centered"><?= Yii::t("app", "Click on the pin ") ?><i class="fa fa-map-marker"></i> <?= Yii::t('app'," to see more detail") ?></h1>
            <?=  $map->display(); ?>
        </div>
    </div>
</div>