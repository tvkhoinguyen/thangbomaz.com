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
    <script type="text/javascript">         
        google_ad_client = "ca-pub-9511385175886331";           
        google_ad_slot = "8789912401";          
        google_ad_width = 300;          
        google_ad_height = 100;         
    </script>           
    <!-- Ad thangbomaz.com 01 -->           
    <script type="text/javascript"          
    src="//pagead2.googlesyndication.com/pagead/show_ads.js">           
    </script>           
    <!-- <img src="<?php echo $link_right; ?>" height="100px" width="368px"/> -->
</div>

<div class="hd-bg"></div>