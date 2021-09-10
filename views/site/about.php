<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Обо мне';
$this->params['breadcrumbs'][] = $this->title;
?>
<head><script src="https://unpkg.com/delaunator@5.0.0/delaunator.min.js"></script></head>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    $options = ['rel' => 'stylesheet',
        'noscript' => true,
        'condition' => 'lt IE 9',
    ];

    $this->registerCss("body {
    background-color: #FFFFFF;
    margin: 0;
    overflow: hidden;
}

canvas {
    position: absolute;
    backface-visibility: hidden;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
}

img {
    position: absolute;
    -webkit-transition:opacity .3s;
    transition:opacity .3s;
}

#container {
    position: absolute;
    width: 768px;
    height: 432px;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    margin: auto;
}");

?>
    <p>
    <div id="container"></div>
       Created by Stanislav Gvozdilin.
    </p>
</div>
