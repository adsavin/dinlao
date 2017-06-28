<?php
/* @var $this \yii\web\Controller */

$this->beginContent('@app/views/layouts/main.php'); ?>
<div class="container is-hidden-mobile">
    <a href="index.php" class="nav-item has-shadow is-outlined" style="position: absolute;z-index: 33">
        <img class="" src="image/logo.png" alt="DINLAO.COM" style="max-height: 12rem;">
    </a>
</div>
<div class="container is-hidden-desktop">
    <a href="index.php" class="nav-item has-shadow is-outlined" style="position: absolute;z-index: 33">
        <img class="" src="image/logo.png" alt="DINLAO.COM" style="max-height: 6rem;">
    </a>
</div>

<nav class="nav has-shadow" style="position: fixed;background-color: #fff;width: 100%;top:0">
    <div class="container">
        <div class="nav-left has-shadow">
            <a href="index.php" class="nav-item has-shadow is-outlined is-hidden-mobile">
                <span class="icon">
                        <i class="fa fa-home"></i>
                    </span>
            </a>
        </div>

        <div class="nav-center has-shadow is-hidden-mobile">
            <div class="nav-item ">
                <a class="button is-primary is-outlined" href="<?= Yii::$app->params["facebookpage"] ?>" target="_blank">
                      <span class="icon">
                    <i class="fa fa-facebook"></i>
                  </span> <?= Yii::t('app', 'acebook') ?>
                </a>
                <!--                <a class="nav-item">-->
                <!--                  <span class="icon">-->
                <!--                    <i class="fa fa-twitter"></i>-->
                <!--                  </span>-->
                <!--                </a>-->
            </div>
        </div>

    <!-- This "nav-toggle" hamburger menu is only visible on mobile -->
    <!-- You need JavaScript to toggle the "is-active" class on "nav-menu" -->
    <span class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </span>

    <!-- This "nav-menu" is hidden on mobile -->
    <!-- Add the modifier "is-active" to display it on mobile -->
    <div class="nav-right nav-menu">
        <div class="nav-item">
            <div class="field is-grouped">
                <p class="control">
                    <a class="button is-primary is-outlined" href="index.php?r=site/login">
                            <span class="icon">
                              <i class="fa fa-sign-in"></i>
                            </span>
                        <span>Sign In</span>
                    </a>
                </p>
            </div>
        </div>
    </div>
    </div>
</nav>
<?= $content ?>
<?php $this->endContent(); ?>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '325382307872972',
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  $(".nav-toggle").click(function () {
    $(".nav-menu").toggleClass("is-active");
  });
</script>