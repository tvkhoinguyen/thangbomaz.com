<?php if(is_array($data) && count($data)>0): ?>
<div class="box3-left">
    <h3 class="ttl-4">Lifestyle</h3>
    <div class="box-life">
        <ul class="bxslider clearfix">
            <?php foreach($data as $key=> $item):
                   $src     = ImageHelper::getImageUrl($item, 'featured_image', '118x119'); 
                   $link    = Yii::app()->createAbsoluteUrl('site/lifestyleDetail', array('slug' => $item->slug));
                   $content = StringHelper::createShort(strip_tags(nl2br($item->content)), 50);
                   $date    = Yii::app()->format->date($item->created_date);
                   $title   = $item->title;
            ?>
            <li>
                <div class="item-life">
                    <a  href="<?php echo $link; ?>"><img src="<?php echo $src; ?>" alt=""/></a>
                    <div class="des-life">
                        <span class="date"><?php echo $date; ?></span>
                        <a href="<?php echo $link; ?>" class="l-pro"><?php echo $title; ?></a>
                        <p><?php echo  $content ?></p>
                        <a href="<?php echo $link; ?>" class="v-more">READ MORE</a>
                    </div>
                </div>
            </li>
            <?php endforeach; ?> 
        </ul>
    </div>
</div>
<?php endif; ?> 