<?php
use yii\helpers\Html;
?>

<h1>Товары</h1>

<div class="content">
    <div class="left">
        <ul>
            <h4>Категории:</h4>
            <?= \app\components\MenuWidget::widget(['tpl' => 'menu']) ?>
        </ul>
    </div>
    <div class="center">
        <div class="pictures">

           <?php if(count($model)): ?>
                <?php foreach ($model as $product): ?>

                    <div class="block">
                        <?php if(!empty($product->image)): ?>
                            <?= Html::img("@web/uploads/{$product->image}", ['alt' => $product->title]) ?>
                        <?php else:?>
                            <?= Html::img("@web/uploads/no-image.png", ['alt' => $product->title]) ?>
                        <?php endif; ?>

                        <div class="text">
                            <h2>Цена: <span><?= $product->price ?></h2>
                            <h3><a href="<?= \yii\helpers\Url::to(['product/view', 'id'
                            => $product->id]) ?>"><?= $product->title ?></a></h3>
                        </div>
                    </div>

                <?php endforeach ?>
            <?php endif; ?>
        </div>
    </div>
</div>


