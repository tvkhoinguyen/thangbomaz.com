<style type="text/css">
	.pager{
		clear: both;
	}
	.main-cat-title a{
		color: #fff !important;
	}
	.main-cat-title-subnews a{
		color: #fff !important;
	}
	.main-cat-title-mainnews a{
		color: #fff !important;
	}
</style>
<div id="leftcol">
<div class="main-cat-hotnews" style="margin: 5px 0 0 0">
    <!-- <h3 class="main-daotao"><span class="main-cat-title">Cộng đồng</span></h3> -->
    <h3 class="main-daotao">
    		<?php echo $breadcrum; ?>
    </h3>
	  	<div class="main-cat-content">
	  		<?php    
	  		    if (!empty($dataProvider)) 
	  		    {
	  		        $this->widget('zii.widgets.CListView', array(
	  		            'id'=>'',
	  		            'dataProvider' => $dataProvider,
	  		            'itemView'=>'item/_item_tin',
	  		            // 'itemsCssClass' => false,
	  		            'summaryText'=> '',
	  		            // 'summaryText'=> 'Showing {start} - {end} of {count} products',
	  		            // 'template' => '<div class="pager-wrap clearfix"><div class="show-page"></div>{pager}</div><div class="clearfix"></div><div class="grid clearfix">{items}</div>',
	  		            // 'enablePagination'=>true,
	  		            // 'pagerCssClass' => 'pager',
	  		            'pager'=>array(
	  		                    'header' => false,
	  		                    'firstPageLabel' => '<<',
	  		                    'prevPageLabel' =>  '<',
	  		                    'nextPageLabel' =>  '>',
	  		                    'lastPageLabel' =>  '>>',
	  		                    'maxButtonCount'=> 5,
	  		                    // 'firstPageCssClass'=>'hidden',
	  		                    // 'lastPageCssClass'=>'hidden',
	  		                    // 'htmlOptions' => array('class' => 'pagination clearfix'),
	  		                    // 'selectedPageCssClass' => 'active',
	  		            )
	  		        ));
	  		    } else {
	  		        echo 'No results found.';
	  		    }
	  		?>  
		</div>

		<!-- Right -->
		<div class="main-cat-listnews">
			<div class="main-cat-listnews-title">Tiêu điểm tuần qua</div>
		    <?php 
                  $listtinTieuDiemTuanQua = ThoiSu::listtinTieuDiemTuanQua(5);
                  if(!empty($listtinTieuDiemTuanQua))
                  {
                    echo '<ul>';
                    foreach ($listtinTieuDiemTuanQua as $one) 
                    {
                      if(empty($one)) continue;
                      echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
                    }
                    echo '</ul>';
                  }
                  ?>

		    <div class="main-cat-listnews-title">Tin nổi bật</div>
		    		<?php 
	                  $listtinNoiBat = ThoiSu::listtinNoiBat(5);
	                  if(!empty($listtinNoiBat))
	                  {
	                    echo '<ul>';
	                    foreach ($listtinNoiBat as $one) 
	                    {
	                      if(empty($one)) continue;
	                      echo '<li><a href="'.Yii::app()->createAbsoluteUrl('site/tinDetail', array('slug'=>$one->slug)).'">'.$one->title.'</a></li>';
	                    }
	                    echo '</ul>';
	                  }
	                  ?>

		    <div class="main-cat-listnews-title">Tin liên quan</div>
		    		<?php 
		    		$tinlienquan = ThoiSu::listtinLienQuan($parent, 5);
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
		<!-- <div class="main-cat-listnews">
			<div class="main-cat-listnews-title"><div style="margin: 8px 0 0 0">Tin nổi bật</div></div>
		    <ul>
		      <li><a href="sub_news.html">Kinh doanh nhờ cơ duyên</a></li>
		      <li><a href="sub_news.html">Tiền của người Việt ở Nga đang 'bốc hơi' từng giờ</a></li>
		      <li><a href="sub_news.html">Chuyện người Việt tại Nga</a></li>
		    </ul>
		</div>
		<div class="main-cat-listnews">
			<div class="main-cat-listnews-title"><div style="margin: 8px 0 0 0">Tin liên quan</div></div>
		    <ul>
		      <li><a href="sub_news.html">Kinh doanh nhờ cơ duyên</a></li>
		      <li><a href="sub_news.html">Tiền của người Việt ở Nga đang 'bốc hơi' từng giờ</a></li>
		      <li><a href="sub_news.html">Chuyện người Việt tại Nga</a></li>
		      <li><a href="sub_news.html">Phụ nữ gốc Việt làm nên thành công của trang tin nổi tiếng</a></li>
		      <li><a href="sub_news.html">Người Việt tại Ba Lan và vụ 'Dê không đầu bảo là chó'</a></li>
		    </ul>
		</div> -->
</div>
</div>

<div id="rightcol" style="margin-top: 7px">
	<?php $this->widget('AdsRightWidget'); ?>
</div>