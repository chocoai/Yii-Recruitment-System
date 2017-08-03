<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->breadcrumbs = array(
    YII::t('ping', $this->getModule()->id) => array('index'),
    YII::t('ping', $this->getId()) => array('index'),
    YII::t('ping', $this->getAction()->id)
);
?>

<div class="row">
    <div class="col-sm-12 col-xs-12">
        <p>
            <?php if(Yii::app()->user->checkAccess("Interview.Offer.Update")):?>
                <?php echo CHtml::link('<i class="ace-icon fa fa-pencil-square-o bigger-110"></i> 修改',Yii::app()->createUrl('interview/offer/update',array('id'=>$model->id)),array('class' => 'btn btn-info'));?>
            <?php endif;?>
        </p>
    </div>
</div>
<?php $this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'htmlOptions' => array('class' => 'table table-striped table-bordered'),
    'attributes' => array(
        'id',
        'recruiter',
        'invitation',
        'name',
        'phone',
        'email',
        'graduateInstitutions',
        'education',
        'graduationTime',
        'experience',
        'famousExperience',
        'channel',
        'jobCandidates',
        'product',
        'solicitationRecord',
        'interviewDate',
        'interviewTime',
        'isInterview',
        'interviewer',
        'skill',
        'interviewEvaluation',
        'interviewResults',
        'isAccept',
        'entryDate',
        'isEntry',
        'confirmationDate',
        'isConfirmation',
        'departureDate',
        'beforeSalary',
        'salary',
        'remark',
        'modifeTime'
    ),
)); ?>
