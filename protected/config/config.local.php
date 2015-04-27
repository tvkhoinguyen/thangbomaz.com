<?php 
$THEME_NAME = 'designofasia';
$THEME		= 'designofasia';
$TABLE_PREFIX = 'asia';
   
include 'config_host/host.php';

//All defined items in Yii-core
//Please do not change if not require
define('LINK_WEB_SERVICE', "http://raobanusa.com/site/serviceGetTin/token/thangbomaz.com");

define('BE', 1);
define('FE', 2);

define('ROLE_MANAGER', 1);
define('ROLE_ADMIN', 2);
define('ROLE_MEMBER', 3);

//max records in logger table
define('LOGGER_TABLE_MAX_RECORDS', 2000);

define('PASSW_LENGTH_MIN', 6);
define('PASSW_LENGTH_MAX', 32);

define('VERZ_COOKIE_ADMIN', md5('verz_cookie_admin'));
define('VERZ_COOKIE', md5('verz_cookie'));
define('VERZLOGIN', md5('verz_login'));
define('VERZLPASS', md5('verz_pass'));

define('VERZ_COOKIE_MEMBER', md5('verz_cookie_member'));
define('VERZLOGIN_MEMBER', md5('verz_login_member'));
define('VERZLPASS_MEMBER', md5('verz_pass_member'));

define('STATUS_INACTIVE', 0);
define('STATUS_ACTIVE', 1);
define('STATUS_NEW', 2);
define('STATUS_WAIT_ACTIVE_CODE', 3);

define('TYPE_YES', 1);
define('TYPE_NO', 0);

define('BANNER_1_WIDTH', 960);
define('BANNER_1_HEIGHT', 300);

define('BANNER_2_WIDTH', 230);
define('BANNER_2_HEIGHT', 69);

define('BANNER_3_WIDTH', 229);
define('BANNER_3_HEIGHT', 119);

define('ADS_HOME_WIDTH', 260);
define('ADS_HOME_HEIGHT', 170);
define('ADS_HOME_THUMBS_WIDTH', 131);
define('ADS_HOME_THUMBS_HEIGHT', 86);

define('ADS_INSIDE_PAGE_WIDTH', 281);
define('ADS_INSIDE_PAGE_HEIGHT', 241);
define('ADS_INSIDE_PAGE_THUMBS_WIDTH', 131);
define('ADS_INSIDE_PAGE_THUMBS_HEIGHT', 112);

define('ADS_BLOG_TOP_WIDTH', 728);
define('ADS_BLOG_TOP_HEIGHT', 90);
define('ADS_BLOG_TOP_THUMBS_WIDTH', 281);
define('ADS_BLOG_TOP_THUMBS_HEIGHT', 35);

define('IMAGE_ADMIN_WIDTH', 260);
define('IMAGE_ADMIN_HEIGHT', 200);

define('IMAGE_ADMIN_THUMB_WIDTH', 117);
define('IMAGE_ADMIN_THUMB_HEIGHT', 90);

//block
define('BLOCK_WIDTH', 100);
define('BLOCK_HEIGHT', 100);

//menu
//define('MENU_QUICK_LINKS', 5);
define('MENU_LEFT', 1); //footer left
define('MENU_RIGHT', 2); //footer right
define('MENU_MAIN', 7);

//CMS
define('EXTERNAL_PAGE', 14);
define('PAGE_SUCCESS_SIGN_UP', 8);
define('PAGE_SUCCESS_RESET_PASSWORD', 13);

//mail
define('MAIL_REGISTER_SUCCEED_TO_MEMBER', 1);
define('MAIL_REGISTER_SUCCEED_TO_ADMIN', 2);
define('MAIL_FORGET_PASSWORD', 3);
define('MAIL_CONTACT_US_TO_ADMIN',4);   //contact us send admin
define('MAIL_CONTACT_US_TO_USER',5);	//contact us send User
define('MAIL_CHANGE_PASSWORD_TO_USER',6);
define('MAIL_VERIFY_TO_RESET_PASSWORD_TO_ADMIN',7);
define('MAIL_RESET_PASSWORD_TO_ADMIN',8);
define('MAIL_CHANGE_PASSWORD_TO_ADMIN',9);
define('MAIL_ADMIN_RESET_PASS', 28);
define('MAIL_ADMIN_REQUEST', 30);
define('MAIL_USER_REQUEST', 31);

//max time for failed login to show captcha required
define('MAX_TIME_TO_SHOW_CAPTCHA', 2);

//HuuTHoa
define('CONTACT_BLOCK', 14);
define('NEWLETTER_BLOCK', 24);
define('ITEM_PAGING', 8);
define('PRODUCT_NO_ID_PREFIX', 'PRO');
define('PRODUCT_NO_ID_START_NUMBER', 100000);
define('RECOMMEND_LIMIT', 10);
define('PERCENT_METHOD', 1);
define('DOLAR_METHOD', 2);
define('TERM_PAGE_ID', 22);
define('NEED_FURTHER_ID', 43);
define('MAX_QUANTITY', 100);

//Vnguyen
define('COUPON_METHOD_PERCENTAGE', 1);
define('COUPON_METHOD_DOLLAR_VALUE', 2);
define('COUPON_STATUS_AVAILABLE', 1);
define('COUPON_STATUS_USED', 2);

//Vnguyen
define('SUBSCRIBER_GROUP_PUBLIC_USER', 1);
define('SUBSCRIBER_GROUP_MEMBER', 2);



//Status order

define('BLOCK_PRINT_PDF_HEADER', 30);
define('BLOCK_PRINT_PDF_FOOTER', 31);

define('UPS_DELIVERY_AGENT', 1);
define('FEX_DELIVERY_AGENT', 2);

define('SELFT_COLLECTION', 1);
define('DELIVERY_COLLECTION', 2);
define('ORDER_OFFLINE', 0);
define('ORDER_ONLINE', 1);
define('DEFAULT_COUNTRY_ID', 229);

// XUAN TINH smart block
define('WELLCOME_HOME', 30);
define('SERVICE_PRINT', 31);
define('SERVICE_DESIGN', 36);
define('SERVICE_DISPLAY', 37);
define('SERVICE_CORPORATE', 38);
define('HOW_REGISTER', 39);
define('HOW_ADD_PRODUCT', 40);
define('HOW_SECURE_PAYMENT', 41);
define('HOW_COLLECT_ORDER', 42);

/*DTOAN*/
define('BLOCK_THANK_YOU_ENQUIRY', 53);
define('SESSION_ENQUIRY',md5('SESSION_ENQUIRY'));
define('MAIL_ENQUIRY_TO_SENDER',31);
define('MAIL_ENQUIRY_TO_DESINGER', 31);
define('MAIL_ENQUIRY_TO_ADMIN', 32);
define('MAIL_SNATCH_NOW', 33);

?>