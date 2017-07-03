<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'About Us');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hero is-primary" style="margin-bottom: 50px;padding-top: 4rem">
    <div class="hero-body">
        <div class="container">
            <h1 class="title has-text-right is-5-mobile"><?= Yii::$app->params["domain"] ?></h1>
            <h1 class="subtitle has-text-right">
                <?= Yii::t("app","Properties Advertisement") ?><br />
                <?= Yii::t('app', 'Where buyers & sellers meet') ?> <br />

            </h1>
        </div>
    </div>
</div>

<div class="container">
    <h1 class="title"><?= Html::encode($this->title) ?></h1>
    <p class="subtitle">
        <?= Yii::t('app', "We're just a freelance developer who love to develop something fun, convinience to  :D") ?>
    </p>

    <br />
    <h1 class="title"><?= Yii::t('app', 'What we do') ?></h1>
    <p class="subtitle">
        <ul>
            <li>- <?= Yii::t('app', 'To Design logo, website and etc.')?></li>
            <li>- <?= Yii::t('app', 'To develop website, mobile application (iOS & android)') ?></li>
        </ul>
    </p>

    <br />
    <h1 class="title"><?= Yii::t('app', 'Our Developments') ?></h1>
    <p class="subtitle">
        <ul>
            <li>- <a href="#">LUMS - <?= Yii::t('app','Lao University Management System') ?></a> - <?= Yii::t('app','In Progress') ?></li>
            <li>- <a href="http://www.jobweb.la" target="_blank">JOBWEB.LA - <?= Yii::t('app','Job Advertisement Website') ?></a> - 2015</li>
            <li>- <a href="http://ntp.org.la/stat/index.php?r=site/login" target="_blank"><?= Yii::t('app','Lao Tuberculosis Statistic Management System - Lao National Tuber Center') ?></a> - 2014</li>
            <li>- <a href="http://www.aipa35laos.gov.la"><?= Yii::t('app','The 35<sup>th</sup> AIPA Summit in Vientiane, Laos') ?></a> - 2013</li>
            <li>- <?= Yii::t('app', 'The National Assembly Internal Document Flow Management System') ?> - 2012</li>
        </ul>
    </p>

    <br />
    <h1 class="title"><?= Yii::t('app', 'Contact Us') ?></h1>
    <p class="subtitle">
    <ul>
        <li>- <span class="icon"><i class="fa fa-envelope"></i></span> <?= " ". Yii::$app->params["adminEmail"] ?></li>
        <li>- <span class="icon"><i class="fa fa-phone"></i></span></li>
        <li>- <span class="icon"><i class="fa fa-whatsapp"></i></span></li>
        <li>- <span class="icon"><i class="fa fa-facebook-official"></i></span> </li>
    </ul>
    </p>
</div>
