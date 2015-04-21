<div class="list-deal-item clearfix">
    <div class="img-deal-item">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('site/specialDetail', array('slug' => $data->slug)); ?>">
            <img src="<?php echo ImageHelper::getImageUrl($data, 'featured_image', 'thumb1');?>" alt="<?php echo $data->title; ?>"/>
        </a>
    </div>
    <div class="info-deal-item">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('site/specialDetail', array('slug' => $data->slug)); ?>"><?php echo $data->title; ?></a>
        <p><?php echo StringHelper::createShort($data->content, 200); ?></p>
    </div>
    <div class="price-deal-item">
        <p class="price1"><strong>RETAIL:</strong> <?php echo Yii::app()->format->price($data->retail_price); ?></p>
        <p class="price2">NOW: <?php echo Yii::app()->format->price($data->now_price); ?></p>
        <a href="#" role="button" class="l-now snatch-now" itemid="<?php echo $data->id; ?>">SNATCH NOW!</a>
    </div>
</div>