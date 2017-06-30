<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;

//AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="dinlao.com" />
    <meta property="og:type" content="Properties Advertisement" />
    <meta property="og:url" content="<?= Yii::t('app', 'DinLao.com - Properties Advertisement, where buyers & sellers meet') ?>" />
    <meta property="og:image" content="http://dinlao.com/web/image/logo.png" />
    <meta property="og:site_name" content="Any related term to your site" />

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="css/bulma.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/site.css">
    <style rel="stylesheet">
        <?php if(Yii::$app->language == "la-LA"): ?>
        body, button, input, select, textarea {
            font-family: "Noto Sans Lao", "Noto Sans Southeast Asian", "Noto Serif Southeast Asian", "Noto Serif Lao", "Saysettha OT","Phetsarath OT", BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
        }
        <?php endif; ?>
        <?php if(Yii::$app->language == "en-US"): ?>
        #changelang {
            font-family: "Noto Sans Lao", "Noto Sans Southeast Asian", "Noto Serif Southeast Asian", "Noto Serif Lao", "Saysettha OT","Phetsarath OT", BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;
        }
        <?php endif; ?>
    </style>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=1869360129980672";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

<?php $this->beginBody() ?>
<?= $content ?>
<footer class="footer" style="margin-top: 50px">
    <div class="container">
        <div class="columns">
            <div class="column has-text-centered">
                <p><a href="index.php?r=site/login"><?= Yii::t("app","Sign In") ?></a></p>
                <p><a href="index.php?r=site/register"><?= Yii::t("app","Register") ?></a></p>
            </div>
            <div class="column has-text-centered">
                <p><a href="index.php?r=site/login"><?= Yii::t("app","Contact Us") ?></a></p>
                <p><a href="index.php?r=site/register"><?= Yii::t("app","Terms & Conditions") ?></a></p>
            </div>
            <div class="column has-text-centered">
                    <p>
                        &copy; <?= Yii::$app->params["company_name"] ?> <?= date('Y') ?>
                    </p>
                    <p>
                        <?= Yii::$app->params["adminEmail"] ?>
                    </p>
            </div>
        </div>
        <div class="columns">
            <div class="column is-12 has-text-centered">
                <div class="fb-like" data-href="<?= Yii::$app->params["facebookpage"] ?>"
                     data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
            </div>
        </div>
    </div>
</footer>
<?php $this->registerJsFile("js/jquery.min.js"); ?>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-101911593-1', 'auto');
    ga('send', 'pageview');

</script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
