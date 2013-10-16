<?php
/**
 * Send invitations; partial view.
 *
 * @copyright	Copyright &copy; 2012 Hardalau Claudiu
 * @package		bum
 * @license		New BSD License
 *
 * This form file is used to send invitations to friends.
 */

/* @var $this InvitationsController */
/* @var $model Invitations */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'invitations-form',
	'enableAjaxValidation'=>true,
    'htmlOptions'=>array('onSubmit'=>'return false;'), // deactivate the default submit action
    'enableClientValidation'=>true,
)); ?>
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<fieldset>

        <?php echo $form->hiddenField($model, 'id_user'); ?>

        <?php echo $form->textFieldRow($model,'email',array('class' => 'span4', 'size'=>60,'maxlength'=>60)); ?>

        <?php echo $form->textAreaRow($model,'note',array('class' => 'span4', 'rows'=>6)); ?>

	</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->