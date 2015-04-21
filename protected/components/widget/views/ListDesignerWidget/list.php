<?php
    $this->widget('zii.widgets.CListView', array(
    //                'id'=>'banners-grid1',
        'dataProvider'=>$model,
        'itemView'=>'ListDesignerWidget/_item',
        'template'=>'{items}<nav>{pager}</nav>',
        'itemsTagName'=>'div',
        'itemsCssClass' => '',
        'pagerCssClass' => '',
        'enablePagination'=>true,
        'pager' => array(
            'header' => false,
            'firstPageLabel' => '<span class="glyphicon glyphicon-fast-backward"></span>',
            'prevPageLabel' =>  '<span class="glyphicon glyphicon-chevron-left"></span>',
            'nextPageLabel' =>  '<span class="glyphicon glyphicon-chevron-right"></span>',
            'lastPageLabel' =>  '<span class="glyphicon glyphicon-fast-forward"></span>',
            'maxButtonCount'=>4,
            'htmlOptions' => array('class' => 'pagination clearfix'),
            'selectedPageCssClass' => 'active',
        ),
    ));
?>