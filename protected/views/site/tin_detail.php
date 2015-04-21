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
            
            <font size="+3" color="#C30006" face="Centaur"><?php echo $model->title; ?></font>
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
                <!-- <a href="javascript:void(0);" onclick="javascript:window.open('<?php echo $href_share; ?>', '_blank', 'width=700,height=500');void(0);">
                    <span class="ico-share"><img src="<?php echo Yii::app()->theme->baseUrl."/img/btn_fb_55px.gif"; ?>" /></span>
                </a> -->
                <div class="fb-like" data-href="<?php echo $url_share; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                <div style="padding-right: 20px;">
                  <?php echo $model->content; ?>
                </div>
                <br/>
                <div class="fb-like" data-href="<?php echo $url_share; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
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
        <?php $qcbanner = QuangCaoBanner::model()->findByPk(11); ?>
            <a href="<?php echo $qcbanner->link; ?>" target="_blank">
                <img src="<?php echo ImageHelper::getImageUrl($qcbanner, "image", QuangCaoBanner::SIZE2 ); ?>" width="200px" height="300px" style="float:right" />
            </a>
        <?php $qcbanner = QuangCaoBanner::model()->findByPk(12); ?>
            <a href="<?php echo $qcbanner->link; ?>" target="_blank">
                <img src="<?php echo ImageHelper::getImageUrl($qcbanner, "image", QuangCaoBanner::SIZE2 ); ?>" width="200px" height="300px" style="float:right" />
            </a>
        
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
        <?php $qcbanner = QuangCaoBanner::model()->findByPk(13); ?>
            <a href="<?php echo $qcbanner->link; ?>" target="_blank">
                <img src="<?php echo ImageHelper::getImageUrl($qcbanner, "image", QuangCaoBanner::SIZE2 ); ?>" width="200px" height="300px" style="float:right" />
            </a>
        <?php $qcbanner = QuangCaoBanner::model()->findByPk(14); ?>
            <a href="<?php echo $qcbanner->link; ?>" target="_blank">
                <img src="<?php echo ImageHelper::getImageUrl($qcbanner, "image", QuangCaoBanner::SIZE2 ); ?>" width="200px" height="300px" style="float:right" />
            </a>
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