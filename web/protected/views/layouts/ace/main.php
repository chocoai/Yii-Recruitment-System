<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <title><?php echo CHtml::encode(Yii::app()->name); ?></title>
    <meta name="description" content="可定制的云招聘管理系统"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/font-awesome.min.css"/>

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/ace-fonts.css"/>

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/ace.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/ace/css/ace-part2.min.css"/>
    <![endif]-->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/ace-skins.min.css"/>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/ace/css/ace-rtl.min.css"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl;?>/ace/css/ace-ie.min.css"/>
    <![endif]-->

    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/base.css"/>

    <!-- inline styles related to this page -->
    <!-- ace settings handler -->
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/ace/js/ace-extra.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="<?php echo Yii::app()->request->baseUrl;?>/ace/js/html5shiv.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl;?>/ace/js/respond.min.js"></script>
    <![endif]-->

    <?php $this->renderPartial('application.views.layouts.ace._base'); ?>

    <script type="text/javascript">
        var PING_URL = '<?php echo Yii::app()->request->baseUrl;?>';
    </script>
</head>

<body class="no-skin">
<?php $this->renderPartial('application.views.layouts.ace.nav'); ?>
<div id="main-container" class="main-container">
    <?php $this->renderPartial('application.views.layouts.ace.sidebar'); ?>
    <div class="main-content">
        <?php $this->renderPartial('application.views.layouts.ace.breadcrumbs'); ?>
        <div class="page-content">
            <div class="row">
                <div class="col-xs-12">

                    <?php if (!empty($this->getModule()->id) && (!in_array($this->getModule()->id, array('rights')))):?>
                    <div class="page-header">
                        <h1>
                            <?php echo YII::t('ping', $this->getId()); ?>
                            <small>
                                <i class="ace-icon fa fa-angle-double-right"></i>
                                <?php echo YII::t('ping', $this->getAction()->id); ?>
                            </small>
                        </h1>
                    </div>
                    <?php endif; ?>

                    <?php echo $content; ?>
                </div>
            </div>
        </div>
    </div>
    <?php $this->renderPartial('application.views.layouts.ace.footer'); ?>
</div>
</body>

</html>

