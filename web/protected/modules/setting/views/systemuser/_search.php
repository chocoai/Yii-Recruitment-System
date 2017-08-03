<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-div #search-form').submit(function(){
	$.fn.yiiGridView.update('systemuser-grid', {
   			url:'".Yii::app()->createUrl($this->route)."',
			data: $(this).serialize(),
			type: 'get'
		});
	return false;
});
");
?>

<?php $form = $this->beginWidget('CActiveForm', array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'GET',
    'htmlOptions' => array('class' => 'form-horizontal', 'id' => 'search-form'),
)); ?>

<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->label($model, 'username', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
            <div class="col-sm-9">
                <?php echo $form->textField($model, 'username', array('class' => 'col-sm-12 col-xs-12')); ?>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->label($model, 'realname', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
            <div class="col-sm-9">
                <?php echo $form->textField($model, 'realname', array('class' => 'col-sm-12 col-xs-12')); ?>
            </div>
        </div>
    </div>

</div>


<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">
                <?php echo CHtml::htmlButton('<i class="ace-icon fa fa-search bigger-110"></i>搜索', array('class' => 'btn btn-info', 'type' => 'submit')); ?>&nbsp;&nbsp;
                <?php echo CHtml::htmlButton('<i class="ace-icon fa fa-undo bigger-110"></i>重置', array('class' => 'btn', 'type' => 'reset')); ?>&nbsp;&nbsp;

                <?php if(Yii::app()->user->checkAccess("Setting.Systemuser.Create")):?>
                    <?php echo CHtml::link('<i class="ace-icon fa fa-pencil bigger-110"></i> 添加',Yii::app()->createUrl('setting/systemuser/create'),array('class' => 'btn btn-success'));?>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<!-- search-form -->



