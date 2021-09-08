<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model app\models\PostForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\captcha\Captcha;
use yii\helpers\Url;

$this->title = 'My Yii Application';
?>

<div class="site-index">

    <div class="jumbotron text-center bg-transparent">

        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-center">
                    <table id="table_id" class="table table-striped">
                        <thead>
                        <tr>
                            <th scope='col'> Заголовок</th>
                            <th scope='col'> Автор</th>
                            <th scope='col'> Описание</th>
                            <th scope='col'></th>
                            <th scope='col'></th>
                            </tr>
                        </thead>

                        <tbody>
            <?php foreach($posts as $post) : ?>
                <tr>
                    <td class='card-text'><?= $post->name ?></td>
                    <td><?= $post->user->email ?></td>
                    <td><?= $post->description ?> </td>
                    <td>
                        <?= Yii::$app->user->isGuest ? '' :
                        '<a class="btn btn-outline-secondary" href=' . \yii\helpers\Url::to(['post/edit', 'id' => $post->id]) . '>Изменить</a>'; ?>
                    </td>
                    <td>
                        <?= !array_key_exists('admin', Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())) ? '' :
                        '<a class="btn btn-outline-secondary" href=' . \yii\helpers\Url::to(['post/remove', 'id' => $post->id]) . '>Удалить</a>'; ?>
                        </td>
                </tr>
                        <?php endforeach; ?>
                </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="pagination">
            <div class="nav-links">
                <?=\yii\widgets\LinkPager::widget(['pagination' => $pages]) ?>
            </div>
        </div>
        <a class="btn btn-outline-secondary" href=<?=\yii\helpers\Url::to(['post/new']); ?>>Создать новый пост</a>
        </p>

    </div>

    <div class="body-content">

        </div>

    </div>
</div>
