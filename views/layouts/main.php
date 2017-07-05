<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\AppAsset;
use yii\helpers\Html;

//AppAsset::register($this);

?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <?php if(isset($this->params['fbtitle'])): ?>
        <meta property="og:title" content="<?= $this->params['fbtitle'] ?>" />
    <?php else: ?>
        <meta property="og:title" content="<?= Yii::t('app', 'DinLao.com - Properties Advertisement, where buyers & sellers meet') ?>" />
    <?php endif; ?>

    <meta property="fb:admins" content="dinlaocom" />
    <meta property="fb:app_id" content="1869360129980672" />

    <meta property="og:type" content="website" />

    <?php if(isset($this->params['fburl'])): ?>
        <meta property="og:url" content="<?= $this->params['fburl'] ?>" />
    <?php else: ?>
        <meta property="og:url" content="http://www.dinlao.com/web/index.php" />
    <?php endif; ?>

    <?php if(isset($this->params['fbphoto'])): ?>
        <meta property="og:image" content="http://dinlao.com/web/upload/photo/<?= $this->params['fbphoto'] ?>" />
    <?php else: ?>
        <meta property="og:image" content="http://dinlao.com/web/image/logo.png" />
    <?php endif; ?>

    <meta property="og:description" content="dinlao.com - The Advertisement for buyers & sellers" />

    <link rel="stylesheet" href="css/bulma.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" href="css/site.css" />
    <style rel="stylesheet">
        <?php if(Yii::$app->language == "la-LA"): ?>
        body, button, input, select, textarea {
            font-family: "Noto Sans Lao", "Noto Sans Southeast Asian", "Noto Serif Southeast Asian", "Noto Serif Lao", "Saysettha OT","Phetsarath OT", BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif !important;
        }
        <?php endif; ?>
        <?php if(Yii::$app->language != "la-LA"): ?>
        #changelang {
            font-family: "Noto Sans Lao", "Noto Sans Southeast Asian", "Noto Serif Southeast Asian", "Noto Serif Lao", "Saysettha OT","Phetsarath OT", BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif !important;
        }
        <?php endif; ?>
    </style>

    <script type="text/javascript" src="js/jquery.js"></script>
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
</head>
<body>
<div id="fb-root"></div>
<script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9&appId=1869360129980672";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

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
                <p><a href="index.php?r=site/about"><?= Yii::t("app","Contact Us") ?></a></p>
                <p><a href="index.php?r=site/terms"><?= Yii::t("app","Terms & Conditions") ?></a></p>
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
<<<<<<< HEAD
=======
<?php
$this->registerJsFile("js/jquery.min.js");
?>

>>>>>>> origin/master
<?php $this->endBody() ?>
<script type="text/javascript">
    $(document).ready(function() {
        $(".nav-toggle").click(function () {
            $(".nav-menu").toggleClass("is-active");
        });
    });
</script>
</body>
</html>
