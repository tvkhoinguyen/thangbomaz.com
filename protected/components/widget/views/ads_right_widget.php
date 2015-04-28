 <script type="text/javascript" src="plugins/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/cycle-plugin.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  
  $("#neoslideshow").cycle({fx:'scrollDown'});
  $("#neoslideshow2").cycle({fx:'scrollUp'});
  });
</script>
<?php /*
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
  $(function() {
  // $('.neoslideshow img:gt(0)').hide();
  setInterval(function(){
        // $('.neoslideshow img:gt(0)').hide();
        $('.neoslideshow :first-child').fadeOut()
           .next('img').fadeIn()
           .end().appendTo('.neoslideshow');}, 
        3500);
  })
</script>
<script type="text/javascript">
  $(function() {
  // $('.neoslideshow1 img:gt(0)').hide();
  setInterval(function(){
        // $('.neoslideshow1 img:gt(0)').hide();
        $('.neoslideshow1 :first-child').fadeOut()
           .next('img').fadeIn()
           .end().appendTo('.neoslideshow1');}, 
        3500);
  })
</script>
*/?>

<style type="text/css">
  .neoslideshow {position:relative; width:300px; height:260px;}
  .neoslideshow img {position:absolute;left:0; top:0;}

  .neoslideshow1 {position:relative; width:500px; height:260px;}
  .neoslideshow1 img {position:absolute;left:0; top:0;}
  
  /* General button style (reset) */
      .btn {

        background: #4d90fe;
        text-decoration: none;

        cursor: pointer;

        padding: 10px 10px 10px 10px;
        display: inline-block;
        margin: 1px 5px 0px 5px;

        outline: none;
        position: relative;
        border: 2px solid #fff;
        float:left;
      }

      .btn > a{
        font: 16px Arial, Helvetica, sans-serif;
        color: #fff;
        font-weight: 700;
        letter-spacing: 1px;
        text-decoration: none;
      }
      .btn:hover {
        text-decoration: underline;
      }
</style>
<!-- slot 1 -->
<div id="neoslideshow" class="neoslideshow" style="height: 420px;">
    <?php
      $criteria = new CDbCriteria();
      $criteria->addCondition('type="khungbanner1"');
      $criteria->order ="id DESC";
      $listmodel = KhungBanner1::model()->findAll($criteria);
      // echo count($listmodel);
      foreach ($listmodel as $one) {
        if(!empty($one))
        {
          ?>
          <a target="_blank" href="<?php echo $one->link; ?>">
          <img src="<?php echo ImageHelper::getImageUrl($one,"image", KhungBanner1::SIZE); ?>" width="300" height="400" />
          </a>
          <?php 
        }
      }
     ?>
      <!-- <img src="images/slide1.jpg" width="300" height="400" />
      <img src="images/slide2.jpg" width="300" height="400" />
      <img src="images/slide3.jpg" width="300" height="400" />
      <img src="images/slide4.jpg" width="300" height="400" />
      <img src="images/slide5.jpg" width="300" height="400" />
      <img src="images/slide6.jpg" width="300" height="400" /> -->
</div>
<!-- end slot 1 -->


<!-- slot raovat -->
<div class="rcol-box">
  <div class="rcol-title">
    <img class="rcol-icon" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/raovat.png" width="60px"/><br />
    <a target="_blank" href="http://raobanusa.com">
      <div style="margin-top: 10px;"><font size="+1" color="#fff">Tin rao vặt</font></div>
    </a>
  </div>
  <div id="neoslideshow" class="neoslideshow" style="height: 700px;margin-top:15px">
    
      <div>
      <?php
      // set HTTP header
      $headers = array(
          'Content-Type: application/json'
      );
      // set POST params
      $fields = array(
          // 'key' => '<your_api_key>',
          'format' => 'json',
          'ip' => $_SERVER['REMOTE_ADDR'],
      );
      $url = LINK_WEB_SERVICE;
      // Open connection
      $ch = curl_init();
      // Set the url, number of POST vars, POST data
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );

      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      // curl_setopt($ch, CURLOPT_POSTFIELDS, $fields );
      $result = curl_exec($ch);
      curl_close($ch);
      $result_arr = json_decode($result, true);
      foreach ($result_arr as $one) 
      {
        // echo '<pre>';
        // print_r($one->title);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($one['title']);
        // echo '</pre>';

        if( !empty($one) )
        {
          if(!empty($one['city']))
            $address = $one['state']. ' -> '.$one['city'];
          else
            $address = $one['state'];
          echo '<div class="btn"><a target="_blank" href="'.$one['link'].'">'.$one['title'].' ('.$address.') - '.$one['phone'].'</a></div>';
        }
      }
      // echo '<pre>';
      // print_r($result_arr);
      // echo '</pre>';
      ?>
      <!-- <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div>
      <div class="btn"><a href="">Cần thợ nail gấp! (CA -> City) - (480) 142 2145</a></div> -->
      
    </div>


</div>
</div>
<!-- end slot raovat -->


<!-- slot 2 -->
<div class="rcol-box" style="margin: 0 0 0 0">
  <div class="rcol-title"><img class="rcol-icon" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/youtube.png" width="60px"/><br />
    <a target="_blank" href="<?php echo Yii::app()->setting->getItem('link_see_us_youtube'); ?>">
      <div style="margin-top: 10px;"><font size="+1" color="#fff">Phóng sự Video</font></div>
    </a>
  </div>
  <?php 
  $linkseeus = Yii::app()->setting->getItem('link_see_us_youtube'); 
  if(!empty($linkseeus))
  {
     $arr = explode('?v=', $linkseeus);
     if(!empty($arr[1]))
     {
        ?>
        <div class="rcol-content">
          <iframe width="280" height="300" src="//www.youtube.com/embed/<?php echo $arr[1]; ?>" frameborder="0" allowfullscreen></iframe> 
        </div>
        <?php
     }
  }
  ?>
</div>
<!-- end slot 2 -->



<div style="height: 420px; width= 320px;">
<script type="text/javascript">
    google_ad_client = "ca-pub-9511385175886331";
    google_ad_slot = "7170991209";
    google_ad_width = 300;
    google_ad_height = 400;
</script>
<!-- Ad thangbomaz.com 03 -->
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<!-- Google Adsense -->



<!-- End of GG Adsense-->

<!-- slot 3 -->
<div id="neoslideshow2" class="neoslideshow" style="height: 420px;">

    <?php
      $criteria = new CDbCriteria();
      $criteria->addCondition('type="khungbanner2"');
      $criteria->order ="id DESC";
      $listmodel = KhungBanner2::model()->findAll($criteria);
      // echo count($listmodel);
      foreach ($listmodel as $one) {
        if(!empty($one))
        {
          ?>
          <a target="_blank" href="<?php echo $one->link; ?>">
          <img src="<?php echo ImageHelper::getImageUrl($one,"image", KhungBanner2::SIZE); ?>" width="300" height="400" />
          </a>
          <?php 
        }
      }
     ?>
</div>
<!-- end slot 3 -->


<!-- slot 4 -->
<div class="rcol-box">
       <div class="rcol-title"><img class="rcol-icon" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/facebook.png" width="60px"/> <h3>Cảm nhận</h3></div>
       <div class="rcol-content">
        <script type="text/javascript">
         (function(d, s, id) {
           var js, fjs = d.getElementsByTagName(s)[0];
           if (d.getElementById(id)) return;
           js = d.createElement(s); js.id = id;
           js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1454443401486652&version=v2.0";
           fjs.parentNode.insertBefore(js, fjs);
         }(document, 'script', 'facebook-jssdk'));
         </script>
           <div class="fb-like-box" data-href="<?php echo Yii::app()->setting->getItem('facebook'); ?>" 
                 data-width="280" data-height="320" data-show-faces="true" data-stream="false" data-header="false">
           </div>
       </div>
     </div><!--end cam nhan