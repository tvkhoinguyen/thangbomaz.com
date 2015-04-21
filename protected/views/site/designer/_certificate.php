<?php 
	$htmlCertificate = '';
	$allCertificate = InteriorDesignLicense::model()->getListImageWithDesignerId($model->id);
	if(is_array($allCertificate)  && count($allCertificate)>0){
		foreach($allCertificate as $certificate){
		 	$srcCertificate   = ImageHelper::getImageUrl($certificate,'image' , '85x60');
		 	$htmlCertificate .= '<img src="'.$srcCertificate.'">';
		}
	}
	if($htmlCertificate !=''){
		echo "<h4>License/ Certificate</h4><div class=\"designer-certificate\"><p>$htmlCertificate</p></div>";		
	}
?>