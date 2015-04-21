<?php $list_ads = HomeBlock::getAdsBanner("service");
if(!empty($list_ads))
{
    foreach ($list_ads as $one) 
    {
        ?>
        <div class="bn-small-2">
            <a target="_blank" href="<?php echo $one->link; ?>">
                    <span class="image"><img src="<?php echo ImageHelper::getImageUrl($one, "image", HomeBlock::SIZE2 ); ?>" alt="banner" /></span>
                <span class="title"><?php echo $one->title; ?>
                	<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/ico-arrow.png" alt="icon" />
                </span>
            </a>
        </div>
        <?php
    }
} ?>

<!-- 
<div class="bn-small-2">
    <a href="#">
            <span class="image"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bn-small-1.jpg" alt="banner" /></span>
        <span class="title">You may view our business card price list here &nbsp;<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/ico-arrow.png" alt="icon" /></span>
    </a>
</div>
<div class="bn-small-2">
    <a href="#" class="mask-2">
            <span class="image"><img src="<?php echo Yii::app()->theme->baseUrl;?>/img/bn-small-2.jpg" alt="banner" /></span>
        <span class="title">Looking for something else? You may contact us for a FREE quotation</span>
    </a>
</div> -->