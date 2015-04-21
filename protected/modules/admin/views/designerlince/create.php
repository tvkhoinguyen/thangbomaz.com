<?php
$this->breadcrumbs=array(
    'Interior Designer'=>Yii::app()->createAbsoluteUrl('admin/designer'),
    $this->designerId->interior_name,    
    $this->pluralTitle => Yii::app()->createAbsoluteUrl('admin/designerlince',array('designerId'=> $this->designerId->id)),
	'Create ' . $this->singleTitle,
);

$menus= array(		
        array('label'=> $this->pluralTitle , 'url'=>array('index','designerId'=>$this->designerId->id), 'icon' => $this->iconList),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Create <?php echo $this->singleTitle; ?></h1>

<?php
//for notify message
$this->renderNotifyMessage(); 
//for list action button
echo $this->renderControlNav();
?><?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
