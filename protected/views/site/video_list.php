<div id="videoleftcol">
		<div class="pagenamevideo"><h2><?php  echo $title; ?></h2></div>
		<center>
	  	<div class="video-cat-hotnews" style="margin: 0 auto;">
	  		<?php    
	  		    if (!empty($dataProvider)) 
	  		    {
	  		        $this->widget('zii.widgets.CListView', array(
	  		            'id'=>'',
	  		            'dataProvider' => $dataProvider,
	  		            'itemView'=>'item/_item_video',
	  		            // 'itemsCssClass' => false,
	  		            // 'summaryText'=> 'Showing {start} - {end} of {count} products',
	  		            // 'template' => '<div class="pager-wrap clearfix"><div class="show-page"></div>{pager}</div><div class="clearfix"></div><div class="grid clearfix">{items}</div>',
	  		            // 'enablePagination'=>true,
	  		            // 'pagerCssClass' => 'pager',
	  		            'pager'=>array(
	  		                    'header' => false,
	  		                    // 'firstPageLabel' => '<span class="glyphicon glyphicon-fast-backward"></span>',
	  		                    // 'prevPageLabel' =>  '<span class="glyphicon glyphicon-chevron-left"></span>',
	  		                    // 'nextPageLabel' =>  '<span class="glyphicon glyphicon-chevron-right"></span>',
	  		                    // 'lastPageLabel' =>  '<span class="glyphicon glyphicon-fast-forward"></span>',
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
	  		<br/>
	  		<br/>
			<!-- 
			<iframe width="800" height="600" src="//www.youtube.com/embed/dZibIejXEMM" frameborder="0" allowfullscreen></iframe>
			<iframe width="800" height="600" src="//www.youtube.com/embed/dZibIejXEMM" frameborder="0" allowfullscreen></iframe>
			<iframe width="800" height="600" src="//www.youtube.com/embed/dZibIejXEMM" frameborder="0" allowfullscreen></iframe>
			<iframe width="800" height="600" src="//www.youtube.com/embed/dZibIejXEMM" frameborder="0" allowfullscreen></iframe>
			<iframe width="800" height="600" src="//www.youtube.com/embed/dZibIejXEMM" frameborder="0" allowfullscreen></iframe> 
			-->
		</div>
		</center>
</div>