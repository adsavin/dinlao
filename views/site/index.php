<?php

/* @var $this yii\web\View */
/* @var $models app\models\Product[] */

$this->title = 'DINLAO.COM - HOME';
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
    <?php
        $products = $models;
        if(count($products) > 0) :
        ?>
        <div class="columns">
            <div class="column">
                <h1 class="title has-text-centered"><?= Yii::t('app', 'New Post') . " (".count($products).")" ?></h1>
                <h1 class="subtitle has-text-centered is-hidden-mobile">
                    <i class="fa fa-arrow-left"></i>
                    <?= Yii::t('app', 'Scroll Left-Right To See More') ?>
                    <i class="fa fa-arrow-right"></i>
                </h1>
            </div>
        </div>

        <div class="columns box">
            <div class="column is-12">
                <div class="columns" style="overflow-x: scroll">
                    <?php foreach ($products as $key => $product):
                        ?>
                            <div class="column <?= count($products) >4?'is-3':'' ?> <?= ($key > 5)?'is-hidden-mobile':'' ?>">
                                <a href="index.php?r=site/view&id=<?= $product->id ?>">
                                <div class="card" style="background-image: url('upload/photo/<?= $product->photo ?>'); background-size: 100% auto;background-repeat: no-repeat">
                                    <div class="card-image is-hidden-mobile">
                                        <figure class="image is-4by3">

                                        </figure>
                                    </div>
                                    <div class="card-content" style="background-color: #333333;opacity: 0.7">
                                        <div class="media">
                                            <div class="media-left is-hidden">
                                                <figure class="image is-64x64 is-hidden-desktop">
                                                    <img src="upload/photo/<?= $product->photo ?>" alt="Image">
                                                </figure>
                                            </div>
                                            <div class="media-content is-hidden-desktop">
                                                <p class="subtitle is-6 has-text-right" style="color: #ffffff">
                                                    <strong>
                                                        <?= Yii::$app->language == "la-LA"?$product->productType->namelao:$product->productType->name ?>
                                                    </strong>
                                                </p>
                                                <p class="title is-4 has-text-right" style="color: #ffffff"><strong><?= number_format($product->price)." ". $product->currency->code ?></strong></p>
                                                <p class="subtitle is-6 has-text-right" style="color: #ffffff">
                                                    <strong  style="color: #ffffff"><?= number_format($product->width) ."" . $product->unit->code." x ". number_format($product->height) ."" . $product->unit->code ?></strong>
                                                    <br/>
                                                    <strong style="color: #ffffff">
                                                        <?= Yii::$app->language == "la-LA"?
                                                            $product->district->namelao: $product->district->name
                                                        ?>
                                                    </strong>
                                                    <br/>
                                                    <strong style="color: #ffffff">
                                                        <?= Yii::$app->language == "la-LA"? $product->district->province->namelao : $product->district->province->name
                                                        ?>
                                                    </strong>
                                                </p>
                                            </div>
                                            <div class="media-content is-hidden-mobile">
                                                <p class="subtitle is-6 has-text-centered" style="color: #ffffff">
                                                    <strong style="color: #ffffff;">
                                                        <?= Yii::$app->language == "la-LA"?$product->productType->namelao:$product->productType->name ?>
                                                    </strong>
                                                </p>
                                                <p class="title is-4 has-text-centered" style="color: #ffffff"><strong><?= number_format($product->price)." ". $product->currency->code ?></strong></p>
                                                <p class="subtitle is-6 has-text-centered" style="color: #ffffff">
                                                    <strong style="color: #ffffff"><?= number_format($product->width) ."" . $product->unit->code." x ". number_format($product->height) ."" . $product->unit->code ?></strong>
                                                    <br/>
                                                    <strong style="color: #ffffff">
                                                        <?= Yii::$app->language == "la-LA"?
                                                            $product->district->namelao: $product->district->name
                                                        ?>
                                                    </strong>
                                                    <br/>
                                                    <strong style="color: #ffffff">
                                                        <?= Yii::$app->language == "la-LA"? $product->district->province->namelao : $product->district->province->name ?>
                                                    </strong>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="content has-text-right is-hidden-desktop">
                                            <?php if($product->tel!= ""): ?>
                                                <strong style="color: #ffffff"><span class="icon"><i class="fa fa-phone"></i></span><?= $product->tel ?></strong><br/>
                                            <?php endif; ?>
                                            <?php if($product->whatsapp !=""): ?>
                                                <strong style="color: #ffffff"><span class="icon"><i class="fa fa-whatsapp"></i></span><?= $product->whatsapp ?></strong><br/>
                                            <?php endif; ?>
                                        </div>
                                        <div class="content has-text-centered is-hidden-mobile">
                                            <article class="is-hidden-mobile" style="color: #ffffff">
                                                <?= strlen($product->description) > 200 ? substr($product->description, 0, 200)." ..." : $product->description ?>
                                            </article>
                                            <?php if($product->tel!= ""): ?>
                                                <strong style="color: #ffffff"><span class="icon"><i class="fa fa-phone"></i></span><?= $product->tel ?></strong><br/>
                                            <?php endif; ?>
                                            <?php if($product->whatsapp !=""): ?>
                                                <strong style="color: #ffffff"><span class="icon"><i class="fa fa-whatsapp"></i></span><?= $product->whatsapp ?></strong><br/>
                                            <?php endif; ?>
                                        </div>
                                        <small style="color: #ffffff"><?= date('d/m/Y H:i:s', strtotime($product->created_date))  ?></small>
                                    </div>
                                </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                </div>
                <a href="index.php?r=site/viewall" class="button is-outlined is-primary is-fullwidth">
                    <span><?= Yii::t('app', 'More') ?></span>
                </a>
            </div>
        </div>
        <hr />
    <?php endif; ?>
    <div class="columns">
        <div class="column is-10 is-offset-1">
            <h1 class="title is-2 has-text-centered"><?= Yii::t("app", "All in one map") ?></h1>
            <h1 class="subtitle has-text-centered"><?= Yii::t("app", "Click on the pin ") ?><i class="fa fa-map-marker"></i> <?= Yii::t('app'," to see more detail") ?></h1>
            <div id="map" style="height: 40rem">

            </div>
        </div>
    </div>
</div>

<script>
    var map;
    var center = {'lat' : 17.96333505412437, 'lng' : 102.60682459920645};
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: center,
            zoom: 7,
            streetViewControl: false,
            mapTypeId: 'hybrid',
        });

        $.get("index.php?r=site/getproducts",{}, function(products) {
            try {
                products = JSON.parse(products);
            } catch (ex) {
                console.log(ex);
            }
            var markers = [];
            var infowindows = [];
            products.forEach(function(p) {
                markers[p.id] = new google.maps.Marker({
                    position: {'lat': parseFloat(p.lat), 'lng': parseFloat(p.lon)},
                    map: map,
                    animation: google.maps.Animation.BOUNCE,
                    title: p.typename
                });
                var content = "<a href='index.php?r=site/view&id="+p.id+"'> <span style='overflow: hidden'> <p class='title is-5'><strong>"+p.typename+"</strong></p>" +
                    "<p class='subtitle is-6'>"+p.districtname
                    +"<br/>"+ p.provincename;
                if(p.typecode != "R")
                    content += "<br/>"+formatNumber(p.width)+" x "+ formatNumber(p.height)+ " "+p.unitcode;

                content += "<br/><strong>"+formatNumber(p.price) + " " + p.currencycode +"</strong></p></span></a>";
                content += "<div class='has-text-right'><a href='index.php?r=site/view&id="+p.id+"' style='text-decoration: underline;'><?= Yii::t('app', 'More Details') ?> >></a></div>";
                infowindows[p.id] = new google.maps.InfoWindow({
                    content: content
                });

                markers[p.id].addListener('click', function() {
                    markers.forEach(function (m) {
                        m.setAnimation(google.maps.Animation.BOUNCE);
                    });
                    infowindows.forEach(function (f) {
                        f.close();
                    });
                    this.setAnimation(google.maps.Animation.DROP);
                    infowindows[p.id].open(map, this);
                });
            });
        });
    }

    function formatNumber(num, dec) {
        if (dec === undefined) dec = 2;
        var r = "" + Math.abs(parseFloat(num).toFixed(dec));
        var decimals = "";
        if (r.lastIndexOf(".") != -1) {
            decimals = "." + r.substring(r.lastIndexOf(".") + 1);
            decimals = decimals.substring(0, Math.min(dec + 1, decimals.length)); // Take only 2 digits after decimals
            r = r.substring(0, r.lastIndexOf("."));
        }
        for (var i = r.length - 3; i > 0; i -= 3)
            r = r.substr(0, i) + "," + r.substr(i);
        return (num < 0 ? "-" : "") + r + decimals;
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDLYB1UvUkxUnghDV35dT1vQx886cN-Cac&callback=initMap" async defer></script>