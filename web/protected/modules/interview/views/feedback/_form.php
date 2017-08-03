<?php
Yii::app()->clientScript->registerScript('form', "
    localsystem.picker();
    localsystem.timepicker();

    $('#id-input-file-2').ace_file_input({
		no_file:'选择文件 ...',
		btn_choose:'选择',
	    btn_change:'修改',
		droppable:false,
		onchange:null,
		thumbnail:false,
		allowExt: ['html','doc','docx','pdf'],
    });
    $('#id-input-file-2').on('file.error.ace', function (ev, info) {
        if (info.error_count['ext'] || info.error_count['mime']) bootbox.alert('无效的文件类型!请选择\'html\',\'doc\',\'docx\',\'pdf\'文件!');
    });
");
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'feedback-form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
        'htmlOptions' => array('enctype' => 'multipart/form-data')
    )); ?>

    <p class="note">带 <span class="required">*</span> 为必填.</p>

    <div class="form-horizontal">

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'recruiter', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'recruiter', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'recruiter'); ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'invitation', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <?php echo $form->textField($model, 'invitation', array('class' => 'col-xs-12 col-sm-12 date-picker', 'data-date-format' => 'yyyy-mm-dd')); ?>
                            <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                        </div>
                        <?php echo $form->error($model, 'invitation'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'name', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'name', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'name'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'phone', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'phone', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'phone'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'email', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'email', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'graduateInstitutions', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'graduateInstitutions', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'graduateInstitutions'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'major', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'major', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'major'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'education', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->dropDownList($model, 'education', $model->_education, array('class' => 'col-xs-12 col-sm-12', 'prompt' => '请选择')); ?>
                        <?php echo $form->error($model, 'education'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'graduationTime', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'graduationTime', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'graduationTime'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'experience', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'experience', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'experience'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'famousExperience', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->dropDownList($model, 'famousExperience', $model->_if, array('class' => 'col-xs-12 col-sm-12', 'prompt' => '请选择')); ?>
                        <?php echo $form->error($model, 'famousExperience'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'channel', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'channel', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'channel'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'jobCandidates', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'jobCandidates', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'jobCandidates'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'solicitationRecord', array('class' => 'col-sm-1 control-label no-padding-right')); ?>
                    <div class="col-sm-11">
                        <?php echo $form->textArea($model, 'solicitationRecord', array('class' => 'col-xs-12 col-sm-12', 'rows' => 3)); ?>
                        <?php echo $form->error($model, 'solicitationRecord'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'isInterview', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->dropDownList($model, 'isInterview', $model->_if, array('class' => 'col-xs-12 col-sm-12', 'prompt' => '请选择')); ?>
                        <?php echo $form->error($model, 'isInterview'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'interviewDate', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <?php echo $form->textField($model, 'interviewDate', array('class' => 'col-xs-12 col-sm-12 date-picker', 'data-date-format' => 'yyyy-mm-dd')); ?>
                            <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                        </div>
                        <?php echo $form->error($model, 'interviewDate'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'interviewTime', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <div class="input-group bootstrap-timepicker">
                            <?php echo $form->textField($model, 'interviewTime', array('class' => 'col-xs-12 col-sm-12 data-timepicker')); ?>
                            <span class="input-group-addon"><i class="fa fa-clock-o bigger-110"></i></span>
                        </div>
                        <?php echo $form->error($model, 'interviewTime'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'interviewer', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'interviewer', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'interviewer'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'interviewResults', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->dropDownList($model, 'interviewResults', $model->_interviewResults, array('class' => 'col-xs-12 col-sm-12', 'prompt' => '请选择')); ?>
                        <?php echo $form->error($model, 'interviewResults'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'skill', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'skill', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'skill'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'interviewEvaluation', array('class' => 'col-sm-1 control-label no-padding-right')); ?>
                    <div class="col-sm-11">
                        <?php echo $form->textArea($model, 'interviewEvaluation', array('class' => 'col-xs-12 col-sm-12', 'rows' => 3)); ?>
                        <?php echo $form->error($model, 'interviewEvaluation'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'isAccept', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->dropDownList($model, 'isAccept', $model->_if, array('class' => 'col-xs-12 col-sm-12', 'prompt' => '请选择')); ?>
                        <?php echo $form->error($model, 'isAccept'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'isEntry', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->dropDownList($model, 'isEntry', $model->_if, array('class' => 'col-xs-12 col-sm-12', 'prompt' => '请选择')); ?>
                        <?php echo $form->error($model, 'isEntry'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'entryDate', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <?php echo $form->textField($model, 'entryDate', array('class' => 'col-xs-12 col-sm-12 date-picker', 'data-date-format' => 'yyyy-mm-dd')); ?>
                            <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                        </div>
                        <?php echo $form->error($model, 'entryDate'); ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'isConfirmation', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->dropDownList($model, 'isConfirmation', $model->_if, array('class' => 'col-xs-12 col-sm-12', 'prompt' => '请选择')); ?>
                        <?php echo $form->error($model, 'isConfirmation'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'confirmationDate', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <?php echo $form->textField($model, 'confirmationDate', array('class' => 'col-xs-12 col-sm-12 date-picker', 'data-date-format' => 'yyyy-mm-dd')); ?>
                            <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                        </div>
                        <?php echo $form->error($model, 'confirmationDate'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'departureDate', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <?php echo $form->textField($model, 'departureDate', array('class' => 'col-xs-12 col-sm-12 date-picker', 'data-date-format' => 'yyyy-mm-dd')); ?>
                            <span class="input-group-addon"><i class="fa fa-calendar bigger-110"></i></span>
                        </div>
                        <?php echo $form->error($model, 'departureDate'); ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'beforeSalary', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'beforeSalary', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'beforeSalary'); ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'salary', array('class' => 'col-sm-3 control-label no-padding-right')); ?>
                    <div class="col-sm-9">
                        <?php echo $form->textField($model, 'salary', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'salary'); ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-xs-12 col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'remark', array('class' => 'col-sm-1 control-label no-padding-right')); ?>
                    <div class="col-sm-11">
                        <?php echo $form->textArea($model, 'remark', array('class' => 'col-xs-12 col-sm-12', 'rows' => 3)); ?>
                        <?php echo $form->error($model, 'remark'); ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12">

                <div class="form-group">
                    <label for="Feedback_remark" class="col-sm-1  control-label  no-padding-right">简历</label>
                    <div class="col-sm-11">
                        <label class="ace-file-input"><input type="file" id="id-input-file-2" name="file"></label>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="clearfix form-actions">
        <div class="col-md-offset-3 col-md-9">
            <?php echo CHtml::htmlButton('<i class="ace-icon fa fa-floppy-o bigger-110"></i>保存', array('class' => 'btn btn-info', 'type' => 'submit')); ?>
            &nbsp;&nbsp;
            <?php echo CHtml::htmlButton('<i class="ace-icon fa fa-undo bigger-110"></i>重置', array('class' => 'btn', 'type' => 'reset')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->