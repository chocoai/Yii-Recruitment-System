<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$(this).text($('.search-more').is(':hidden') ? '收起更多':'展开更多');
	$('.search-more').toggle();
	return false;
});
$('.search-div #search-form').submit(function(){
	$.fn.yiiGridView.update('feedback-grid', {
   			url:'" . Yii::app()->createUrl($this->route) . "',
			data: $(this).serialize(),
			type: 'get'
		});
	return false;
});
$('#export').click(function(){
    var url = '" . Yii::app()->createUrl('interview/feedback/export') . "' + window.location.search;
    location.href = url;
    return false;
});

localsystem.range_picker();

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
            <?php echo $form->label($model, 'recruiter', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
            <div class="col-sm-9">
                <?php echo $form->textField($model, 'recruiter', array('class' => 'col-sm-12 col-xs-12')); ?>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->label($model, 'invitation', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                    <?php echo $form->textField($model, 'invitation', array('class' => 'col-sm-12 col-xs-12 range-picker', 'autocomplete' => 'off', 'readonly' => true)); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->label($model, 'interviewDate', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
            <div class="col-sm-9">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                    <?php echo $form->textField($model, 'interviewDate', array('class' => 'col-sm-12 col-xs-12 range-picker', 'autocomplete' => 'off', 'readonly' => true)); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->label($model, 'jobCandidates', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
            <div class="col-sm-9">
                <?php echo $form->textField($model, 'jobCandidates', array('class' => 'col-sm-12 col-xs-12')); ?>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <?php echo $form->label($model, 'channel', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
            <div class="col-sm-9">
                <?php $this->widget('CAutoComplete', array(
                    'model'=>$model,
                    'attribute'=>'channel',
                    'url'=>array('suggestChannel'),
                    'multiple'=>true,
                    'multipleSeparator'=>' ',
                    'htmlOptions'=>array('size'=>65,'class' => 'col-sm-12 col-xs-12'),
                )); ?>
            </div>
        </div>
    </div>
</div>

<div class="row search-more" style="display: none">
    <div class="col-sm-12 col-xs-12">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->label($model, 'name', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'name', array('class' => 'col-sm-12 col-xs-12')); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->label($model, 'phone', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'phone', array('class' => 'col-sm-12 col-xs-12')); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->label($model, 'email', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'email', array('class' => 'col-sm-12 col-xs-12')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->label($model, 'isInterview', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->dropDownList($model, 'isInterview', $model->_if, array('class' => 'col-sm-12 col-xs-12', 'prompt' => '请选择')); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->label($model, 'interviewResults', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->dropDownList($model, 'interviewResults', $model->_interviewResults, array('class' => 'col-sm-12 col-xs-12', 'prompt' => '请选择')); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="col-md-offset-1">
            <?php echo CHtml::link('展开更多', '#', array('class' => 'search-button')); ?>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-xs-12">
        <div class="clearfix form-actions">
            <div class="col-md-offset-3 col-md-9">

                <?php echo CHtml::htmlButton('<i class="ace-icon fa fa-search bigger-110"></i>搜索', array('class' => 'btn btn-info', 'type' => 'submit')); ?>&nbsp;&nbsp;
                <?php echo CHtml::htmlButton('<i class="ace-icon fa fa-undo bigger-110 "></i>重置', array('class' => 'btn clear-form')); ?>&nbsp;&nbsp;

                <?php if (Yii::app()->user->checkAccess("Interview.Feedback.Create")): ?>
                    <?php echo CHtml::link('<i class="ace-icon fa fa-pencil bigger-110"></i> 添加', Yii::app()->createUrl('interview/feedback/create'), array('class' => 'btn btn-success')); ?>&nbsp;&nbsp;
                <?php endif; ?>

                <?php if (Yii::app()->user->checkAccess("Interview.Feedback.Import")): ?>
                    <?php echo CHtml::link('<i class="ace-icon fa fa-cloud-upload bigger-110"></i> 导入', '#import-modal', array('class' => 'btn btn-primary', 'data-toggle' => 'modal')); ?>&nbsp;&nbsp;
                <?php endif; ?>

                <?php if (Yii::app()->user->checkAccess("Interview.Feedback.Export")): ?>
                    <?php echo CHtml::link('<i class="ace-icon fa fa-cloud-download bigger-110"></i> 导出', 'javascript:void();', array('class' => 'btn btn-primary', 'id' => 'export')); ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>
<!-- search-form -->



