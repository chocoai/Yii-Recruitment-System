<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => '聘Cloud',
    'timezone' => 'PRC', //设置时区
    'language' => 'zh_cn',

    // preloading 'log' component
    'preload' => array('log'),

    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',

        'application.modules.rights.*',
        'application.modules.rights.components.*', // Correct paths if necessary.

        'application.extensions.PHPExcel.*',
    ),

    'modules' => array(
        // uncomment the following to enable the Gii tool
        /*
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123456',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
        ),
        */


        'rights' => array(
            'install' => true, // Enables the installer.
            'superuserName' => 'admin',
            'debug' => true,
            'userClass' => 'SystemUser',
            'layout' => 'rights.views.layouts.p2p',
            'appLayout' => 'application.views.layouts.ace.main',
        ),
        'interview',
        'setting'
    ),

    // application components
    'components' => array(

        'user' => array(
            // enable cookie-based authentication
            'allowAutoLogin' => true,
            'class' => 'RWebUser',
//			'loginUrl'=>array('system/login'),
        ),

        'authManager' => array(
            'class' => 'RDbAuthManager', // Provides support authorization item sorting.
            'assignmentTable' => 't_authassignment',
            'itemTable' => 't_authitem',
            'itemChildTable' => 't_authitemchild',
            'rightsTable' => 't_rights',
            'defaultRoles' => array('Guest'),
        ),

        // uncomment the following to enable URLs in path-format
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'appendParams' => false,
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),

        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),

        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'error/index',
        ),

        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // uncomment the following to show log messages on web pages
                /*
                array(
                    'class'=>'CWebLogRoute',
                ),
                */
            ),
        ),

    ),
    'defaultController' => 'Index/index',

    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
        'version' => 'alpha版本',

        /**
         * 分页参数
         */
        'pagination' => array(
            'pageSize' => 10,
            'pageVar' => 'p',
        ),
        /**
         * CGridView 样式
         */
        'CGridView' => array(
            'summaryText' => "页数：{pages}/{page}页   总条数{count} ",
            'pager' => array(
                'header' => '',
                'prevPageLabel' => '上一页',
                'nextPageLabel' => '下一页',
                'firstPageLabel' => '首页',
                'lastPageLabel' => '尾页',
                'maxButtonCount' => 12,
                'htmlOptions' => array('class' => 'pagination', 'style' => 'margin:0px'),
                'selectedPageCssClass' => 'active',
                'hiddenPageCssClass' => 'disabled'
            ),
            'htmlOptions' => array('class' => 'span12 igrid-view'),
            'itemsCssClass' => 'table table-striped table-bordered table-hover items',
            'enableSorting' => true,
        )

    ),
);
