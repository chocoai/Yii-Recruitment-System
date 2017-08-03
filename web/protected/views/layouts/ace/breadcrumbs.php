<div id="breadcrumbs" class="breadcrumbs">
    <script type="text/javascript">
        try {
            ace.settings.check('breadcrumbs', 'fixed')
        } catch (e) {
        }
    </script>
    <!-- breadcrumb -->
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
            'links'=>$this->breadcrumbs,
            'htmlOptions'=>array('class'=>'breadcrumb'),
            'homeLink'=>CHtml::link('<i class="ace-icon fa fa-home home-icon"></i>首页',Yii::app()->baseUrl)
        )); ?>
    <?php endif?>
    <!-- /.breadcrumb -->
</div>