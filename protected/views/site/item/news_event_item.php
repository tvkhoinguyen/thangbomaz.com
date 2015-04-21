<div class="list-l-style-item  clearfix">
        <div class="img-l-style">
            <a href="<?php echo Yii::app()->createAbsoluteUrl('site/newsEventDetail', array('slug' => $data->slug)); ?>">
                <img src="<?php echo ImageHelper::getImageUrl($data, 'featured_image', 'thumb1');?>" alt="<?php echo $data->title; ?>"/>
            </a>
        </div>
        <div class="info-l-style">
            <a href="<?php echo Yii::app()->createAbsoluteUrl('site/newsEventDetail', array('slug' => $data->slug)); ?>" class="l-pro"><?php echo $data->title; ?></a>
            <p><?php echo $data->short_content; ?></p>
            <a href="<?php echo Yii::app()->createAbsoluteUrl('site/newsEventDetail', array('slug' => $data->slug)); ?>" class="l-detail">VIEW DETAILS</a>
        </div>
</div>