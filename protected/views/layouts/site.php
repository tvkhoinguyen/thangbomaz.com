<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" class="js cssanimations csstransitions">
<head>
     <?php include_once '_head.php';?>
</head>

<body>
<div class="container">
      <div id="header">
            <?php include('_header.php'); ?>
      </div>


      <div style="margin: 102px 0 0 0">
            <?php include('inc/_menu.php'); ?>
      </div>

      <!-- Main content -->
        <div id="maincontent" style="margin-top: 17px;">
                <?php 
                  echo $content;
                ?>
        </div>
</div>


<?php /*
<div id="leftBanner1Ky" style="top:180px; position: fixed;">
  <?php 
  $scroll = ScrollBanner::model()->findByPk(3);
  ?>
      <a href="<?php echo $scroll->link; ?>" target="_blank"> 
        <img src="<?php echo ImageHelper::getImageUrl($scroll, "image", ScrollBanner::SIZE); ?>" width="160" height="300" />
      </a>
</div>  
<div id="rightBanner1Ky" style="top: 180px; position: fixed; left: 1183px;">
  <?php 
  $scroll = ScrollBanner::model()->findByPk(4);
  ?>
      <a href="<?php echo $scroll->link; ?>" target="_blank"> 
        <img src="<?php echo ImageHelper::getImageUrl($scroll, "image", ScrollBanner::SIZE); ?>" width="160" height="300" />
      </a>
</div>
<script type="text/javascript">
var tableWidth = 1000;
var leftBanner = document.getElementById('leftBanner1Ky');
var rightBanner = document.getElementById('rightBanner1Ky');
var bannerWidth = 170;
getWindowWidth = function(){
  if (self.innerHeight){
    return self.innerWidth;
  }
  else if (document.documentElement && document.documentElement.clientHeight){
    return document.documentElement.clientWidth;
  }
  else if (document.body){
    return document.body.clientWidth;
  }
}
reCalculateBannerPosition = function(){
  var windowWidth = getWindowWidth();
  var remainW = windowWidth - tableWidth;
  if(remainW>=0){
    var space = remainW/2;
    var ll = space - bannerWidth;
    var rl = space + tableWidth;
    leftBanner.style.left = ll+'px';
    rightBanner.style.left = rl+'px';
    leftBanner.style.display = '';
    rightBanner.style.display = '';
  }else{
    leftBanner.style.display = 'none';
    rightBanner.style.display = 'none';
  }
}
window.onresize = function(event) {
  reCalculateBannerPosition();
}
//cai nay bac cho vao ready
reCalculateBannerPosition();
</script>
*/?>

<!-- Footer -->
    <div style="clear: both;"></div>
    <div id="footer">
        <?php include('_footer.php'); ?>
    </div>


</body>
</html>