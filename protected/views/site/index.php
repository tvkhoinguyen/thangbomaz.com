<style type="text/css">

  .tin_chu_chay{
    margin: 5px 0 0 0;
  }
  .img_marquee_box{
    width:156px; 
    /*display: inline-block; */
    margin: 0 auto !important;
  }
  .div_marquee{
    width: 160px !important;
    float: left;
    /*display: block;*/
    text-align: center;
    padding: 15px;
  }
  .div_marquee p{
    white-space: normal !important;
    font-weight: bold;
  }
</style>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58936856-1', 'auto');
  ga('send', 'pageview');

</script>


 <div id="leftcol">
  <?php 
    $id_cate_tin = 2;
    $m_tieude = CategoryTin::model()->findByPk($id_cate_tin); 
    $link_tieude = '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$m_tieude->slug, 'c_slug'=>'' )).'">TIN TỨC - THỜI SỰ</a>';
  ?>
  <div class="pagename">
    <div class="BlockTitleHotNewsFirst">
      <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/news.png" width="20px" /><?php echo $link_tieude; ?>
    </div>
    <div class="BlockTitleHotNews">
      <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/tin-tuc/tin-viet-nam">Tin Việt Nam</a>
    </div>
    <div class="BlockTitleHotNews">
      <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/tin-tuc/tin-the-gioi">Tin thế giới</a>
    </div>
    <div class="BlockTitleHotNews">
      <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/tin-tuc/thoi-su">Thời sự</a>
    </div>

  </div>
   <div>
     <marquee class="tin_chu_chay" onmouseover="this.stop()" onmouseout="this.start()" align="center" direction="left" height="18" scrollamount="3" width="100%">
       <font color="#C30006"><b>
          <?php 
          $thoisu = ThoiSu::getHomeMarquee(2);
          if(!empty($thoisu))
          {
            foreach ($thoisu as $one) 
            {
              if(empty($one)) continue;
              echo '<a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a> &nbsp;&nbsp; | &nbsp;&nbsp; ';
            }
          }
          ?>
       </b></font>
     </marquee>
   </div>
    

    <div class="top-listnew">
      <?php 
      $hotDefaultHome = ThoiSu::getOneHomeDefaultHot();
      if(!empty($hotDefaultHome))
      {
        echo '<img src="'.ImageHelper::getImageUrl($hotDefaultHome, "image", ThoiSu::SIZE1).'"  />';
        echo '<h3><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$hotDefaultHome->slug)).'">'.$hotDefaultHome->title.'</a></h3>';
        echo '<p>'.$hotDefaultHome->short_content.' <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$hotDefaultHome->slug)).'"> &nbsp;&nbsp;<i>xem thêm</i>&nbsp;&nbsp; </a></p>';
      }
      ?>
     </div>


     <div class="tabs">
      <input id="tab-1" type="radio" name="radio-set" class="tab-selector-1" checked="checked" />
            <label for="tab-1" class="tab-label-1">Tin mới</label>
    
              <input id="tab-2" type="radio" name="radio-set" class="tab-selector-2" />
            <label for="tab-2" class="tab-label-2">Tiêu điểm</label>
    
              <input id="tab-3" type="radio" name="radio-set" class="tab-selector-3" />
            <label for="tab-3" class="tab-label-3">Tin Video</label>
            
          <div class="clear-shadow"></div>


          <div class="tabcontent">
              <div class="tabcontent-1" style="margin-top: 5px">

                        <?php
                          $moicapnhap = ThoiSu::getMoiCapNhap();
                          if(!empty($moicapnhap))
                          {
                            foreach ($moicapnhap as $one) 
                            {
                              if(empty($one)) continue;
                              echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                            }
                          }
                          ?>

              </div>
              <div class="tabcontent-2" style="margin-top: 5px">

                          <?php 
                  $listtinTieuDiemTuanQua = ThoiSu::listtinTieuDiemTuanQua(8);
                  if(!empty($listtinTieuDiemTuanQua))
                  {
                    
                    foreach ($listtinTieuDiemTuanQua as $one) 
                    {
                      if(empty($one)) continue;
                      echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                    }
                    
                  }
                  ?>

              </div>
              <div class="tabcontent-3">
                  <?php
                    $video_moi = Video::tab_list_video_moi();
                    if(!empty($video_moi))
                    {
                      foreach ($video_moi as $one) 
                      {
                        if(empty($one)) continue;
                        echo '<li><a target="_blank" href="'.Yii::app()->createAbsoluteUrl('site/videoDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                      }
                    }
                    ?>
            
              </div>

            </div>
          
     </div>
     

<!-- BOX marquee  -->
      <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/cycle-plugin.js"></script>
      <script type="text/javascript">
        $(document).ready(function(){
          $("#box_marquee").cycle({
            fx:'scrollLeft',
            // delay: -3000 ,
            speed:    8000, 
            timeout:  12000 
          });
        });
      </script>
      <style type="text/css">
            #box_marquee{
            width: 100%;
            height: 100%;
            border:0px solid orange;
            padding: 5px;
            height: 200px !important;
            }

            .ulBlockSlideNews{
              display:inline-block;
              list-style-type:none;
              margin:16px 0 0 40px;
              
              padding:0;
              vertical-align:top;
              width:170px;
              height: 150px;
              float:left;

              text-align: justify;

            }

            .ulBlockSlideNews a{
              font-family: bold 'PT Sans Narrow', sans-serif;
              font-size: bold 14pt;
              font-weight: bold;
              line-height: 22px;
              color:#540604;
              text-decoration:none;
              text-align: justify;

            }

            .ulBlockSlideNews a:hover{
              text-decoration: underline;
            }

            .ulBlockSlideNews img{
              border: 1px solid #bab3b2;
              width: 165px;
              height: 110px;

            }
      </style>
      <div id="box_marquee" style="float-left;">
          <?php
          $marquee_box = ThoiSu::getHomeMarqueeBox(2, 9); //2 id, 9 number
          if(!empty($marquee_box))
          {
            $i = 0;
            $arr1 = [];
             foreach ($marquee_box as $one) 
             {
               if(empty($one)) continue;
               
               if( $i<3 )
               {
                  $arr1[$i] = $one; 
               }else if($i>=3 && $i<6)
               {
                  $arr1[$i] = $one;
               }else if($i>=6 && $i<9)
               {
                  $arr1[$i] = $one;
               }

               $i++;
               // echo '<div class="div_marquee">
               //        <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">
               //          <img class="img_marquee_box" src="'.ImageHelper::getImageUrl($one, "image", ThoiSu::SIZE2).'" />
               //          <br/><p style="width:150px;">'.$one->title.'</p>
               //        </a>
               //    </div>';
                  // StringHelper::limitStringLength($one->title, 30)
             }

             $tt=0;
             for($t=0; $t<3; $t++)
             {
                
                echo '<div>';
                $one = $arr1[$tt];
                echo '<div class="ulBlockSlideNews">
                        <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">
                          <img src="'.ImageHelper::getImageUrl($one, "image", ThoiSu::SIZE2).'">
                            '.$one->title.'
                        </a> 
                      </div>';
                      $tt++;

                $one = $arr1[$tt];
                echo '<div class="ulBlockSlideNews">
                        <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">
                          <img src="'.ImageHelper::getImageUrl($one, "image", ThoiSu::SIZE2).'">
                            '.$one->title.'
                        </a> 
                      </div>';
                      $tt++;

                $one = $arr1[$tt];
                echo '<div class="ulBlockSlideNews">
                        <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">
                          <img src="'.ImageHelper::getImageUrl($one, "image", ThoiSu::SIZE2).'">
                            '.$one->title.'
                        </a> 
                      </div>';
                      $tt++;

                echo '</div>';
             }
          }
          ?>

      </div>
      <?php /*
     <marquee onmouseover="this.stop()" onmouseout="this.start()"  align="center" scrolldelay="90" direction="left" scrollamount="5" style="height: 200px; width: 600px;" >
       <div style="color:#C30006; width: 1200px;">
          <?php
          $marquee_box = ThoiSu::getHomeMarqueeBox(2);
          if(!empty($marquee_box))
          {
             foreach ($marquee_box as $one) 
             {
               if(empty($one)) continue;
               echo '<div class="div_marquee">
                      <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">
                        <img class="img_marquee_box" src="'.ImageHelper::getImageUrl($one, "image", ThoiSu::SIZE2).'" />
                        <br/><p style="width:150px;">'.$one->title.'</p>
                      </a>
                  </div>';
                  // StringHelper::limitStringLength($one->title, 30)
             }
          }
          ?>
       </div>
     </marquee>
     */?>

     

<!-- Cong Dong -->
     <div class="cat-hotnews" style="margin: 0 0 0 0">
        <?php 
          $id_cate_tin = 1;
          $m_tieude = CategoryTin::model()->findByPk($id_cate_tin); 
          $link_tieude = '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$m_tieude->slug, 'c_slug'=>'' )).'">'.$m_tieude->name.'</a>';
        ?>
       <div class="cat-title">
          <div class="BlockTitleFirst">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/cong-dong/">Cộng đồng</a>
                </div>

                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/cong-dong/nguoi-viet-arizona">Người Việt AZ</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/cong-dong/nguoi-viet-hai-ngoai">Người Việt ở Mỹ</a>
                </div>

              </div>
       
       <marquee class="tin_chu_chay" onmouseover="this.stop()" onmouseout="this.start()" align="center" direction="left" height="18" scrollamount="3" width="100%">
       <font color="#C30006"><b>
          <?php 
          $thoisu = ThoiSu::getHomeMarquee($id_cate_tin);
          if(!empty($thoisu))
          {
            foreach ($thoisu as $one) 
            {
              if(empty($one)) continue;
              echo '<a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a> &nbsp;&nbsp; | &nbsp;&nbsp; ';
            }
          }
          ?>
        </b>
        </font>
       </marquee>
       
       <div class="cat-content">
            <?php 
            $models = ThoiSu::getLimitTin(3, $id_cate_tin);
            $arr_not_in = array();
            if(!empty($models))
            {
              foreach ($models as $one) 
              {
                if(empty($one)) continue;
                $arr_not_in[]=$one->id;
                echo '<div style="float:left; padding-bottom: 15px;">
                     <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'" ><img src="'.ImageHelper::getImageUrl($one,"image", ThoiSu::SIZE2).'" /></a>
                     <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a>
                     <p>'.$one->short_content.' <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'"> &nbsp;&nbsp;<i>xem thêm</i>&nbsp;&nbsp; </a></p>
                     </div>';
              }
            }
            ?>
       </div>
       <div class="cat-listnews">
            <?php
            $models = ThoiSu::getLimitHotTin(7, $id_cate_tin, $arr_not_in);
            if(!empty($models))
            {
              echo '<ul>';
              foreach ($models as $one) 
              {
                if(empty($one)) continue;
                echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
              }
              echo '</ul>';
            }
            ?>
       </div>
     </div>

<!-- Chuyên Đề -->
  <div class="cat-hotnews">
    <?php 
      $id_cate_tin = 21;
      $m_tieude = CategoryTin::model()->findByPk($id_cate_tin); 
      $link_tieude = '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$m_tieude->slug, 'c_slug'=>'' )).'">'.$m_tieude->name.'</a>';
    ?>
    <div class="cat-title">
          <div class="BlockTitleFirst">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/chuyen-de/">Chuyên đề</a>
                </div>

                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/chuyen-de/nhan-dinh">Nhận định</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/chuyen-de/quoc-phong">Quốc phòng</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/chuyen-de/bien-dong">Biển Đông</a>
                </div>

              </div>
     <marquee class="tin_chu_chay" onmouseover="this.stop()" onmouseout="this.start()" align="center" direction="left" height="18" scrollamount="3" width="100%">
     <font color="#C30006"><b>
           <?php 
           $thoisu = ThoiSu::getHomeMarquee($id_cate_tin);
           if(!empty($thoisu))
           {
             foreach ($thoisu as $one) 
             {
               if(empty($one)) continue;
               echo '<a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a> &nbsp;&nbsp; | &nbsp;&nbsp; ';
             }
           }
           ?>
        </b></font></marquee>
      <div class="cat-content">
         <?php 
               $models = ThoiSu::getLimitTin(3, $id_cate_tin);
               $arr_not_in = array();
               if(!empty($models))
               {
                 foreach ($models as $one) 
                 {
                   if(empty($one)) continue;
                   $arr_not_in[]=$one->id;
                   echo '<div style="float:left; padding-bottom: 15px;">
                        <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'" ><img src="'.ImageHelper::getImageUrl($one,"image", ThoiSu::SIZE2).'" /></a>
                        <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a>
                        <p>'.$one->short_content.' <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'"> &nbsp;&nbsp;<i>xem thêm</i>&nbsp;&nbsp; </a></p>
                        </div>';
                 }
               }
               ?>
     </div>
     <div class="cat-listnews">
          <?php
                      $models = ThoiSu::getLimitHotTin(7, $id_cate_tin, $arr_not_in);
                      if(!empty($models))
                      {
                        echo '<ul>';
                        foreach ($models as $one) 
                        {
                          if(empty($one)) continue;
                          echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                        }
                        echo '</ul>';
                      }
                      ?>
     </div>
   </div>

<!-- Kinh Te -->
     <div class="cat-hotnews">
       <?php 
        $id_cate_tin = 4;
        $m_tieude = CategoryTin::model()->findByPk($id_cate_tin); 
        $link_tieude = '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$m_tieude->slug, 'c_slug'=>'' )).'">'.$m_tieude->name.'</a>';
      ?>
      <div class="cat-title">
          <div class="BlockTitleFirst">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/kinh-te/">Kinh tế</a>
                </div>

                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/kinh-te/the-gioi">Thế giới</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/kinh-te/viet-nam">Việt Nam</a>
                </div>

              </div>
       
       <marquee class="tin_chu_chay" onmouseover="this.stop()" onmouseout="this.start()" align="center" direction="left" height="18" scrollamount="3" width="100%">
       <font color="#C30006"><b>
          <?php 
          $thoisu = ThoiSu::getHomeMarquee($id_cate_tin);
          if(!empty($thoisu))
          {
            foreach ($thoisu as $one) 
            {
              if(empty($one)) continue;
              echo '<a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a> &nbsp;&nbsp; | &nbsp;&nbsp; ';
            }
          }
          ?>
          </b>
       </font>
       </marquee>
       
       <div class="cat-content">
           <?php 
                 $models = ThoiSu::getLimitTin(3, $id_cate_tin);
                 $arr_not_in = array();
                 if(!empty($models))
                 {
                   foreach ($models as $one) 
                   {
                     if(empty($one)) continue;
                     $arr_not_in[]=$one->id;
                     echo '<div style="float:left; padding-bottom: 15px;">
                          <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'" ><img src="'.ImageHelper::getImageUrl($one,"image", ThoiSu::SIZE2).'" /></a>
                          <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a>
                          <p>'.$one->short_content.' <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'"> &nbsp;&nbsp;<i>xem thêm</i>&nbsp;&nbsp; </a></p>
                          </div>';
                   }
                 }
                 ?>
       </div>
       <div class="cat-listnews">
           <?php
                       $models = ThoiSu::getLimitHotTin(7, $id_cate_tin, $arr_not_in);
                       if(!empty($models))
                       {
                         echo '<ul>';
                         foreach ($models as $one) 
                         {
                           if(empty($one)) continue;
                           echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                         }
                         echo '</ul>';
                       }
                       ?>
       </div>
     </div>




<!-- Pháp luật -->
     <div class="cat-hotnews">
       <?php 
        $id_cate_tin = 3;
        $m_tieude = CategoryTin::model()->findByPk($id_cate_tin); 
        $link_tieude = '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$m_tieude->slug, 'c_slug'=>'' )).'">'.$m_tieude->name.'</a>';
      ?>
      <div class="cat-title">
          <div class="BlockTitleFirst">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/phap-luat/">Pháp luật</a>
                </div>

              </div>
       
       <marquee class="tin_chu_chay" onmouseover="this.stop()" onmouseout="this.start()" align="center" direction="left" height="18" scrollamount="3" width="100%">
       <font color="#C30006"><b>
          <?php 
          $thoisu = ThoiSu::getHomeMarquee($id_cate_tin);
          if(!empty($thoisu))
          {
            foreach ($thoisu as $one) 
            {
              if(empty($one)) continue;
              echo '<a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a> &nbsp;&nbsp; | &nbsp;&nbsp; ';
            }
          }
          ?>
       </b></font></marquee>
       <div class="cat-content">
           <?php 
                 $models = ThoiSu::getLimitTin(3, $id_cate_tin);
                 $arr_not_in = array();
                 if(!empty($models))
                 {
                   foreach ($models as $one) 
                   {
                     if(empty($one)) continue;
                     $arr_not_in[]=$one->id;
                     echo '<div style="float:left; padding-bottom: 15px;">
                          <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'" ><img src="'.ImageHelper::getImageUrl($one,"image", ThoiSu::SIZE2).'" /></a>
                          <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a>
                          <p>'.$one->short_content.' <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'"> &nbsp;&nbsp;<i>xem thêm</i>&nbsp;&nbsp; </a></p>
                          </div>';
                   }
                 }
                 ?>
       </div>
       <div class="cat-listnews">
            <?php
                        $models = ThoiSu::getLimitHotTin(7, $id_cate_tin, $arr_not_in);
                        if(!empty($models))
                        {
                          echo '<ul>';
                          foreach ($models as $one) 
                          {
                            if(empty($one)) continue;
                            echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                          }
                          echo '</ul>';
                        }
                        ?>
       </div>
     </div><!-- end cat hot news 6 -->





<!-- Giáo Dục -->
     <div class="cat-hotnews">
       <?php 
        $id_cate_tin = 19;
        $m_tieude = CategoryTin::model()->findByPk($id_cate_tin); 
        $link_tieude = '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$m_tieude->slug, 'c_slug'=>'' )).'">'.$m_tieude->name.'</a>';
      ?>
      <div class="cat-title">
          <div class="BlockTitleFirst">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/van-hoa/">Văn hóa</a>
                </div>

                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/van-hoa/tho">Thơ</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/van-hoa/bien-khao">Biên khảo</a>
                </div>

                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/van-hoa/sang-tac">Sáng tác</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/van-hoa/but-ky">Bút ký</a>
                </div>

              </div>
       <marquee class="tin_chu_chay" onmouseover="this.stop()" onmouseout="this.start()" align="center" direction="left" height="18" scrollamount="3" width="100%">
       <font color="#C30006"><b>
          <?php 
          $thoisu = ThoiSu::getHomeMarquee($id_cate_tin);
          if(!empty($thoisu))
          {
            foreach ($thoisu as $one) 
            {
              if(empty($one)) continue;
              echo '<a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a> &nbsp;&nbsp; | &nbsp;&nbsp; ';
            }
          }
          ?>
       </b></font>
       </marquee>
       <div class="cat-content">
                  <?php 
                        $models = ThoiSu::getLimitTin(3, $id_cate_tin);
                        $arr_not_in = array();
                        if(!empty($models))
                        {
                          foreach ($models as $one) 
                          {
                            if(empty($one)) continue;
                            $arr_not_in[]=$one->id;
                            echo '<div style="float:left; padding-bottom: 15px;">
                                 <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'" ><img src="'.ImageHelper::getImageUrl($one,"image", ThoiSu::SIZE2).'" /></a>
                                 <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a>
                                 <p>'.$one->short_content.' <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'"> &nbsp;&nbsp;<i>xem thêm</i>&nbsp;&nbsp; </a></p>
                                 </div>';
                          }
                        }
                        ?>
              </div>
              <div class="cat-listnews">
                   <?php
                               $models = ThoiSu::getLimitHotTin(7, $id_cate_tin, $arr_not_in);
                               if(!empty($models))
                               {
                                 echo '<ul>';
                                 foreach ($models as $one) 
                                 {
                                   if(empty($one)) continue;
                                   echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                                 }
                                 echo '</ul>';
                               }
                               ?>
              </div>
     </div><!-- end cat hot news 6 -->






<!-- Đời Sống -->
     <div class="cat-hotnews">
       <?php 
        $id_cate_tin = 5;
        $m_tieude = CategoryTin::model()->findByPk($id_cate_tin); 
        $link_tieude = '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$m_tieude->slug, 'c_slug'=>'' )).'">'.$m_tieude->name.'</a>';
      ?>
      <div class="cat-title">
          <div class="BlockTitleFirst">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/doi-song/">Đời sống</a>
                </div>

                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/doi-song/nhip-song-moi">Nhịp sống mới</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/doi-song/suc-khoe">Sức khỏe</a>
                </div>

                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/doi-song/thoi-trang">Thời trang</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/doi-song/cong-nghe">Công nghệ</a>
                </div>

              </div>
       <marquee class="tin_chu_chay" onmouseover="this.stop()" onmouseout="this.start()" align="center" direction="left" height="18" scrollamount="3" width="100%">
              <font color="#C30006"><b>
                 <?php 
                 $thoisu = ThoiSu::getHomeMarquee($id_cate_tin);
                 if(!empty($thoisu))
                 {
                   foreach ($thoisu as $one) 
                   {
                     if(empty($one)) continue;
                     echo '<a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a> &nbsp;&nbsp; | &nbsp;&nbsp; ';
                   }
                 }
                 ?>
              </b></font></marquee>
              
              <div class="cat-content">
                   <?php 
                         $models = ThoiSu::getLimitTin(3, $id_cate_tin);
                         $arr_not_in = array();
                         if(!empty($models))
                         {
                           foreach ($models as $one) 
                           {
                             if(empty($one)) continue;
                             $arr_not_in[]=$one->id;
                             echo '<div style="float:left; padding-bottom: 15px;">
                                  <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'" ><img src="'.ImageHelper::getImageUrl($one,"image", ThoiSu::SIZE2).'" /></a>
                                  <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a>
                                  <p>'.$one->short_content.' <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'"> &nbsp;&nbsp;<i>xem thêm</i>&nbsp;&nbsp; </a></p>
                                  </div>';
                           }
                         }
                         ?>
               </div>
               <div class="cat-listnews">
                    <?php
                                $models = ThoiSu::getLimitHotTin(7, $id_cate_tin, $arr_not_in);
                                if(!empty($models))
                                {
                                  echo '<ul>';
                                  foreach ($models as $one) 
                                  {
                                    if(empty($one)) continue;
                                    echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                                  }
                                  echo '</ul>';
                                }
                                ?>
               </div>
     </div><!-- end cat hot news 6 -->








<!-- Tâm Linh -->
     <div class="cat-hotnews">
       <?php 
        $id_cate_tin = 20;
        $m_tieude = CategoryTin::model()->findByPk($id_cate_tin); 
        $link_tieude = '<a href="'.Yii::app()->createAbsoluteUrl('site/listTin', array('p_slug'=>$m_tieude->slug, 'c_slug'=>'' )).'">'.$m_tieude->name.'</a>';
      ?>
      <div class="cat-title">
          <div class="BlockTitleFirst">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/tam-linh/">Tâm linh</a>
                </div>

                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/tam-linh/phong-thuy">Phong thủy</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/tam-linh/tu-vi">Tử vi</a>
                </div>
                <div class="BlockTitleSecond">
                  <a href="http://thangbomaz.com/tin-tuc-chuyen-muc/tam-linh/kien-thuc-tam-linh">Kiến thức tâm linh</a>
                </div>

              </div>
       <marquee class="tin_chu_chay" onmouseover="this.stop()" onmouseout="this.start()" align="center" direction="left" height="18" scrollamount="3" width="100%">
       <font color="#C30006"><b>
             <?php 
             $thoisu = ThoiSu::getHomeMarquee($id_cate_tin);
             if(!empty($thoisu))
             {
               foreach ($thoisu as $one) 
               {
                 if(empty($one)) continue;
                 echo '<a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a> &nbsp;&nbsp; | &nbsp;&nbsp; ';
               }
             }
             ?>
          </b></font></marquee>
        <div class="cat-content">
           <?php 
                 $models = ThoiSu::getLimitTin(3, $id_cate_tin);
                 $arr_not_in = array();
                 if(!empty($models))
                 {
                   foreach ($models as $one) 
                   {
                     if(empty($one)) continue;
                     $arr_not_in[]=$one->id;
                     echo '<div style="float:left; padding-bottom: 15px;">
                          <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'" ><img src="'.ImageHelper::getImageUrl($one,"image", ThoiSu::SIZE2).'" /></a>
                          <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a>
                          <p>'.$one->short_content.' <a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'"> &nbsp;&nbsp;<i>xem thêm</i>&nbsp;&nbsp; </a></p>
                          </div>';
                   }
                 }
                 ?>
       </div>
       <div class="cat-listnews">
            <?php
                        $models = ThoiSu::getLimitHotTin(7, $id_cate_tin, $arr_not_in);
                        if(!empty($models))
                        {
                          echo '<ul>';
                          foreach ($models as $one) 
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



