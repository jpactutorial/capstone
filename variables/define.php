<?php
define("icon","img/icons/icon.jpg?version=1");
define("link_profile","index.php");
define("link_reports","#");

date_default_timezone_set('Asia/Manila');

/*
session_cache_limiter('private');
$cache_limiter = session_cache_limiter();

/* set the cache expire to 30 minutes */
/*
session_cache_expire(0);
$cache_expire = session_cache_expire();

/* start the session */

header("Cache-Control: no-cache, must-revalidate");
session_start();

$GLOBAL['con_status']=true;
$GLOBAL['con_error']="";
define('db_server','localhost');
define('db_name','capstone');
define('db_user','root');
define('db_pass','');
define('site_url','http://localhost/capstone');

?>