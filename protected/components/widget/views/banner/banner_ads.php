<div class="train">
    <?php echo CHtml::image(ImageProcessing::bindImage("/upload/".IsaAdsBanner::$folderUpload."/".IsaAdsBanner::$folderAds."/".$adsTop->imageFile), "image",array('alt'=>$adsTop->title));?>
    <span class="text"><?php echo $adsTop->title?></span>
    <div class="learn">
        <a href="<?php echo $adsTop->link;?>">Learn More</a>
    </div>
</div>
<div class="lst">
    <div class="lea">
        <?php echo CHtml::image(ImageProcessing::bindImage("/upload/".IsaAdsBanner::$folderUpload."/".IsaAdsBanner::$folderAds."/".$adsLeft->imageFile), "image",array('alt'=>$adsLeft->title));?>
        <span class="leag"><?php echo $adsLeft->title?></span>
        <span class="learn1">
            <a href="<?php echo $adsLeft->link;?>">LEARN MORE</a>
        </span>
    </div>
    <div class="lea">
        <?php echo CHtml::image(ImageProcessing::bindImage("/upload/".IsaAdsBanner::$folderUpload."/".IsaAdsBanner::$folderAds."/".$adsRight->imageFile), "image",array('alt'=>$adsRight->title));?>
        <span class="leag"><?php echo $adsRight->title?></span>
        <span class="learn1">
            <a href="<?php echo $adsRight->link;?>">LEARN MORE</a>
        </span>
    </div>
</div>