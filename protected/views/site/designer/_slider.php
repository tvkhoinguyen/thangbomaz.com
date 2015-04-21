<?php 
	$htmlSlider = '';
	$htmlThumb  = '';
	$allImg = InteriorDesignGallery::model()->getListImageWithDesignerId($model->id);
	if(count($allImg )>0){
		foreach($allImg as $item){
			$srcSlider = ImageHelper::getImageUrl($item,'image' , '540x300');
			$srcThumb  = ImageHelper::getImageUrl($item,'image', '85x60');
			$title     = strip_tags($item->title);
			$htmlSlider .='<li><img src="'.$srcSlider.'" alt="" title="'.$title.'"/><div class="slide_text"><p>'.$title.'</p></div></li>';
			$htmlThumb  .='<li><img src="'.$srcThumb.'" alt="" title="'.$title.'"/></li>';
		}
	}	
?>
<?php if($htmlSlider !=''): ?>
<div class="gallery-dt clearfix">
	<div class="connected-carousels">
		<div class="stage">
			<div class="carousel carousel-stage">
				<ul>
					<?php echo $htmlSlider; ?>		
				</ul>
			</div>
		</div>

		<div class="navigation">
			<div class="carousel carousel-navigation">
				<ul>
					<?php echo $htmlThumb; ?>
				</ul>
			</div>
            <div class="navibottom"><a href="#" class="prev prev-navigation">&lsaquo;</a>
			<a href="#" class="next next-navigation">&rsaquo;</a></div>
		</div>
	</div> 
</div> 
<?php endif; ?>	