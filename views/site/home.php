<?php
    $this->title = Yii::t('app', 'Home');
    foreach (Yii::$app->params["topmenu"] as $item): ?>
<h1 class="title"><?= Yii::t('app', $item) ?></h1>
    <?php
    $user = Yii::$app->session->get("user");
    $models = \app\models\Menu::find();
    $models->andWhere(["parent" => $item]);
    switch ($user->role) {
        case "U":
            $models->andWhere("role in(:role1, :role2)", [":role1" => "*", ":role2" => "U"]);break;
        case "M":
            $models->andWhere("role in(:role1, :role2, :role3)", [":role1" => "*", ":role2" => "U", ":role3" => "M"]);break;
    }

    $models = $models->all();
    if(isset($models)) : ?>
        <div class="columns">
        <?php foreach ($models as $key => $model) : ?>
            <div class="column">
                <a href="index.php?r=<?= $model->url ?>" class="is-fullwidth button is-primary"><?= $model->label ?></a>
            </div>
        <?php endforeach; ?>
        </div>
        <?php endif; ?>
    <?php endforeach; ?>