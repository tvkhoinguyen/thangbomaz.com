<div class="slider-wrapper theme-default">
    <?php if(count($data)>0): ?>
    <div id="slider" class="nivoSlider">
        <?php
        foreach ($data as $itemBanner){
            echo CHtml::image(ImageProcessing::bindImage("/upload/".Banners::$folderUpload."/".Banners::$folderMainBanner."/".$itemBanner->imageFile), "image",array('title'=>'#htmlcaption'.$itemBanner->id,'alt'=>$itemBanner->banner_title));
        }
        ?>
    </div>
    <?php
    foreach ($data as $itemBanner){
        ?>
        <div id="htmlcaption<?php echo $itemBanner->id;?>" class="nivo-html-caption">
            <h4><?php echo $itemBanner->banner_description;?></h4>
            <div class="play"><h3><?php echo $itemBanner->banner_title;?></h3></div>
            <?php if(!empty($itemBanner->link)){?>
            <div class="learnmore">
                <a href="<?php echo $itemBanner->link;?>" target="_blank"><?php echo $itemBanner->link_text;?></a>
            </div>
            <?php } ?>
        </div>
        <?php
    }
    ?>
    <?php endif; ?>
</div>