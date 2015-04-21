<div class="list-l-style-item  clearfix">
    <div class="img-l-style">
        <a href="<?php echo Yii::app()->createAbsoluteUrl('site/lifestyleDetail', array('slug' => $data->slug)); ?>">
            <img src="<?php echo ImageHelper::getImageUrl($data, 'featured_image', 'thumb1');?>" alt="<?php echo $data->title; ?>"/>
        </a>
    </div>
    <div class="info-l-style">
        <span class='date'><?php echo Yii::app()->format->date($data->created_date); ?></span>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('site/lifestyleDetail', array('slug' => $data->slug)); ?>" class="l-pro"><?php echo $data->title; ?></a>
        <p><?php echo StringHelper::createShort($data->content, 200); ?></p>
        <a href="<?php echo Yii::app()->createAbsoluteUrl('site/lifestyleDetail', array('slug' => $data->slug)); ?>" class="v-more">READ MORE</a>
    </div>
</div>