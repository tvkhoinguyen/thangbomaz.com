<?php
$this->breadcrumbs = array(
    'Interior Designer'=>Yii::app()->createAbsoluteUrl('admin/designer'),
    $this->designerId->interior_name,    
    $this->pluralTitle => Yii::app()->createAbsoluteUrl('admin/gallerydesigner',array('designerId'=> $this->designerId->id)),
	'Update ' . $this->singleTitle,
);

$this->menu = array(	
	array('label' => $this->pluralTitle, 'url'=>array('index','designerId'=>$this->designerId->id), 'icon' => $this->iconList),
	array('label' => 'View ' . $this->singleTitle, 'url' => array('view','designerId'=>$this->designerId->id ,'id' => $model->id)),	
	array('label' => 'Create ' . $this->singleTitle, 'url' => array('create','designerId'=>$this->designerId->id)),
);
?>

<h1>Update <?php echo $this->singleTitle . ': ' . $title_name; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
