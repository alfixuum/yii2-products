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

            <div class="leftt">
                <?php if(!empty($product->image)): ?>
<!--                    --><?//= Html::img("@web/uploads/{$product->image}", ['alt' => $product->title]) ?>
                    <?= Html::img($mainIMG->getUrl(), ['alt' => $product->title]) ?>
                <?php else:?>
                    <?= Html::img("@web/uploads/no-image.png", ['alt' => $product->title]) ?>
                <?php endif; ?>
            </div>
            <div class="right">
                <div class="title">
                    <h2> <?= $product->title ?></h2>
                    <h3>Цена: <span><?= $product->price ?></h3>
                </div>
               <div class="description">

                    <h4><?= $product->description ?></a></h4>
               </div>
            </div>
        </div>
        <?php $count = count($gallery); $i=o;  foreach($gallery as $img): ?>
            <?php if ($i % 3 == 0):?>
                <div class="hovergallery <?php if($i == 0) echo 'active'?>">
            <?php endif;?>
                <a href=""><?= Html::img($img->getUrl('84x85'), ['alt' => '']) ?></a>
            <?php $i++;  if ($i % 3 == 0 || $i == 0):?>
                </div>
            <?php endif;?>
        <?php endforeach; ?>

    </div>
</div>

<?php
$mainIMG = $product-> getImage();
$gallery = $product-> getImages();
?>

