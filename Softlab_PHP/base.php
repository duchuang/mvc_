<?php
require_once 'Route/route.php';
require_once 'lib/Controller.php';
require_once 'lib/db/db.class.php';
require_once 'Conf/config.php';
require_once 'lib/log.class.php';
require_once 'lib/addslashes.php';
require_once 'App/Common/Common.php';
Common::Start();
Route::Start();
//过滤参数递归过滤GET POST COOKIE
$_GET = _addslashes($_GET);
$_POST = _addslashes($_POST);
$_COOKIE = _addslashes($_COOKIE);
?>