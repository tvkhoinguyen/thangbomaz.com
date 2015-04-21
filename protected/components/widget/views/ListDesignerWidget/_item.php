<?php 
	$title  	=  StringHelper::createShort(strip_tags(nl2br($data->interior_name)), 30);
	$srclogo    = ImageHelper::getImageUrl($data, 'logo', '120x120');
	$srcPresent = ImageHelper::getImageUrl($data, 'present_image', '205x182');
	$link = Yii::app()->createAbsoluteUrl('site/designerdetail',array('slug'=>$data->slug)) ;
?>
<div class="jm-item second itembox2-left">
    <div class="jm-item-wrapper">
        <div class="jm-item-image"> 
        	<a href="<?php echo $link; ?>">
        		<img src="<?php echo $srcPresent; ?>" alt=""/>
        	</a>
            <a href="<?php echo $link; ?>"> 
            	<div class="jm-item-description">
	            	<img src="<?php echo  $srclogo; ?>" alt=""/>
	              	<h3><?php echo $title; ?></h3>
	            </div>
            </a>
        </div>
        <div class="jm-item-title"><?php echo $title; ?></div>
    </div>
</div>