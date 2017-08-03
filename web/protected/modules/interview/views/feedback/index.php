<?php
$this->breadcrumbs = array(
    YII::t('ping', $this->getModule()->name) => array('index'),
    YII::t('ping', $this->getId()),
);
?>
    <div class="search-div">
        <?php $this->renderPartial('_search', array(
            'model' => $model,
        )); ?>
    </div>

    <!-- 列表 -->
    <div class="row">
        <div class="col-xs-12">
            <?php $this->widget('zii.widgets.grid.CGridView', CMap::mergeArray(Yii::app()->params['CGridView'], array(
                    'id' => 'feedback-grid',
                    'dataProvider' => $model->search(),
                    'columns' => array(
                        'id',
                        'recruiter',
                        'invitation',
                        array(
                            'name' => 'name',
                            'value' => 'CHtml::link($data->name,Yii::app()->createUrl("interview/feedback/view",array("id"=>$data->id)))',
                            'type' => 'raw',
                            'htmlOptions' => array('style' => 'width:60px')
                        ),
                        'phone',
                        'email',
                        'graduateInstitutions',
                        'major',
                        'education',
                        'experience',
                        'channel',
                        'jobCandidates',
                        'interviewDate',
                        array(
                            'name' => 'interviewTime',
                            'value' => '!empty($data->interviewTime)?date("H:i",strtotime($data->interviewTime)):""'
                        ),
                        array(
                            'header' => '操作',
                            'class' => 'CButtonColumn',
                            'htmlOptions' => array('class' => 'action-buttons'),
                            'template' => '{via} {novia} {update} {delete} {preview}',
                            'buttons' => array(
                                'via' => array(
                                    'label' => '<i class="ace-icon fa fa-flag bigger-130"></i>',
                                    'url' => 'Yii::app()->createUrl("interview/feedback/via",array("id"=>$data->id))',
                                    'imageUrl' => false,
                                    'options' => array('title' => '参加面试', 'class' => 'grey ajax-link', 'style' => 'margin:2px;', 'data-original-title' => '参加面试'),
                                    'visible' => 'Yii::app()->user->checkAccess("Interview.Feedback.Via") && ($data->isInterview=="否" || empty($data->isInterview))',
                                ),
                                'novia' => array(
                                    'label' => '<i class="ace-icon fa fa-flag bigger-130"></i>',
                                    'url' => 'Yii::app()->createUrl("interview/feedback/via",array("id"=>$data->id))',
                                    'imageUrl' => false,
                                    'options' => array('title' => '取消参加面试', 'class' => 'blue ajax-link', 'style' => 'margin:2px;', 'data-original-title' => '取消参加面试'),
                                    'visible' => 'Yii::app()->user->checkAccess("Interview.Feedback.Via") && $data->isInterview=="是"',
                                ),
                                'update' => array(
                                    'label' => '<i class="ace-icon fa fa-pencil bigger-130"></i>',
                                    'url' => 'Yii::app()->createUrl("interview/feedback/update",array("id"=>$data->id))',
                                    'imageUrl' => false,
                                    'options' => array('title' => '编辑', 'class' => 'green', 'style' => 'margin:2px;', 'data-original-title' => '编辑'),
                                    'visible' => 'Yii::app()->user->checkAccess("Interview.Feedback.Update")',
                                ),
                                'delete' => array(
                                    'label' => '<i class="ace-icon fa fa-trash-o bigger-130"></i>',
                                    'url' => 'Yii::app()->createUrl("interview/feedback/delete",array("id"=>$data->id))',
                                    'imageUrl' => false,
                                    'options' => array('title' => '删除', 'class' => 'red', 'style' => 'margin:2px;', 'data-original-title' => '删除'),
                                    'visible' => 'Yii::app()->user->checkAccess("Interview.Feedback.Delete")',
                                ),
                                'preview' => array(
                                    'label' => '<i class="ace-icon fa fa-eye bigger-130"></i>',
                                    'url' => 'Yii::app()->createUrl("interview/feedback/preview",array("id"=>$data->id))',
                                    'imageUrl' => false,
                                    'options' => array('title' => '预览简历', 'class' => 'blue', 'style' => 'margin:2px;', 'data-original-title' => '预览简历', 'target' => '_blank'),
                                    'visible' => 'Yii::app()->user->checkAccess("Interview.Feedback.Preview") && ($data->resume <> "" || $data->resume <> null)',
                                ),
                            )
                        )
                    ))
            )); ?>
        </div>
    </div>

<?php $this->renderPartial('//layouts/ace/_upload'); ?>