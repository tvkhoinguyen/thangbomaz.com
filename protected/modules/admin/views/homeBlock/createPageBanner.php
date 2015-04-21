<?php
$this->breadcrumbs=array(
	$this->pluralTitle => array('indexPageBanner'),
	'Create ' . $this->singleTitle,
);

$this->menu = array(		
        array('label'=> $this->pluralTitle , 'url'=>array('indexPageBanner'), 'icon' => $this->iconList),
);

?>

<h1>Create <?php echo $this->singleTitle; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><?php echo $this->renderPartial('_formPageBanner', array('model'=>$model)); ?>
