<div id="videoleftcol">
		<div class="pagename"><h2><?php  echo $model->title; ?></h2></div>
		<center>
	  	<div class="video-cat-hotnews" style="margin: 0 auto;">
	  		<?php    
	  		    if (!empty($model)) 
	  		    {
	  		        	$arr = explode('?v=', $model->link);
	  		        	$temp = '//www.youtube.com/embed/'.$arr[1];
	  		        ?>
	  		        <br/>
	  		        <iframe width="640" height="480" src="<?php echo $temp; ?>" frameborder="0" allowfullscreen></iframe>
	  		        <br/>
		        <?php
	  		    } else {
	  		        echo 'No results found.';
	  		    }
	  		?>  
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