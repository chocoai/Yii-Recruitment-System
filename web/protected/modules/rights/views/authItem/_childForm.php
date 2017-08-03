<div class="form">

    <?php $form = $this->beginWidget('CActiveForm'); ?>

    <div class="row">
        <div class="col-sm-12 col-xs-12 form-group">
            <?php echo $form->dropDownList($model, 'itemname', $itemnameSelectOptions); ?>
            <?php echo $form->error($model, 'itemname'); ?>
        </div>
    </div>

    <div class="row buttons">
        <div class="col-sm-12 col-xs-12">
            <?php echo CHtml::submitButton(Rights::t('core', 'Add'), array('class' => 'btn btn-info')); ?>
        </div>
    </div>

    <?php $this->endWidget(); ?>

</div>