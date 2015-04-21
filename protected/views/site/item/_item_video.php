<?php
	$arr = explode('?v=', $data->link);
	$temp = '//www.youtube.com/embed/'.$arr[1];
?>
<br/>
<iframe width="640" height="480" src="<?php echo $temp; ?>" frameborder="0" allowfullscreen></iframe>
<!-- <iframe width="800" height="600" src="<?php echo $temp; ?>" frameborder="0" allowfullscreen></iframe> -->
<br/>