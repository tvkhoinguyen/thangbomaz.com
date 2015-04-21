<?php

$this->breadcrumbs=array(
	'Interior Designer'=>Yii::app()->createAbsoluteUrl('admin/designer'),
	$this->designerId->interior_name,
	$this->pluralTitle,
);

$this->menu=array(
	array('label'=>'Create ' . $this->singleTitle, 'url'=>array('create','designerId'=>$this->designerId->id)),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('interior-design-gallery-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});

$('#clearsearch').click(function(){
	var id='search-form';
	var inputSelector='#'+id+' input, '+'#'+id+' select';
	$(inputSelector).each( function(i,o) {
		 $(o).val('');
	});
	var data=$.param($(inputSelector));
	$.fn.yiiGridView.update('interior-design-gallery-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"interior-design-gallery-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('interior-design-gallery-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('interior-design-gallery-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#interior-design-gallery-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('interior-design-gallery-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('interior-design-gallery-grid');
            }
        });
        return false;
    });
");
?>
<h1><?php echo $this->pluralTitle; ?></h1>
<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class='search-form' style='display:none'>
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?></div>

<?php echo $this->renderControlNav();?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title"><span class="<?php echo $this->iconList; ?>"></span> Listing</h3>
	</div>
	<div class="panel-body">
		<?php 
			$allowAction = in_array("delete", $this->listActionsCanAccess)?'CCheckBoxColumn':'';
			$columnArray = array();
			if (in_array("Delete", $this->listActionsCanAccess))
			{
				$columnArray[] = array(
									'value'=>'$data->id',
									'class'=> "CCheckBoxColumn",
								);
			}
			$columnArray = array_merge($columnArray, array(
				array(
					'header' => 'S/N',
					'type' => 'raw',
					'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
					'htmlOptions' => array('style' => 'text-align:center;')
				),
/*                 array(
                    'name' => 'image',
                    'type'=>'raw',
                    'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;width:150px;'),
                    'value'=>'($data->image !="") ? CHtml::image(Yii::app()->createAbsoluteUrl($data->uploadImageFolder . "/".$data->id."/540x300/".$data->image),null,array("style"=>"width:100%")) : ""  '
                ),	*/
                 array(
                    'name' => 'image',
                    'type'=>'raw',
                    'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;width:150px;'),
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'value'=>'($data->image !="") ? CHtml::image(Yii::app()->createAbsoluteUrl($data->uploadImageFolder . "/".$data->id."/540x300/".$data->image),null,array("style"=>"width:50%")) : ""  '
                ),

				'title',
				array(
					'name'=>'status',
					'type'=>'status',
					'value'=>'array("id"=>$data->id,"status"=>$data->status)',
					'htmlOptions' => array('style' => 'text-align:center;')
			   ),
				array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'template'=> ControllerActionsName::createIndexButtonRoles($actions),
					'buttons' => array(
							'delete'=>array(
								'url'=>'Yii::app()->createAbsoluteUrl("admin/gallerydesigner/delete",array("designerId"=>$data->designer_id,"id"=>$data->id))',		
							),
							'update'=>array(
								'url'=>'Yii::app()->createAbsoluteUrl("admin/gallerydesigner/update",array("designerId"=>$data->designer_id,"id"=>$data->id))',		
							),
							'view'=>array(
								'url'=>'Yii::app()->createAbsoluteUrl("admin/gallerydesigner/view",array("designerId"=>$data->designer_id,"id"=>$data->id))',		
							)

						), 
				),
			));
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'interior-design-gallery-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			$this->renderDeleteAllButton(); 
			
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'interior-design-gallery-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				//'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'dataProvider'=>$model->search(),
				'enableSorting' => false,
				'pager'=>array(
							'header'         => '',
							'prevPageLabel'  => 'Prev',
							'firstPageLabel' => 'First',
							'lastPageLabel'  => 'Last',
							'nextPageLabel'  => 'Next',
						),
				'selectableRows'=>2,
				'columns'=>$columnArray,
		)); 
		$this->endWidget();
		?>
