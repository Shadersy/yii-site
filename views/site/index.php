<?php

/* @var $this yii\web\View */


use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>

<div class="site-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-5">
                <?php foreach($posts as $post) : ?>
                <h2><?= $post->name ?></h2>
                <p><?= $post->description?></p>
                <p>
                    <?= Yii::$app->user->isGuest ? ''
                        :
                        '<a class="btn btn-outline-secondary" href=' . \yii\helpers\Url::to(['post/edit', 'id' => $post->id]) .'>Изменить</a>'; ?>

                    <?= !array_key_exists('admin', Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())) ?  '' :
                    '<a class="btn btn-outline-secondary" href=' . \yii\helpers\Url::to(['post/remove', 'id' => $post->id]) .'>Удалить</a>'; ?>
                </p>
        <?php endforeach; ?>


    <div class="pagination">
        <div class="nav-links">
            <?=  LinkPager::widget([
                'pagination' => $pages,
            ]) ?>
        </div>
    </div>
    </div>
        </div>
    </div>
</div>


