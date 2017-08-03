<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
)); ?>
<label class="block clearfix">
    <span class="block input-icon input-icon-right">
        <?php echo $form->textField($model, 'username', array('placeholder' => "用户名", 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'username'); ?>
        <i class="ace-icon fa fa-user"></i>
    </span>
</label>
<label class="block clearfix">
    <span class="block input-icon input-icon-right">
        <?php echo $form->passwordField($model, 'password', array('placeholder' => "密码", 'class' => 'form-control')); ?>
        <?php echo $form->error($model, 'password'); ?>
        <i class="ace-icon fa fa-lock"></i>
    </span>
</label>
<div class="space"></div>
<div class="clearfix">
    <label class="inline">
        <?php echo $form->checkBox($model, 'rememberMe'); ?><span class="lbl"> 记住我</span>
    </label>
    <button class="width-35 pull-right btn btn-sm btn-primary"><i class="icon-key"></i> 登录
    </button>
</div>
<?php $this->endWidget(); ?>
