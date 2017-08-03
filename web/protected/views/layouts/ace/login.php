<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="description" content="免费开源的云招聘解决方案,招聘系统,简历管理,招聘平台"/>
    <title>登录 - <?php echo CHtml::encode(Yii::app()->name); ?> - 免费开源的云招聘解决方案</title>
    <meta http-equiv="Cache-Control" CONTENT="no-cache">
    <meta http-equiv="Expires" content="0" />
    <meta name="description" content="登录"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/font-awesome.min.css"/>

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/ace-fonts.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/ace.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/ace/css/ace-part2.min.css"/>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/ace-rtl.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/ace/css/ace-ie.min.css"/>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/ace.onpage-help.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css">
</head>

<body class="login-layout blur-login">
<div class="main-container">
    <div class="main-content">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="center">
                        <h1>
                            <i class="ace-icon fa fa-desktop green"></i>
                            <span class="white" id="id-text2"><?php echo CHtml::encode(Yii::app()->name); ?></span>
                        </h1>
                    </div>

                    <div class="space-6"></div>

                    <div class="position-relative">
                        <div id="login-box" class="login-box visible widget-box no-border">
                            <div class="widget-body">
                                <div class="widget-main">
                                    <h4 class="header blue lighter bigger">
                                        <i class="ace-icon fa fa-coffee green"></i>
                                        请输入登录信息
                                    </h4>

                                    <div class="space-6"></div>
                                    <?php echo $content; ?>
                                    <div class="space-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
