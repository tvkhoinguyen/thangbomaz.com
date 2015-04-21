<?php
$this->breadcrumbs=array(
	$this->pluralTitle,
);
$this->menu=array(
	// array('label'=>'Create ' . $this->singleTitle, 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('home-block-grid', {
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
	$.fn.yiiGridView.update('home-block-grid', {data: data});
	return false;
});

$('.deleteall-button').click(function(){
        var atLeastOneIsChecked = $('input[name=\"home-block-grid_c0[]\"]:checked').length > 0;
        if (!atLeastOneIsChecked)
        {
                alert('Please select at least one record to delete');
        }
        else if (window.confirm('Are you sure you want to delete the selected records?'))
        {
                document.getElementById('home-block-grid-bulk').action='" . Yii::app()->createAbsoluteUrl('admin/' . Yii::app()->controller->id  . '/deleteall') . "';
                document.getElementById('home-block-grid-bulk').submit();
        }
});

");

Yii::app()->clientScript->registerScript('ajaxupdate', "
    $('#home-block-grid a.ajaxupdate').live('click', function() {
        $.fn.yiiGridView.update('home-block-grid', {
            type: 'POST',
            url: $(this).attr('href'),
            success: function() {
                $.fn.yiiGridView.update('home-block-grid');
            }
        });
        return false;
    });
");
?>
<h1><?php echo $this->pluralTitle; ?></h1>


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
			$columnArray = 
			// array_merge($columnArray, 
				array(
					array(
						'header' => 'S/N',
						'type' => 'raw',
						'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
						'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
						'htmlOptions' => array('style' => 'text-align:center;')
					),
					// 'image',
					array(
						'header' => '<a class="sort-link">Image</a>',
						'type' => 'raw',
						'value' => 'isset($data)
					                ?
					                    CHtml::image(ImageHelper::getImageUrl($data, "image", PageBanner::SIZE ) )
					                :"";',
						'headerHtmlOptions' => array('style' => 'text-align:center;'),
						'htmlOptions' => array('style' => 'text-align:center;')
						),
					// 'name',
					'link',
					array(
						'header' => "Status",
						'name'=>'status',
						'type'=>'status',
						'value'=>'array("id"=>$data->id,"status"=>$data->status)',
						'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
						'htmlOptions' => array('style' => 'text-align:center;')
					   ),
					// 'title',
					// array(
					// 	'header' => '<a class="sort-link">Page</a>',
					// 	'type' => 'raw',
					// 	'value' => 'isset($data) && $data->type=="index"
					//                 ? "Index Page" 
					//                 : "Service Page" ',
					// 	'headerHtmlOptions' => array('style' => 'text-align:center;'),
					// 	'htmlOptions' => array('style' => 'text-align:center;')
					// 	),
					// 'type',
					// 'content',
					array(
						'header' => 'Actions',
						'class'=>'CButtonColumn',
						'template'=> '{view}{update}',
						'buttons' => array(
								// 'delete' => array('visible' => '!in_array($data->id, array(' . implode(',', $this->cannotDelete) . '))'),
								'view' => array
								        (
								            // 'label'=>'Send an e-mail to this user',
								            // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
								            'url'=>' Yii::app()->createAbsoluteUrl("admin/homeBlock/viewPageBanner", array("id"=>$data->id)) ',
								        ),
								'update' => array
								        (
								            // 'label'=>'Send an e-mail to this user',
								            // 'imageUrl'=>Yii::app()->request->baseUrl.'/images/email.png',
								            'url'=>' Yii::app()->createAbsoluteUrl("admin/homeBlock/updatePageBanner", array("id"=>$data->id)) ',
								        ),
								), 
					),
					// )
				);
			$form=$this->beginWidget('CActiveForm', array(
			'id'=>'home-block-grid-bulk',
			'enableAjaxValidation'=>false,
			'htmlOptions'=>array('enctype' => 'multipart/form-data')));

			$this->renderNotifyMessage(); 
			// $this->renderDeleteAllButton(); 
			
			$this->widget('zii.widgets.grid.CGridView', array(
				'id'=>'home-block-grid',
				//KNguyen fix holder.js not load after gridview update
				//By: add new jquery gridview and content in Folder:  customassets/gridview
				//And custom update function
				'baseScriptUrl'=>Yii::app()->baseUrl.DIRECTORY_SEPARATOR.'customassets'.DIRECTORY_SEPARATOR.'gridview',
				'dataProvider'=>$model->searchPageBanner(),
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
