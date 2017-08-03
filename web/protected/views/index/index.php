<?php
$this->breadcrumbs = array(
    YII::t('ping', 'dashboard'),
);
?>
<div class="jumbotron center">
    <h1><?php echo CHtml::encode(Yii::app()->name); ?></h1>
    <p class="lead">欢迎使用<?php echo CHtml::encode(Yii::app()->name); ?>
        <small>(<?php echo CHtml::encode(Yii::app()->params['version']) ?>)</small>,综合的企业简历管理系统和人事管理平台</p>
    <p><a href="#" class="btn btn-lg btn-success"><?php echo CHtml::encode(Yii::app()->params['version']) ?></a></p>
</div>

<div class="body-content">
    <div class="row">
        <div class="col-lg-4">
            <h2>基于云的综合简历管理系统</h2>
            <p>聘Cloud是个基于云的在线简历管理解决方案。基于Software as a Servcie（SaaS）的理念， 我们提供从人力资源需求预测到企业招聘管理等多种解决方案。</p>
        </div>
        <div class="col-lg-4">
            <h2>集中记录和保存信息</h2>
            <p>提供一个集中的数据库保存企业所有与人才管理和招聘管理的信息，所有人都可以获取到全面的、最新的、同步的HR资料，从而避免信息碎片和过时数据; </p>
        </div>
        <div class="col-lg-4">
            <h2>定制人才计划，建设人才库</h2>
            <p>提前制定企业人才计划，针对企业关键岗位建设人才储备库，平时积累岗位候选人资源，改变被动接受求职者投简历的招聘方式，进行主动招聘。</p>
        </div>
    </div>

</div>

