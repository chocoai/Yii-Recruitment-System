<?php
/* @var $this FeedbackController */
/* @var $model Feedback */

$this->breadcrumbs = array(
    YII::t('ping', $this->getModule()->id) => array('index'),
    YII::t('ping', $this->getId())=> array('index'),
    YII::t('ping', $this->getAction()->id)
);
?>
<?php $this->renderPartial('_form', array('model' => $model)); ?>