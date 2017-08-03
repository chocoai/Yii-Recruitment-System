<div class="navbar navbar-default" id="navbar">
    <script type="text/javascript">
        try {
            ace.settings.check('navbar', 'fixed')
        } catch (e) {
        }
    </script>

    <div id="navbar-container" class="navbar-container">
        <!-- #section:basics/sidebar.mobile.toggle -->
        <button id="menu-toggler" class="navbar-toggle menu-toggler pull-left" type="button">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <!-- /section:basics/sidebar.mobile.toggle -->
        <div class="navbar-header pull-left">
            <a class="navbar-brand" href="<?php echo Yii::app()->createAbsoluteUrl('/');?>">
                <small>
                    <i class="fa fa-desktop"></i>
                    <?php echo CHtml::encode(Yii::app()->name); ?>
                </small>
            </a>
        </div>

        <!-- #section:basics/navbar.dropdown -->
        <div role="navigation" class="navbar-buttons navbar-header pull-right">
            <ul class="nav ace-nav">
                <!-- #section:basics/navbar.user_menu -->
                <li class="light-blue">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo Yii::app()->user->name;?>
								</span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('site/logout')?>">
                                <i class="ace-icon fa fa-power-off"></i>
                                退出
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- /section:basics/navbar.user_menu -->
            </ul>
        </div>

        <!-- /section:basics/navbar.dropdown -->
    </div>
    <!-- /.navbar-container -->
</div>