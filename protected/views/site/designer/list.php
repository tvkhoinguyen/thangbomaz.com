<ul class="breadcrumb">
	<li><a href="<?php echo Yii::app()->getHomeUrl(); ?>">Home</a></li>
    <li>Interior Designers</li>
</ul>

<h3 class="ttl-cnt">Interior Designers</h3>  
<div class='box2-left clearfix'>
	<?php $this->widget('ListDesignerWidget',array('position'=>2,'limitItem'=>12));  ?>
</div>
