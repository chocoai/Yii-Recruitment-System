<?php
/* @var $this DefaultController */

$this->breadcrumbs = array(
    YII::t('ping', $this->getModule()->name) => array('index'),
    YII::t('ping', $this->getId()),
);
?>

<div class="row">
    <div class="col-xs-12">
        <div class="search-div">
            <?php $this->renderPartial('_search', array(
                'model' => $model,
            )); ?>
        </div>

        <!-- 列表 -->
        <div class="row">
            <div class="col-xs-12">
                <?php $this->widget('zii.widgets.grid.CGridView', CMap::mergeArray(Yii::app()->params['CGridView'], array(
                        'id' => 'systemuser-grid',
                        'dataProvider' => $model->search(),
                        'columns' => array(
                            'id',
                            'username',
                            'realname',
                            'modifeTime',
                            array(
                                'header' => '操作',
                                'class' => 'CButtonColumn',
                                'template' => '{update} {delete}',
                                'buttons' => array(
                                    'update' => array(
                                        'label' => '<i class="ace-icon fa fa-pencil bigger-130"></i>',
                                        'url' => 'Yii::app()->createUrl("setting/systemuser/update",array("id"=>$data->id))',
                                        'imageUrl' => false,
                                        'options' => array('title' => '编辑', 'class' => 'green', 'style' => 'margin:2px;', 'data-original-title' => '编辑'),
                                        'visible' => 'Yii::app()->user->checkAccess("Setting.Systemuser.Update") && $data->id<>1',
                                    ),
                                    'delete' => array(
                                        'label' => '<i class="ace-icon fa fa-trash-o bigger-130"></i>',
                                        'url' => 'Yii::app()->createUrl("setting/systemuser/delete",array("id"=>$data->id))',
                                        'imageUrl' => false,
                                        'options' => array('title' => '删除', 'class' => 'red', 'style' => 'margin:2px;', 'data-original-title' => '删除'),
                                        'visible' => 'Yii::app()->user->checkAccess("Setting.Systemuser.Delete") && $data->id<>1',
                                    ),
                                )
                            ),
                        ))
                )); ?>
            </div>
        </div>
    </div>
</div>
