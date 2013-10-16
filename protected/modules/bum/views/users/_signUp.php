<?php
/**
 * Sign Up form; partial view.
 *
 * @copyright	Copyright &copy; 2012 Hardalau Claudiu
 * @package		bum
 * @license		New BSD License
 */

/* @var $this UsersController */
/* @var $model Users */
/* @var $form CActiveForm */
?>

<div class="form">

<?php /*$form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-singUp-form',
	'enableAjaxValidation'=>false,
)); */?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'users-singUp-form',
    'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php
    // if site is not invitation based, then do not display invitation code errors... :)
    if(Yii::app()->getModule('bum')->invitationBasedSignUp):
        echo $form->errorSummary(array($model, $model->invitations));
    else:
        echo $form->errorSummary(array($model));
    endif;

    ?><fieldset>
        <legend>Username and password:</legend>
            <?php if($model->isNewRecord): ?>
                <?php echo $form->textFieldRow($model,'user_name',array('size'=>45,'maxlength'=>45)); ?>
            <?php else: ?>
                <?php echo $form->textFieldRow($model,'user_name',array('size'=>45,'maxlength'=>45, 'readonly'=>'readonly', 'disabled'=>true)); ?>
            <?php endif; ?>

            <?php echo $form->passwordFieldRow($model,'password',array('size'=>45,'maxlength'=>150)); ?>

            <?php echo $form->passwordFieldRow($model,'password_repeat',array('size'=>45,'maxlength'=>150)); ?>
    </fieldset>

    <fieldset>
        <legend>Email address is required in order to activate your account:</legend>
            <?php echo $form->textFieldRow($model,'email',array('size'=>60,'maxlength'=>60)); ?>
    </fieldset>

    <fieldset>
        <legend>Are you human?</legend>
        <?php if(CCaptcha::checkRequirements()): ?>
            <div><?php $this->widget('CCaptcha'); ?></div>
            <?php echo $form->textFieldRow($model,'verifyCode'); ?>
            <div class="hint">Please enter the letters as they are shown in the image above.
            <br/>Letters are not case-sensitive.</div>
        <?php endif; ?>
    </fieldset>

    <?php if(Yii::app()->getModule('bum')->invitationBasedSignUp): ?>
        <fieldset>
            <legend>Invitation code?</legend>
            <?php echo $form->textFieldRow($model->invitations,'invitation_code',array('size'=>10,'maxlength'=>10)); ?>
        </fieldset>
    <?php else:
            // if site is not invitation based, then do not display invitation_code field... :)
            echo $form->hiddenField($model->invitations,'invitation_code');
    endif; ?>

	<div class="form-actions">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Register' : 'Save', array('class' => 'btn btn-primary')); ?>
        <div class="pull-right">
            <?php echo CHtml::link('Resend Confirmation Email', array('users/resendSignUpConfirmationEmail'), array('class' => 'btn')); ?>
        </div>
	</div>



<?php $this->endWidget(); ?>

</div><!-- form -->