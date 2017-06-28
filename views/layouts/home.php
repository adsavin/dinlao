<?php
/* @var $this yii\web\View */
$this->beginContent('@app/views/layouts/main.php'); ?>
    <div class="container">
        <a href="index.php" class="nav-item has-shadow is-outlined is-hidden-mobile" style="position: absolute;z-index: 33">
            <img class="" src="image/logo.png" alt="DINDEE.COM" style="max-height: 9rem;">
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
                    <span>Welcome, <?php echo Yii::$app->session->get("username") ?> </span>
                </div>
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
              </span> <?= Yii::t('app','Home') ?>
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
                                <?php
                                $user = Yii::$app->session->get("user");
                                $parents = ["Favorite", "Profile", "Web Master", "Administration"];
                                foreach ($parents as $parent) :
                                    $criteria = \app\models\Menu::find();
                                    $criteria->where(["parent" => $parent]);
                                    if($user->role == "A") {
                                        $criteria->andWhere("role in (:role1, :role2, :role3)", [":role1" => "*", ":role2"=>"M", ":role3" => "A"]);
                                    } else {
                                        $criteria->andWhere("role in (:role1, :role2)", [":role1" => "*", ":role2" => $user->role]);
                                    }
                                    $menus = $criteria->all();
                                    if(isset($menus))  :
                                        if(count($menus) == 0) continue;
                                        ?>
                                        <p class="menu-label">
                                            <?= Yii::t('app', $parent) ?>
                                        </p>
                                        <ul class="menu-list">
                                            <?php foreach ($menus as $menu) :  ?>
                                                <li><a href="index.php?r=<?= $menu->url ?>"><?= Yii::t('app', $menu->label) ?></a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php
                                    endif;
                                endforeach;
                                ?>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="column is-9 box">
            <div class="columns">
                <div class="column is-12">
                    <?php
                    foreach (["warning", "info", "success", "danger"] as $class) :
                        $flash = Yii::$app->session->getFlash($class);
                        if(isset($flash)): ?>
                            <div class="notification is-<?= $class ?>"><?= Yii::t("app", $flash) ?></div>
                            <?php
                        endif;
                    endforeach;
                    ?>
                    <?= $content ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>