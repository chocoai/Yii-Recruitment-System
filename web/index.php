<?php
$uarowser = $_SERVER['HTTP_USER_AGENT'];
if (strstr($uarowser, 'MSIE 6') || strstr($uarowser, 'MSIE 7') || strstr($uarowser, 'MSIE 8')) {
    header("Content-type: text/html; charset=utf-8");
    echo '<div style="text-align: center"><h1>对不起，本站不支持低版本IE浏览器！</h1><p>站长表示实在是兼容不了低版本的IE浏览器，请升级你的IE浏览器。</p><p>推荐升级至IE9或者试试火狐浏览器和谷歌浏览器，如果你对IE是真爱......那么请关闭本站吧。</p></div>';
    exit;//全面停止支持
}
// change the following paths if necessary
$yii = dirname(__FILE__) . '/../framework/yii.php';
$config = dirname(__FILE__) . '/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG', true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL', 3);

require_once($yii);
Yii::createWebApplication($config)->run();
