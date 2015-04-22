<style type="text/css">
    .xemthem{
        float: right;
        margin-top: -22px;
        margin-right: 10px;
        color: #000;
        font-size: 14px;
        font-style: italic;
    }
</style>
<div id="videoleftcol">
    	<div class="pagenamevideo"><h2>Mới cập nhật</h2></div>
      <div class="top-listnew">
              <div style="display:none;margin:0 auto;" class="html5gallery" data-skin="vertical" data-width="640" data-height="380" data-resizemode="fill">
                <?php 
                $criteria = new CDbCriteria();
                $criteria->compare('t.status',STATUS_ACTIVE);
                $criteria->compare('t.is_hot',1);
                $criteria->limit = 10;
                $criteria->order ="order_display DESC, id DESC";
                $hots = Video::model()->findAll($criteria);
                if(!empty($hots))
                {
                    foreach ($hots as $one) 
                    {
                        if(empty($one)) continue;
                        echo '<a href="'.$one->link.'" ><img src="'.$one->image.'" alt="'.$one->title.'" ></a>';
                    }
                }
                ?>
                <!-- <a href="http://www.youtube.com/watch?v=K8P5ZkTnIU4"><img src="http://img.youtube.com/vi/K8P5ZkTnIU4/2.jpg" alt="DEF"></a>
                <a href="http://www.youtube.com/watch?v=kTafc7i0XQ4"><img src="http://img.youtube.com/vi/kTafc7i0XQ4/2.jpg" alt="XXX"></a> -->
              </div>
      </div>



      <?php 
      $criteria = new CDbCriteria();
      $criteria->compare('t.status',STATUS_ACTIVE);
      // $criteria->compare('t.is_hot',1);
      $criteria->compare('t.category_video_id',4);
      $criteria->limit = 10;
      $criteria->order ="order_display DESC, id DESC";
      $hots = Video::model()->findAll($criteria);
      $c_video = CategoryVideo::model()->findByPk(4);
      ?>
      <div class="video-cat-hotnews">
        <h3 class="giaoduc">
            <span class="videocat-title">Hot trong tuần</span>
            <span class="xemthem" style=""><a href="<?php echo Yii::app()->createAbsoluteUrl('site/listVideo', array('slug'=>$c_video->slug)); ?>" >Xem thêm</a></span>
        </h3>
        <div class="cat-content" align="center">
          <div style="display:none; margin:0 auto;" class="html5gallery" data-skin="vertical" data-width="640" data-height="380" data-resizemode="fill">
            <?php 
            if(!empty($hots))
            {
                foreach ($hots as $one) 
                {
                    if(empty($one)) continue;
                    echo '<a href="'.$one->link.'" ><img src="'.$one->image.'" alt="'.$one->title.'" ></a>';
                }
            }
            ?>
                      </div>
        </div>
      </div>



      <?php 
      $criteria = new CDbCriteria();
      $criteria->compare('t.status',STATUS_ACTIVE);
      // $criteria->compare('t.is_hot',1);
      $criteria->compare('t.category_video_id',2);
      $criteria->limit = 10;
      $criteria->order ="order_display DESC, id DESC";
      $hots = Video::model()->findAll($criteria);
      $c_video = CategoryVideo::model()->findByPk(2);
      ?>
      <div class="video-cat-hotnews">
        <h3 class="giaoduc">
            <span class="videocat-title">Cộng đồng</span>
            <span class="xemthem" style=""><a href="<?php echo Yii::app()->createAbsoluteUrl('site/listVideo', array('slug'=>$c_video->slug)); ?>" >Xem thêm</a></span>
        </h3>
        <div class="cat-content" align="center">
          <div style="display:none; margin:0 auto;" class="html5gallery" data-skin="vertical" data-width="640" data-height="380" data-resizemode="fill">
            <?php 
            if(!empty($hots))
            {
                foreach ($hots as $one) 
                {
                    if(empty($one)) continue;
                    echo '<a href="'.$one->link.'" ><img src="'.$one->image.'" alt="'.$one->title.'" ></a>';
                }
            }
            ?>
            <!-- <a href="http://www.youtube.com/watch?v=K8P5ZkTnIU4"><img src="http://img.youtube.com/vi/K8P5ZkTnIU4/2.jpg" alt="DEF"></a>
            <a href="http://www.youtube.com/watch?v=kTafc7i0XQ4"><img src="http://img.youtube.com/vi/kTafc7i0XQ4/2.jpg" alt="XXX"></a>
            <a href="http://www.youtube.com/watch?v=s7SzgQe8BjQ"><img src="http://img.youtube.com/vi/s7SzgQe8BjQ/2.jpg" alt="YYY"></a>
            <a href="http://www.youtube.com/watch?v=WtsvRdb4iIQ"><img src="http://img.youtube.com/vi/WtsvRdb4iIQ/2.jpg" alt="ABC"></a>
            <a href="http://www.youtube.com/watch?v=WtsvRdb4iIQ"><img src="http://img.youtube.com/vi/WtsvRdb4iIQ/2.jpg" alt="ABC"></a>
            <a href="http://www.youtube.com/watch?v=K8P5ZkTnIU4"><img src="http://img.youtube.com/vi/K8P5ZkTnIU4/2.jpg" alt="DEF"></a>
            <a href="http://www.youtube.com/watch?v=kTafc7i0XQ4"><img src="http://img.youtube.com/vi/kTafc7i0XQ4/2.jpg" alt="XXX"></a>
            <a href="http://www.youtube.com/watch?v=s7SzgQe8BjQ"><img src="http://img.youtube.com/vi/s7SzgQe8BjQ/2.jpg" alt="YYY"></a>
            <a href="http://www.youtube.com/watch?v=WtsvRdb4iIQ"><img src="http://img.youtube.com/vi/WtsvRdb4iIQ/2.jpg" alt="ABC"></a>
            <a href="http://www.youtube.com/watch?v=K8P5ZkTnIU4"><img src="http://img.youtube.com/vi/K8P5ZkTnIU4/2.jpg" alt="DEF"></a>
            <a href="http://www.youtube.com/watch?v=kTafc7i0XQ4"><img src="http://img.youtube.com/vi/kTafc7i0XQ4/2.jpg" alt="XXX"></a>
            <a href="http://www.youtube.com/watch?v=s7SzgQe8BjQ"><img src="http://img.youtube.com/vi/s7SzgQe8BjQ/2.jpg" alt="YYY"></a>
            <a href="http://www.youtube.com/watch?v=WtsvRdb4iIQ"><img src="http://img.youtube.com/vi/WtsvRdb4iIQ/2.jpg" alt="ABC"></a>
            <a href="http://www.youtube.com/watch?v=K8P5ZkTnIU4"><img src="http://img.youtube.com/vi/K8P5ZkTnIU4/2.jpg" alt="DEF"></a>
            <a href="http://www.youtube.com/watch?v=kTafc7i0XQ4"><img src="http://img.youtube.com/vi/kTafc7i0XQ4/2.jpg" alt="XXX"></a>
            <a href="http://www.youtube.com/watch?v=s7SzgQe8BjQ"><img src="http://img.youtube.com/vi/s7SzgQe8BjQ/2.jpg" alt="YYY"></a> -->
          </div>
        </div>
      </div>





      <?php 
      $criteria = new CDbCriteria();
      $criteria->compare('t.status',STATUS_ACTIVE);
      // $criteria->compare('t.is_hot',1);
      $criteria->compare('t.category_video_id',3);
      $criteria->limit = 10;
      $criteria->order ="order_display DESC, id DESC";
      $hots = Video::model()->findAll($criteria);
      $c_video = CategoryVideo::model()->findByPk(3);
      ?>
      <div class="video-cat-hotnews">
        <h3 class="giaoduc">
            <span class="videocat-title">Tin tức - Phóng sự</span>
            <span class="xemthem" style=""><a href="<?php echo Yii::app()->createAbsoluteUrl('site/listVideo', array('slug'=>$c_video->slug)); ?>" >Xem thêm</a></span>
        </h3>
        <div class="cat-content" align="center">
          <div style="display:none; margin:0 auto;" class="html5gallery" data-skin="vertical" data-width="640" data-height="380" data-resizemode="fill">
            <?php 
            if(!empty($hots))
            {
                foreach ($hots as $one) 
                {
                    if(empty($one)) continue;
                    echo '<a href="'.$one->link.'" ><img src="'.$one->image.'" alt="'.$one->title.'" ></a>';
                }
            }
            ?>
            <!-- <a href="http://www.youtube.com/watch?v=s7SzgQe8BjQ"><img src="http://img.youtube.com/vi/s7SzgQe8BjQ/2.jpg" alt="YYY"></a>
            <a href="http://www.youtube.com/watch?v=WtsvRdb4iIQ"><img src="http://img.youtube.com/vi/WtsvRdb4iIQ/2.jpg" alt="ABC"></a>
            <a href="http://www.youtube.com/watch?v=K8P5ZkTnIU4"><img src="http://img.youtube.com/vi/K8P5ZkTnIU4/2.jpg" alt="DEF"></a>
            <a href="http://www.youtube.com/watch?v=WtsvRdb4iIQ"><img src="http://img.youtube.com/vi/WtsvRdb4iIQ/2.jpg" alt="ABC"></a>
            <a href="http://www.youtube.com/watch?v=K8P5ZkTnIU4"><img src="http://img.youtube.com/vi/K8P5ZkTnIU4/2.jpg" alt="DEF"></a>
            <a href="http://www.youtube.com/watch?v=kTafc7i0XQ4"><img src="http://img.youtube.com/vi/kTafc7i0XQ4/2.jpg" alt="XXX"></a>
            <a href="http://www.youtube.com/watch?v=kTafc7i0XQ4"><img src="http://img.youtube.com/vi/kTafc7i0XQ4/2.jpg" alt="XXX"></a>
            <a href="http://www.youtube.com/watch?v=s7SzgQe8BjQ"><img src="http://img.youtube.com/vi/s7SzgQe8BjQ/2.jpg" alt="YYY"></a>
            <a href="http://www.youtube.com/watch?v=WtsvRdb4iIQ"><img src="http://img.youtube.com/vi/WtsvRdb4iIQ/2.jpg" alt="ABC"></a>
            <a href="http://www.youtube.com/watch?v=K8P5ZkTnIU4"><img src="http://img.youtube.com/vi/K8P5ZkTnIU4/2.jpg" alt="DEF"></a>
            <a href="http://www.youtube.com/watch?v=kTafc7i0XQ4"><img src="http://img.youtube.com/vi/kTafc7i0XQ4/2.jpg" alt="XXX"></a>
            <a href="http://www.youtube.com/watch?v=s7SzgQe8BjQ"><img src="http://img.youtube.com/vi/s7SzgQe8BjQ/2.jpg" alt="YYY"></a>
            <a href="http://www.youtube.com/watch?v=WtsvRdb4iIQ"><img src="http://img.youtube.com/vi/WtsvRdb4iIQ/2.jpg" alt="ABC"></a>
            <a href="http://www.youtube.com/watch?v=K8P5ZkTnIU4"><img src="http://img.youtube.com/vi/K8P5ZkTnIU4/2.jpg" alt="DEF"></a>
            <a href="http://www.youtube.com/watch?v=kTafc7i0XQ4"><img src="http://img.youtube.com/vi/kTafc7i0XQ4/2.jpg" alt="XXX"></a>
            <a href="http://www.youtube.com/watch?v=s7SzgQe8BjQ"><img src="http://img.youtube.com/vi/s7SzgQe8BjQ/2.jpg" alt="YYY"></a> -->
          </div>
        </div>
      </div>
</div>