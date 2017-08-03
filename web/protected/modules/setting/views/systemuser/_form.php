<?php
/* @var $this FeedbackController */
/* @var $model Feedback */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
        'id' => 'systemuser-form',
        'enableAjaxValidation' => true,
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>

    <p class="note">带 <span class="required">*</span> 为必填.</p>

    <div class="form-horizontal">

        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'username', array('class' => 'col-sm-1 control-label no-padding-right')); ?>
                    <div class="col-sm-11">
                        <?php echo $form->textField($model, 'username', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'username'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'password', array('class' => 'col-sm-1 control-label no-padding-right')); ?>
                    <div class="col-sm-11">
                        <?php echo $form->passwordField($model, 'password', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <?php echo $form->labelEx($model, 'realname', array('class' => 'col-sm-1 control-label no-padding-right')); ?>
                    <div class="col-sm-11">
                        <?php echo $form->textField($model, 'realname', array('class' => 'col-xs-12 col-sm-12')); ?>
                        <?php echo $form->error($model, 'realname'); ?>
                    </div>
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