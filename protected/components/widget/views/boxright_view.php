<div class="main-r">
    <div class="box1-right">
        <?php 
        $smartblock =  SmartBlock::model()->findByPk(45);
        if(!empty($smartblock))
            echo $smartblock->content;
        ?>
        <!-- <h3 class="ttl-1">July 2014 Giveaways</h3>
        <div class="infobox1-r clearfix">
            <div class="img-box">
                <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/img1.jpg" alt=""/></a>
            </div>
            <div class="des-box1-r">
                <h3>Pellentesque Adipiscing Augue Erat Lorem</h3>
                <p class="t-blue">BE 1 of 10 WINNERS!</p>
                <p>Vestibulum ac hendrerit erat. Sed eget augue vel elit lorem tristique dictum!</p>
                <a href="#" class="v-more">VIEW MORE</a>
            </div>
        </div> -->
    </div>
    
    <?php 
    $listadsbanner = HomeBlock::getAdsBanner();
    if(!empty($listadsbanner))
    {
        foreach ($listadsbanner as $one) 
        {
            if(empty($one)) continue;
            echo '<div class="box2-adv-right">
                    <a target="_blank" href="'.$one->link.'"><img src="'.ImageHelper::getImageUrl($one, 'image', HomeBlock::SIZE1).'" alt=""/></a>
                </div>';
        }
    }

    ?>
    <!-- <div class="box2-adv-right">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/img2.jpg" alt=""/></a>
    </div>
    
    <div class="box2-adv-right">
        <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/img3.jpg" alt=""/></a>
    </div> -->
    
    <div class="box3-share-right">
        <?php if (Yii::app()->params['facebook'] != '') { ?>
            <div class="fb-like-box" data-href="<?php echo Yii::app()->params['facebook']; ?>" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="true" data-show-border="true"></div>
        <?php } ?>
    </div>
</div><!-- box main right -->