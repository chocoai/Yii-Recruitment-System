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
                'dataProvider' => $model->offerSearch(),
                'columns' => array(
                    'id',
                    'recruiter',
                    array(
                        'name' => 'name',
                        'value' => 'CHtml::link($data->name,Yii::app()->createUrl("interview/offer/view",array("id"=>$data->id)))',
                        'type' => 'raw',
                        'htmlOptions' => array('style' => 'width:60px')
                    ),
                    'phone',
                    'email',
                    'education',
                    'experience',
                    'channel',
                    'jobCandidates',
                    'interviewDate',
                    'entryDate',
                    'departureDate',
                    array(
                        'header' => '操作',
                        'class' => 'CButtonColumn',
                        'htmlOptions' => array('class' => 'action-buttons'),
                        'template' => '{entry} {noentry} {update} {delete} {preview}',
                        'buttons' => array(
                            'entry' => array(
                                'label' => '<i class="ace-icon fa fa-flag bigger-130"></i>',
                                'url' => 'Yii::app()->createUrl("interview/offer/entry",array("id"=>$data->id))',
                                'imageUrl' => false,
                                'options' => array('title' => '已经入职', 'class' => 'grey ajax-link', 'style' => 'margin:2px;', 'data-original-title' => '已经入职'),
                                'visible' => 'Yii::app()->user->checkAccess("Interview.Offer.Entry") && ($data->isEntry=="否" || empty($data->isEntry))',
                            ),
                            'noentry' => array(
                                'label' => '<i class="ace-icon fa fa-flag bigger-130"></i>',
                                'url' => 'Yii::app()->createUrl("interview/offer/entry",array("id"=>$data->id))',
                                'imageUrl' => false,
                                'options' => array('title' => '取消入职', 'class' => 'ajax-link', 'style' => 'margin:2px;', 'data-original-title' => '取消入职'),
                                'visible' => 'Yii::app()->user->checkAccess("Interview.Offer.Entry") && $data->isEntry=="是"',
                            ),
                            'update' => array(
                                'label' => '<i class="ace-icon fa fa-pencil bigger-130"></i>',
                                'url' => 'Yii::app()->createUrl("interview/offer/update",array("id"=>$data->id))',
                                'imageUrl' => false,
                                'options' => array('title' => '编辑', 'class' => 'green', 'style' => 'margin:2px;', 'data-original-title' => '编辑'),
                                'visible' => 'Yii::app()->user->checkAccess("Interview.Offer.Update")',
                            ),
                            'delete' => array(
                                'label' => '<i class="ace-icon fa fa-trash-o bigger-130"></i>',
                                'url' => 'Yii::app()->createUrl("interview/offer/delete",array("id"=>$data->id))',
                                'imageUrl' => false,
                                'options' => array('title' => '删除', 'class' => 'red', 'style' => 'margin:2px;', 'data-original-title' => '删除'),
                                'visible' => 'Yii::app()->user->checkAccess("Interview.Offer.Delete")',
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

