<?php
$this->breadcrumbs=array(
	$this->pluralTitle,
);
$this->menu=array(
	array('label'=>'Create ' . $this->singleTitle, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('interior-design-grid', {
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
	$.fn.yiiGridView.update('interior-design-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"interior-design-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('interior-design-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('interior-design-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#interior-design-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('interior-design-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('interior-design-grid');
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
				
                 array(
                    'name' => 'logo',
                    'type'=>'raw',
                    'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;width:100px;'),
                    'htmlOptions' => array('style' => 'text-align:center;'),
                    'value'=>'($data->logo !="") ? CHtml::image(Yii::app()->createAbsoluteUrl($data->uploadImageFolder . "/".$data->id."/120x120/".$data->logo),null,array("style"=>"width:50%")) : ""  '
                    //'value'=>'($data->logo !="") ? "<div class=\"thumbnail\">" .CHtml::image(Yii::app()->createAbsoluteUrl($data->uploadImageFolder . "/".$data->id."/".$data->logo),null,array("style"=>"width:100%")). "</div>" : ""  '
                ),

                'interior_name',

				'established',
				'address',
				array(
					'name' => 'feature_designer',
					'value'=>'(isset($data->optionFeature[$data->feature_designer])) ? $data->optionFeature[$data->feature_designer] : ""',
					'htmlOptions' => array('style' => 'text-align:center;'),
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;width:100px;'),
				),	
				array(
						'header' => 'License / Certificate',
						'type'=>'html',
						'value'=>'CHtml::link("<span title=\"Gallery\" class=\"glyphicon glyphicon-picture\"></span>",Yii::app()->createAbsoluteUrl("admin/designerlince/index",array("designerId"=>$data->id)))',
						'htmlOptions' => array('style' => 'text-align:center;width:110px;')
				),
				array(
						'header' => 'Gallery',
						'type'=>'html',
						'value'=>'CHtml::link("<span title=\"Gallery\" class=\"glyphicon glyphicon-picture\"></span>",Yii::app()->createAbsoluteUrl("admin/gallerydesigner/index",array("designerId"=>$data->id)))',
						'htmlOptions' => array('style' => 'text-align:center;'),
						'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;width:50px;'),
				),				
				array(
					'name'=>'status',
					'type'=>'status',
					'value'=>'array("id"=>$data->id,"status"=>$data->status)',
					'htmlOptions' => array('style' => 'text-align:center;'),
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;width:50px;'),
			   ),
				array(
					'name' => 'create_date',
					'type' => 'date',
					'htmlOptions' => array('style' => 'text-align:center;'),
					'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;width:90px;'),
				),
				array(
					'header' => 'Actions',
					'class'=>'CButtonColumn',
					'template'=> ControllerActionsName::createIndexButtonRoles($actions),
					/*'buttons' => array(
							'delete' => array('visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDelete) . '))'),
							'update' => array('visible' => 'strpos("' . $actions . '", "update") !== false'),
							'view' => array('visible' => 'strpos("' . $actions . '", "view") !== false')
							), */
				),
			));
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'interior-design-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			$this->renderDeleteAllButton(); 
			
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'interior-design-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				//'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'enableSorting' => false,
				'dataProvider'=>$model->search(),
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
