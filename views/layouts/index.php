<?php
/* @var $this \yii\web\Controller */

$this->beginContent('@app/views/layouts/main.php'); ?>

<div class="container">
    <a href="index.php" class="nav-item has-shadow is-outlined is-hidden-mobile" style="position: absolute;z-index: 33">
        <img class="" src="image/logo.png" alt="DINDEE.COM" style="max-height: 12rem;">
    </a>
</div>
    <nav class="nav has-shadow" style="position: fixed;background-color: #fff;width: 100%;top: 0">
        <div class="container">
            <div class="nav-left has-shadow">
                <a href="index.php" class="nav-item has-shadow is-outlined">
                    <img class="" src="image/logo.png" alt="DINDEE.COM">
                </a>
            </div>

            <div class="nav-center"">
                <a class="nav-item">
                  <span class="icon">
                    <i class="fa fa-facebook"></i>
                  </span>
                </a>
                <a class="nav-item">
                  <span class="icon">
                    <i class="fa fa-instagram"></i>
                  </span>
                </a>
<!--                <a class="nav-item">-->
<!--                  <span class="icon">-->
<!--                    <i class="fa fa-twitter"></i>-->
<!--                  </span>-->
<!--                </a>-->
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
<!--                        <p class="control">-->
<!--                            <a class="button is-primary is-outlined" href="index.php?r=site/register">-->
<!--                            <span class="icon">-->
<!--                              <i class="fa fa-pencil"></i>-->
<!--                            </span>-->
<!--                                <span>Register</span>-->
<!--                            </a>-->
<!--                        </p>-->
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
  $(".nav-toggle").click(function () {
    $(".nav-menu").toggleClass("is-active");
  });
</script>