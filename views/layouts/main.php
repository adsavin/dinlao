<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
if(Yii::$app->language == "en-US") Yii::$app->language = "en";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="css/bulma.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/site.css">
</head>
<body>
<?php $this->beginBody() ?>
<?= $content ?>
<footer class="footer" style="margin-top: 50px">
    <div class="container">
        <div class="columns">
            <div class="column is-4 has-text-centered">
                <p><a href="index.php?r=site/login"><?= Yii::t("app","Sign In") ?></a></p>
                <p><a href="index.php?r=site/register"><?= Yii::t("app","Register") ?></a></p>
            </div>
            <div class="column is-4 has-text-centered">
                <p><a href="index.php?r=site/login"><?= Yii::t("app","Contact Us") ?></a></p>
                <p><a href="index.php?r=site/register"><?= Yii::t("app","Terms & Conditions") ?></a></p>
            </div>
            <div class="column is-4 has-text-centered">
                    <p>
                        &copy; <?= Yii::$app->params["company_name"] ?> <?= date('Y') ?>
                    </p>
                    <p>
                        <?= Yii::$app->params["adminEmail"] ?>
                    </p>
            </div>
        </div>
    </div>
</footer>
<?php
$this->registerJsFile("js/jquery.min.js");
?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
