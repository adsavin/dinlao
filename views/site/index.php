<?php

/* @var $this yii\web\View */

$this->title = 'DINDEE.COM - HOME';
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
    <div class="container">
    <div class="columns">
        <div class="column is-10">
            <h1 class="title is-3"><?= Yii::t('app', 'Land for Sale') ?></h1>
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
    <div class="columns">
        <?php for($i=0; $i<4; $i++) : ?>
            <div class="column is-3">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://bulma.io/images/placeholders/1280x960.png" alt="Image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
<!--                            <div class="media-left">-->
<!--                                <figure class="image is-48x48">-->
<!--                                    <img src="http://bulma.io/images/placeholders/96x96.png" alt="Image">-->
<!--                                </figure>-->
<!--                            </div>-->
                            <div class="media-content">
                                <p class="title is-4 has-text-centered"><strong>250,000 THB</strong></p>
                                <p class="subtitle is-6 has-text-centered"><strong>15m x 30m</strong></p>
                            </div>
                        </div>
                        <a class="button is-fullwidth is-primary is-outlined" href="index.php?r=site/viewLand&id=<?= 1 ?>" >Detail</a>
                        <div class="content has-text-centered">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus nec iaculis mauris.
                            <strong><span class="icon"><i class="fa fa-phone"></i></span>020 2222 4071</strong><br/>
                            <strong><span class="icon"><i class="fa fa-whatsapp"></i></span>020 2222 4071</strong><br/>
                            <strong><span class="icon"><i class="fa fa-facebook"></i></span>020 2222 4071</strong><br/>
    <!--                        <strong><span class="icon"><i class="fa fa-wechat"></i></span>020 2222 4071</strong><br/>-->
    <!--                        <strong><span class="icon"><i class="fa fa-envelope"></i></span>adsavin@live.com</strong><br/>-->
                            <small>11:09 PM - 1 Jan 2016</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="content">

                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>

    <hr />

    <div class="columns">
        <div class="column is-10">
            <h1 class="title is-3"><?= Yii::t('app', 'House for Sale') ?></h1>
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
    <div class="columns">
        <?php for($i=0; $i<4; $i++) : ?>
            <div class="column is-3">
                <div class="card">
                    <div class="card-image">
                        <figure class="image is-4by3">
                            <img src="http://bulma.io/images/placeholders/1280x960.png" alt="Image">
                        </figure>
                    </div>
                    <div class="card-content">
                        <div class="media">
                            <!--                            <div class="media-left">-->
                            <!--                                <figure class="image is-48x48">-->
                            <!--                                    <img src="http://bulma.io/images/placeholders/96x96.png" alt="Image">-->
                            <!--                                </figure>-->
                            <!--                            </div>-->
                            <div class="media-content">
                                <p class="title is-4 has-text-centered"><strong>250,000 THB</strong></p>
                                <p class="subtitle is-6 has-text-centered"><strong>15m x 30m</strong></p>
                            </div>
                        </div>
                        <a class="button is-fullwidth is-primary is-outlined" href="index.php?r=site/viewLand&id=<?= 1 ?>" >Detail</a>
                        <div class="content has-text-centered">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Phasellus nec iaculis mauris.
                            <strong><span class="icon"><i class="fa fa-phone"></i></span>020 2222 4071</strong><br/>
                            <strong><span class="icon"><i class="fa fa-whatsapp"></i></span>020 2222 4071</strong><br/>
                            <strong><span class="icon"><i class="fa fa-facebook"></i></span>020 2222 4071</strong><br/>
                            <!--                        <strong><span class="icon"><i class="fa fa-wechat"></i></span>020 2222 4071</strong><br/>-->
                            <!--                        <strong><span class="icon"><i class="fa fa-envelope"></i></span>adsavin@live.com</strong><br/>-->
                            <small>11:09 PM - 1 Jan 2016</small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="content">

                        </div>
                    </div>
                </div>
            </div>
        <?php endfor; ?>
    </div>
</div>