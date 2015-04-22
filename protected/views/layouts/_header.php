<div class="toplink">
    <!-- <p id="clockbox" style="font:Arial; color:#fff;"></p> -->
    <div class="userpanel">
        <!-- <a href="#">Đăng nhập</a><a href="#">Đăng ký</a> -->
    </div>
</div><!-- end top link-->

<?php /*
 <div class="logo"style="margin: -20px 0 0 0">
 <?php 
    $top_left = TopBannerLeft::model()->findByPk(1);
    $link = ImageHelper::getImageUrl($top_left, "image", TopBannerLeft::SIZE);
 ?>
    <img src="<?php echo $link; ?>" height="120px" width="680px"/>
</div>
*/?>


<div class="logo"style="margin-top: -20px;">
    <?php 
    $top_left = TopBannerLeft::model()->findByPk(1);
    $link = ImageHelper::getImageUrl($top_left, "image", TopBannerLeft::SIZE);
    ?>
    <img src="<?php echo $link; ?>" height="120px" width="680px"/>
</div>
<div class="top-ads"style="margin-top: -20px;">
    <?php 
    //quang cao google
    // $top_right = TopBannerRight::model()->findByPk(2);
    // $link_right = ImageHelper::getImageUrl($top_right, "image", TopBannerRight::SIZE);
    ?>
    <a target="_blank" href="http://raobanusa.com"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/tb_raovat_logo.png" width="300px" height="120px"></a>
    <!-- <img src="<?php echo $link_right; ?>" height="120px" width="300px"/> -->
</div>

<div class="hd-bg"></div>