<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta charset="utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="copyright" content="<?php echo CHtml::encode($this->pageTitle); ?>" />

<?php 
$desc = $this->getMetaDescription();
$keyword = $this->getMetaKeywords();
if (!empty($desc)) {
   echo "<meta content='{$desc}' name='description' />";
}
if (!empty($keyword)) {
    echo "<meta content='{$keyword}' name='keywords' />";
} 
?>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> -->
<!-- <meta name="viewport" content="width=1280" />  -->
<meta content="telephone=no" name="format-detection" />
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />


<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/style.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/superfish.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/superfish-navbar.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/slider.css">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/menuleft.css">

<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/custom.css" rel="stylesheet" media="screen" /> 


<link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />
<!-- <link rel="shortzcut icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" /> -->
<link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />
<?php /*
	<link rel="SHORTCUT ICON" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" type="image/x-icon" />
	<link rel="icon" type="image/png" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />
	<link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.png" />
*/?>

<?php 
// Yii::app()->clientScript->registerCoreScript('jquery'); 
// Yii::app()->clientScript->registerCoreScript('jquery.ui'); 
?> 
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.js" type="text/javascript"> </script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/superfish.js" type="text/javascript"> </script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.easing.1.2.js" type="text/javascript"> </script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.anythingslider.js" type="text/javascript"> </script>
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/sunghiep.js" type="text/javascript"> </script> -->
<!-- <script src="<?php echo Yii::app()->theme->baseUrl; ?>/script.js" type="text/javascript"> </script> -->
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/html5gallery/html5gallery.js" type="text/javascript"> </script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/holder.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/custom.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/cycle-plugin.js"></script>

<script type="text/javascript">
tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");

function GetClock(){
	var d=new Date();
	var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear(),nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds(),ap;

	     if(nhour==0){ap=" AM";nhour=12;}
	else if(nhour<12){ap=" AM";}
	else if(nhour==12){ap=" PM";}
	else if(nhour>12){ap=" PM";nhour-=12;}

	if(nyear<1000) nyear+=1900;
	if(nmin<=9) nmin="0"+nmin;
	if(nsec<=9) nsec="0"+nsec;

	// document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+ap+"";
}

window.onload=function(){
	GetClock();
	setInterval(GetClock,1000);
}
</script>

<!-- <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script> -->
<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"7CWYk1ao6C5252", domain:"thangbomaz.com",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=7CWYk1ao6C5252" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->  