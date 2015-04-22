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

      <!-- left -->
      <div id="leftcol-subnews">
        <div class="main-cat-hotnews" style="margin: 5px 0 0 0; float: left">
            <h3 class="main-daotao"> 
                  <span class="main-cat-title-subnews">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/news.png" />
                    <?php echo $model->getCategoryNameDetail(); ?>
                  </span>
            </h3>      
            <br/>
            
            <font size="+3" color="#C30006" face="Arial"><?php echo $model->title; ?></font>
                <br /><br/>
                <I>Cập nhật lúc <?php echo DateHelper::toDateTimePickerFormat($model->updated_date); ?> </I>
                <?php 
                $image_share = ImageHelper::getImageUrl($model, "image", ThoiSu::SIZE1);
                $url_share = Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug' => $model->slug));

                  MyFunctionCustom::registerOpenGraph('og:image', $image_share);
                  MyFunctionCustom::registerOpenGraph('og:url', $url_share);
                  MyFunctionCustom::registerOpenGraph('og:title', $model->title);
                  MyFunctionCustom::registerOpenGraph('og:description', strip_tags($model->short_content));
                  $href_share = "https://www.facebook.com/sharer/sharer.php?u=".$url_share;
                ?>
                <br/>
                <a href="javascript:void(0);" onclick="javascript:window.open('<?php echo $href_share; ?>', '_blank', 'width=700,height=500');void(0);">
                    <span class="ico-share"><img src="<?php echo Yii::app()->theme->baseUrl."/img/btn_fb_55px.gif"; ?>" /></span>
                </a>
                <div class="fb-like" data-href="<?php echo $url_share; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                <div style="padding-right: 20px; font-family: Arial;">
                  <?php echo $model->content; ?>
                </div>
                <br/>
                <div class="fb-like" data-href="<?php echo $url_share; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
        <div style="float:left; margin-top: 10px; margin-bot: 10px;">
        <script type="text/javascript">
            google_ad_client = "ca-pub-9511385175886331";
            google_ad_slot = "6288393604";
            google_ad_width = 740;
            google_ad_height = 100;
        </script>
        <!-- Ad thangbomaz.com 05 -->
        <script type="text/javascript"
        src="//pagead2.googlesyndication.com/pagead/show_ads.js">
        </script>
      </div>
          <div class="main-cat-subnews" style="margin: 17px 10px 0 0">
                <div class="main-cat-subnews-title">Tin cùng chuyên mục</div>
                <?php 
                  $tinlienquan = ThoiSu::tinLienQuan($model, 5);
                  if(!empty($tinlienquan))
                  {
                    echo '<ul>';
                    foreach ($tinlienquan as $one) 
                    {
                      if(empty($one)) continue;
                      echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                    }
                    echo '</ul>';
                  }
                  ?>
          </div>

          <div class="main-cat-subnews" style="float:right; margin: 17px 0 0 0">
                <div class="main-cat-subnews-title">Tin cũ hơn</div>
                <?php 
                $tinCuHon = ThoiSu::tinCuHon($model, 5);
                if(!empty($tinCuHon))
                {
                  echo '<ul>';
                  foreach ($tinCuHon as $one) 
                  {
                    if(empty($one)) continue;
                    echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                  }
                  echo '</ul>';
                }
                ?>
          </div>
          
      </div>

      
      <!-- end left -->
      <!-- Right -->
      <div id="rightcol-subnews" style="margin-top: 15px; min-height: 2100px;">
        
        <style type="text/css">
          .neoslideshow {position:relative; width:200px; height:300px;}
          .neoslideshow img {position:absolute;left:0; top:0;}

          .neoslideshow1 {position:relative; width:200px; height:300px;}
          .neoslideshow1 img {position:absolute;left:0; top:0;}
        </style>
        <!-- slot 1 -->
        <div id="neoslideshow" class="neoslideshow" style="height: 300px;">
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
                  <img src="<?php echo ImageHelper::getImageUrl($one,"image", KhungBanner1::SIZE); ?>" width="200" height="300" />
                  </a>
                  <?php 
                }
              }
             ?>
        </div>
<!-- end slot 1 -->
        
          <div class="main-cat-listnews" style="float: right; margin: 17px 0 0 0">
            <div class="main-cat-listnews-title">Tiêu điểm tuần qua</div>
                <?php 
                $tinCuHon = ThoiSu::tinTieuDiemTuanQua($model, 5);
                if(!empty($tinCuHon))
                {
                  echo '<ul>';
                  foreach ($tinCuHon as $one) 
                  {
                    if(empty($one)) continue;
                    echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                  }
                  echo '</ul>';
                }
                ?>
            <br/>

            <div class="main-cat-listnews-title">Tin nổi bật</div>
                <?php 
                    $tinlienquan = ThoiSu::tinNoiBat($model, 5);
                    if(!empty($tinlienquan))
                    {
                      echo '<ul>';
                      foreach ($tinlienquan as $one) 
                      {
                        if(empty($one)) continue;
                        echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                      }
                      echo '</ul>';
                    }
                    ?>
            <br/>

            <div class="main-cat-listnews-title">Tin liên quan</div>
                <?php 
                    $tinlienquan = ThoiSu::tinLienQuan($model, 5);
                    if(!empty($tinlienquan))
                    {
                      echo '<ul>';
                      foreach ($tinlienquan as $one) 
                      {
                        if(empty($one)) continue;
                        echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                      }
                      echo '</ul>';
                    }
                    ?>
       

                    <!-- Google Adsense -->
                  <div style="height: 300px; width= 200px;">
                    <script type="text/javascript">
                        google_ad_client = "ca-pub-9511385175886331";
                        google_ad_slot = "7666212005";
                        google_ad_width = 200;
                        google_ad_height = 300;
                    </script>
                    <!-- Ad thangbomaz.com 04 -->
                    <script type="text/javascript"
                    src="//pagead2.googlesyndication.com/pagead/show_ads.js">
                    </script>
                  </div>

                  <!-- End of GG Adsense-->

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
                 data-width="180" data-height="300" data-show-faces="true" data-stream="false" data-header="false">
           </div>


       </div>
     </div><!--end cam nhan-->
            

            </div>
      </div><!--end right -->

      <br/>
      <div style="clear: both;"></div>


<?php /*
<div id="leftcol">
	 <div class="main-cat-hotnews" style="margin: 20px 0 0 0">
      <h3 class="main-daotao"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/news.png" /> 
      <?php echo $model->getCategoryName(); ?>
      </h3>              
          <div>
                <br/>
              <font size="+2" color="#C30006" face="Centaur"><?php echo $model->title; ?></font>
                <br /><br/>
                  <!-- <I>Cập nhật lúc 06-12-2014 21:32:20 (GMT+1) </I> -->
                  <I>Cập nhật lúc <?php echo DateHelper::toDateTimePickerFormat($model->updated_date); ?> </I>
                  <br /><br/>
                  <div style="padding-right: 20px;">
                    <?php echo $model->content; ?>
                  </div>
          </div>
      <!-- </div> -->



              <div class="main-cat-listnews" style="float:left; margin: 0 0 0 30px">
              <div class="main-cat-listnews-title"><div style="margin: 8px 0 0 0">Tiêu Điểm Tuần Qua</div></div>
                  <?php 
                  $tinCuHon = ThoiSu::tinTieuDiemTuanQua($model, 5);
                  if(!empty($tinCuHon))
                  {
                    echo '<ul>';
                    foreach ($tinCuHon as $one) 
                    {
                      if(empty($one)) continue;
                      echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                    }
                    echo '</ul>';
                  }
                  ?>
              </div>
              <div class="main-cat-listnews" style="float:left; margin: 0 0 0 30px">
              <div class="main-cat-listnews-title"><div style="margin: 8px 0 0 0">Tin Cũ Hơn</div></div>
                  <?php 
                  $tinCuHon = ThoiSu::tinCuHon($model, 5);
                  if(!empty($tinCuHon))
                  {
                    echo '<ul>';
                    foreach ($tinCuHon as $one) 
                    {
                      if(empty($one)) continue;
                      echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                    }
                    echo '</ul>';
                  }
                  ?>
              </div>

              <div class="main-cat-listnews" style="float:left; margin: 0 0 0 30px">
              <div class="main-cat-listnews-title"><div style="margin: 8px 0 0 0">Tin liên quan</div></div>
                  <?php 
                  $tinlienquan = ThoiSu::tinLienQuan($model, 5);
                  if(!empty($tinlienquan))
                  {
                    echo '<ul>';
                    foreach ($tinlienquan as $one) 
                    {
                      if(empty($one)) continue;
                      echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                    }
                    echo '</ul>';
                  }
                  ?>
              </div>

    </div><!-- end cat hot news 6 -->
     
</div><!--end left -->

<div id="rightcol" style="margin-top: 7px">
  <?php $this->widget('AdsRightWidget'); ?>    
</div><!--end right -->
*/?>