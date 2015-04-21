<ul class="breadcrumb">
	<li><a href="<?php echo Yii::app()->getHomeUrl() ?>">Home</a></li>
	<li><a href="<?php echo Yii::app()->createAbsoluteUrl('site/listdesigner') ?>">Interior Designers</a></li>
    <li><?php echo $model->interior_name; ?></li>
</ul>

<h3 class="ttl-cnt"><?php echo $model->interior_name; ?></h3>
<?php include '_slider.php'; ?>      

<div class="box-info-detail clearfix">
  	<div class="imgbox-detail">

    	<img src="<?php echo ImageHelper::getImageUrl($model,'logo' , '170x100'); ?>" alt="<?php echo strip_tags($model->interior_name); ?>"/>
        <a class="btn-cart" id="btn-add-enquiry" data-loading-text="Loading..."  autocomplete="off"  href="javascript:;"> Add to enquiry cart </a>
        <a href="javascript:;" rel="<?php echo Yii::app()->createAbsoluteUrl('site/processenquiry',array('slug'=>$model->slug,'type'=>'single')); ?>" rel-title="Enquiry Form" class="btn btn-en callPopoupEnqury" rel-title=".address-book-title" data-toggle="modal"  data-target="#Loadpopup">Enquiry this firm</a>

        <div class="m-share">
        	<!-- Go to www.addthis.com/dashboard to customize your tools -->
		    <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54894f6545bd2aa6" async="async"></script>
		    <!-- Go to www.addthis.com/dashboard to customize your tools -->
		    <div class="addthis_sharing_toolbox"></div>
        </div>
    </div>
    <div class="desbox-detail">
  		<p><strong>Established:</strong><br/><?php echo strip_tags($model->established); ?></p>
    	<p><strong>Warranty / After Sale Service:</strong><br/>
		<?php echo strip_tags($model->warranty_after_sale_service); ?></p>
        <p><strong>Address:</strong><br/>
		<?php echo strip_tags($model->address); ?></p>
    </div>
</div>

<div class='document'>
	<?php echo $model->description;?>
	<div class="clearfix"></div>	
	<?php include '_certificate.php'; ?>
	<div class="clearfix"></div>
	<h4>Address</h4>
	<div id="map_canvas" class="map" style='height:288px; width:100%;'></div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&region=SG"></script>
<script>
    /*--------------------Google map----------------*/
    var geocoder;
    var map;
    var flag = true;
    function initialize() {
        geocoder = new google.maps.Geocoder();
        var mapOptions = {
            zoom: 18,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        }
        map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
        codeAddress();
    }

    function codeAddress() {
        var address = '<?php echo $model->address; ?>';
        geocoder.geocode({'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
    			var contentString = '<div id="content">'+
    				'<h1><?php echo strip_tags($model->interior_name) ?></h1>'+
    				'<div>'+
    				'<p><?php echo strip_tags($model->address) ?></p>'+
    				'</div>'+
    				'</div>';

    			var infowindow = new google.maps.InfoWindow({
    				content: contentString,
    				maxWidth: 500
    			});
    			
    			var companyImage = new google.maps.MarkerImage('<?php echo Yii::app()->theme->baseUrl ?>/img/pin.png',
    				new google.maps.Size(131,76),
    				new google.maps.Point(0,0)
    			);

    			var marker = new google.maps.Marker({
    				position: results[0].geometry.location,
    				map: map,
    				icon: companyImage,
    				title: '<?php echo strip_tags($model->interior_name); ?>'
    			});

                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });

            } else {
                flag = false;
            }
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);	

    /*-------------------- end google map----------------*/

    $(function() {
       
        addEnquiry('#btn-add-enquiry','<?php echo Yii::app()->createAbsoluteUrl('site/addenquiry',array('desingerid'=>$model->id)) ?>','Add enquiry successfully');
    });

</script>



<?php 
    $block   = SmartBlock::model()->getInfoRecordWithTable(array('id'=>BLOCK_THANK_YOU_ENQUIRY));
    $content =  (isset($block->content)) ? $block->content : '';
    $title   =  (isset($block->title)) ? $block->title : '';
?>
<div class="modal fade" id="ModalThankyou" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h3 class="modal-title" style="text-align:center;"><?php echo $title; ?></h3>
            </div>
            <div class="modal-body">
                <?php echo $content;  ?>
            </div>
        </div>
    </div>
</div>