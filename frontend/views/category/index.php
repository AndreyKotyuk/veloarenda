<?php


use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="categories-index">
    <?php foreach ($categories as $category) { ?>
        <div>
        <h2>
            <?= $category->name ?>
        </h2>
        <p>
            <?= $category->price_for_1_hour ?>
        </p>
        <?= Html::img($category->getImage(), ['width' => 150]) ?>
        </div>
        <hr>
    <?php } ?>
</div>
