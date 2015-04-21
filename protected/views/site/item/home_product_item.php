<div class="list-news-item  clearfix">
        <div class="img-list-news">
            <a href="<?php echo Yii::app()->createAbsoluteUrl('site/homeProductDetail', array('slug' => $data->slug)); ?>">
                <img src="<?php echo ImageHelper::getImageUrl($data, 'featured_image', 'thumb1');?>" alt="<?php echo $data->name; ?>"/>
            </a>
        </div>
        <div class="info-list-news">
             <a href="<?php echo Yii::app()->createAbsoluteUrl('site/homeProductDetail', array('slug' => $data->slug)); ?>" class="l-news"><?php echo $data->name; ?></a>
                <ul>
                <li><?php echo $data->address; ?></li>
                <li>Tel: <?php echo $data->telephone; ?><br/><a href="<?php echo $data->website; ?>"><?php echo $data->website; ?></a></li>
            </ul>
            <p><?php echo StringHelper::createShort($data->description, 100); ?></p>
            <p class="text-right"><a href="<?php echo Yii::app()->createAbsoluteUrl('site/homeProductDetail', array('slug' => $data->slug)); ?>" class="l-detail">VIEW MORE</a></p>
        </div>
    </div>

