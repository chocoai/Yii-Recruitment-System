<div class="sidebar                  responsive" id="sidebar">
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'fixed')
        } catch (e) {
        }
    </script>

    <!-- /.sidebar-shortcuts -->

    <div style="position: relative;">
        <div class="nav-wrap" style="">
            <div style="position: relative; top: 0px; transition-property: top; transition-duration: 0.2s;">

                <?php $this->widget('zii.widgets.CMenu', array(
                    'activeCssClass' => 'active',
                    'activateParents' => true,
                    'encodeLabel' => false,
                    'htmlOptions' => array('class' => 'nav nav-list'),
                    'items' => array(
                        array('label' => '<i class="menu-icon fa fa-tachometer"></i><span class="menu-text">'.Yii::t('ping','dashboard').'</span>', 'url' => array('/index/index'),'visible'=>Yii::app()->user->checkAccess("Index.Index")),

                        array('label' => '<i class="menu-icon fa fa-users"></i><span class="menu-text">'.Yii::t('ping','interview').'</span><b class="arrow fa fa-angle-down"></b>', 'linkOptions' => array('class' => 'dropdown-toggle'), 'url' => array('#'), 'submenuOptions' => array('class' => 'submenu nav-show'),'visible'=>Yii::app()->user->checkAccess("Interview.Feedback.*"),
                            'items' => array(
                                array('label' => Yii::t('ping','feedback'), 'url' => array('/interview/feedback/index'),'active'=>Yii::app()->controller->id=='feedback','visible'=>Yii::app()->user->checkAccess("Interview.Feedback.Index")),
                                array('label' => Yii::t('ping','offer'), 'url' => array('/interview/offer/index'),'active'=>Yii::app()->controller->id=='offer','visible'=>Yii::app()->user->checkAccess("Interview.Offer.Index")),
                            )
                        ),
                        array('label' => '<i class="menu-icon fa fa-key"></i><span class="menu-text"> RBAC授权管理 </span><b class="arrow fa fa-angle-down"></b>', 'linkOptions' => array('class' => 'dropdown-toggle'), 'url' => array('#'), 'submenuOptions' => array('class' => 'submenu nav-show'),'visible'=>Yii::app()->user->name=='admin',
                            'items' => array(
                                array('label' => '授权', 'url' => array('/rights/assignment/view'),'active' => (isset($this->module->id) && $this->module->id == 'rights' && Yii::app()->controller->id=='assignment')),
                                array('label' => '权限', 'url' => array('/rights/authItem/permissions'),'active' => (in_array(Yii::app()->controller->route,array('rights/authItem/permissions','rights/authItem/generate')))),
                                array('label' => '角色', 'url' => array('/rights/authItem/roles'),'active' => (in_array(Yii::app()->controller->route,array('rights/authItem/roles','rights/authItem/createrole','rights/authItem/updaterole')))),
                                array('label' => '任务', 'url' => array('/rights/authItem/tasks'),'active' => (in_array(Yii::app()->controller->route,array('rights/authItem/tasks','rights/authItem/createtask','rights/authItem/updatetask')))),
                                array('label' => '操作', 'url' => array('/rights/authItem/operations'),'active' => (in_array(Yii::app()->controller->route,array('rights/authItem/operations','rights/authItem/createoperation','rights/authItem/updateoperation')))),
                            )
                        ),
                        array('label' => '<i class="menu-icon fa fa-cogs"></i><span class="menu-text"> '.Yii::t('ping','setting').' </span><b class="arrow fa fa-angle-down"></b>', 'linkOptions' => array('class' => 'dropdown-toggle'), 'url' => array('#'), 'submenuOptions' => array('class' => 'submenu nav-show'),'visible'=>Yii::app()->user->checkAccess("Setting.Systemuser.*"),
                            'items' => array(
                                array('label' => Yii::t('ping','systemuser'), 'url' => array('/setting/systemuser/index'),'visible'=>Yii::app()->user->checkAccess("Setting.Systemuser.Index"),'active'=>Yii::app()->controller->id=='systemuser'),
                            )
                        ),

                    ),
                ));
                ?>
            </div>
        </div>
        <div class="ace-scroll nav-scroll">
            <div class="scroll-track" style="display: none; height: 345px;">
                <div class="scroll-bar"
                     style="transition-property: top; transition-duration: 0.13s; height: 298px; top: 0px;"></div>
            </div>
            <div class="scroll-content" style="">
                <div style=""></div>
            </div>
        </div>
    </div>
    <!-- /.nav-list -->

    <!-- #section:basics/sidebar.layout.minimize -->
    <div id="sidebar-collapse" class="sidebar-toggle sidebar-collapse" style="z-index: 1;">
        <i data-icon2="ace-icon fa fa-angle-double-right" data-icon1="ace-icon fa fa-angle-double-left"
           class="ace-icon fa fa-angle-double-left"></i>
    </div>

    <!-- /section:basics/sidebar.layout.minimize -->
    <script type="text/javascript">
        try {
            ace.settings.check('sidebar', 'collapsed')
        } catch (e) {
        }
    </script>
</div>