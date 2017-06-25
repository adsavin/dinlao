<?php
/* @var $this yii\web\View */
$this->beginContent('@app/views/layouts/main.php'); ?>
    <div class="container">
        <a href="index.php" class="nav-item has-shadow is-outlined is-hidden-mobile" style="position: absolute;z-index: 33">
            <img class="" src="image/logo.jpg" alt="DINDEE.COM" style="max-height: 9rem;box-shadow: 0 2px 3px rgba(10, 10, 10, 0.1);">
        </a>
    </div>
    <nav class="nav has-shadow">
        <div class="container">
<!--            <div class="nav-left">-->
<!--                <a class="nav-item" href="home.php">-->
<!--                  <span class="icon">-->
<!--                    <i class="fa fa-home"></i>-->
<!--                  </span>-->
<!--                </a>-->
<!--            </div>-->
<!---->
<!--            <div class="nav-center">-->
<!--                <a class="nav-item">-->
<!--                    <img src="" alt="DINDEE.COM">-->
<!--                </a>-->
<!--            </div>-->

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
                            <a class="button is-danger is-outlined" href="index.php?r=site/logout">
                                <span class="icon">
                                  <i class="fa fa-sign-out"></i>
                                </span>
                                <span>Sign Out</span>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </nav>
<div class="hero is-primary">
    <div class="hero-body"></div>
</div>
<div class="container">
    <div class="columns">
        <div class="column is-12 has-text-right" style="margin-top: 20px">
            <a href="home.php">
              <span class="icon">
                <i class="fa fa-home"></i>
              </span> Home
            </a>
            <?php
            if(isset($this->params['breadcrumbs']))
            foreach ($this->params['breadcrumbs'] as $k => $b) : ?>
                >
                <?php if(isset($b["url"])) {
                    echo \yii\helpers\Html::a($b["label"], $b["url"]);
                } else echo $b; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="columns">
        <div class="column is-3">
            <div class="columns">
                <div class="column is-11">
                    <div class="columns">
                        <div class="column is-12 box">
                            <aside class="menu">
                                <p class="menu-label">
                                    <?= Yii::t('app', 'Favorite') ?>
                                </p>
                                <ul class="menu-list">
                                    <li><a href="index.php?r=product/createLand"><?= Yii::t('app', 'Post New Land') ?></a></li>
                                    <li><a href="index.php?r=product/createHouse"><?= Yii::t('app', 'Post New House') ?></a></li>
                                    <li><a href="index.php?r=product/index"><?= Yii::t('app', 'View Post') ?></a></li>
                                </ul>
                                <!--                            <p class="menu-label">-->
                                <!--                                Administration-->
                                <!--                            </p>-->
                                <!--                            <ul class="menu-list">-->
                                <!--                                <li><a>Team Settings</a></li>-->
                                <!--                                <li>-->
                                <!--                                    <a class="is-active">Manage Your Team</a>-->
                                <!--                                    <ul>-->
                                <!--                                        <li><a>Members</a></li>-->
                                <!--                                        <li><a>Plugins</a></li>-->
                                <!--                                        <li><a>Add a member</a></li>-->
                                <!--                                    </ul>-->
                                <!--                                </li>-->
                                <!--                                <li><a>Invitations</a></li>-->
                                <!--                                <li><a>Cloud Storage Environment Settings</a></li>-->
                                <!--                                <li><a>Authentication</a></li>-->
                                <!--                            </ul>-->
                                <p class="menu-label">
                                    <?= Yii::t('app', 'Administration') ?>
                                </p>
                                <ul class="menu-list">
                                    <li><a href="index.php?r=product" class=""><?= Yii::t('app', 'Products') ?></a></li>
                                    <li><a href="index.php?r=user"><?= Yii::t('app', 'Users') ?></a></li>

                                    <li><a href="index.php?r=product-type"><?= Yii::t('app', 'Product Types') ?></a></li>
                                    <li><a href="index.php?r=unit"><?= Yii::t('app', 'Unit') ?></a></li>
                                    <li><a href="index.php?r=province"><?= Yii::t('app', 'Province') ?></a></li>
                                    <li><a href="index.php?r=district"><?= Yii::t('app', 'District') ?></a></li>

                                    <li><a href="index.php?r=currency"><?= Yii::t('app', 'Currency') ?></a></li>
                                    <li><a href="index.php?r=doc-type"><?= Yii::t('app', 'Document') ?></a></li>
                                </ul>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-9 box">
            <div class="columns">
                <div class="column is-12">
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>