<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);

Yii::app()->clientScript->registerScript('focus_on_username', "
    $('#LoginForm_username').focus();
", CClientScript::POS_READY);

?>

<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
    'type'=>'vertical',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <?php echo CHtml::label('Email or User Name', 'LoginForm_username'); ?>
    <?php echo $form->textField($model,'username'); ?>
    <?php echo $form->error($model,'username'); ?>

    <?php echo CHtml::label('Password', 'LoginForm_password'); ?>
    <?php echo $form->passwordField($model,'password'); ?>
    <?php echo $form->error($model,'password'); ?>

	<?php echo $form->checkBoxRow($model,'rememberMe'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Login',
        )); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

<DIV class="message note">Forgot your password? Click <?php echo CHtml::link('here',array('users/passwordRecoveryWhatUser')); ?> to reset your password.</DIV><?php

if ($this->module->install) {
    ?><DIV class="message note">Or go to the install page; click <?php echo CHtml::link('here',array('install/index')); ?>.</DIV><?php
}
