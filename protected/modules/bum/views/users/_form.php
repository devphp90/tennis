<?php
/**
 * Create a new user; partial view.
 *
 * @copyright	Copyright &copy; 2012 Hardalau Claudiu
 * @package		bum
 * @license		New BSD License
 *
 * This form file is used for several scenario cases, like: create (a new user by the admin), signUp, update.
 */
/* @var $this UsersController */
/* @var $model Users */
/* @var $modelUsersData modelUsersData */
/* @var myEmails $myEmails CActiveDataProvider('Emails', ... ) */
/* @var hasUnverifiedEmails $hasUnverifiedEmails = true if user has unverified emails or false otherwise */
/* @var $form CActiveForm */
?><div class="form"><?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'users-form',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    ));
?><p class="note">Fields with <span class="required">*</span> are required.</p><?php
echo $form->errorSummary(array($model, $modelUsersData));
?><fieldset>
        <legend>Username and Email:</legend>
    <?php
    if ($model->scenario == 'create' || $model->scenario == 'signUp'):
        // only allow this field to be edited if it's in create or signUp scenario...
        echo $form->textFieldRow($model, 'user_name', array('size' => 45, 'maxlength' => 45, 'class' => 'span4'));
    else:
        // primary email can be changed; just set as primary on of other emails associated with this user
        echo $form->textFieldRow($model, 'user_name', array('size' => 45, 'maxlength' => 45, 'readonly' => 'readonly', 'disabled' => true, 'class' => 'span4'));
    endif;
    ?>

        <?php
        if ($model->scenario == 'create' || $model->scenario == 'signUp'):
            ?><?php
        echo $form->textFieldRow($model, 'email', array('size' => 60, 'maxlength' => 60, 'class' => 'span4'));
            ?><?php
    else:
        if ((Yii::app()->user->id === $model->id) || Yii::app()->user->checkAccess('emails_all_view')):
            ?><?php echo $form->textFieldRow($model, 'email', array('size' => 60, 'maxlength' => 60, 'readonly' => 'readonly', 'disabled' => true, 'class' => 'span4')); ?>
                <DIV class="span-5 last"><?php
            if ($model->scenario == 'update' && $myEmails):
                echo CHtml::AjaxLink('new email address', array("emails/create", 'id_user' => $model->id), array('update' => '#addEmail'), array('class' => 'displayInline' . (($hasUnverifiedEmails) ? ' hide' : ''), 'id' => 'CreateNewEmailButton', 'live' => false));
            endif;
                ?></DIV><?php
    endif;

endif;
        ?><?php
if ($model->scenario == 'create' || $model->scenario == 'signUp'):
else:
            ?><DIV id="emails" class="span-15 last">
                <DIV id="addEmail"></DIV>
                <DIV id="printEmails" class="span-15 last"><?php
            echo $this->renderPartial('/emails/_editMyEmails', array(
                'myEmails' => $myEmails,
            ));
            ?></DIV>
            </DIV><?php
    endif;
        ?></fieldset>

    <fieldset>
        <legend>Password and access:</legend><?php
        if ($model->scenario == 'update'):

            // If the user has the password_change right (operation) then old password is not needed anymore
            if (!Yii::app()->user->checkAccess("password_change")):
                // request for the old password only on the update scenario
                ?><?php echo $form->passwordFieldRow($model, 'password_old', array('size' => 45, 'maxlength' => 150, 'class' => 'span4')); ?>
                <DIV class="message note">Forgot your password? Click <?php echo CHtml::link('here', array('users/passwordRecoveryWhatUser')); ?> to reset your password.</DIV><?php
            endif;
        endif;
        ?>
<?php echo $form->passwordFieldRow($model, 'password', array('size' => 45, 'maxlength' => 150, 'class' => 'span4')); ?>

        <?php echo $form->passwordFieldRow($model, 'password_repeat', array('size' => 45, 'maxlength' => 150, 'class' => 'span4'));?>
        <?php
        if (( Yii::app()->user->checkAccess('users_all_view'))):
    ?><?php echo $form->dropDownListRow($model, 'active', Users::getActiveOptions());?>

        <?php echo $form->dropDownListRow($model, 'status', Users::getStatusOptions());?><?php
    endif;
?></fieldset>

    <fieldset>
        <legend>About you:</legend>
        <?php echo $form->textFieldRow($model, 'name', array('size' => 45, 'maxlength' => 45, 'class' => 'span4'));?>

        <?php echo $form->textFieldRow($model, 'surname', array('size' => 45, 'maxlength' => 45, 'class' => 'span4'));?>

            <?php
            /* UsersData model fields */
?><?php echo $form->textAreaRow($modelUsersData, 'description', array('rows' => 6, 'cols' => 50, 'class' => 'span4'));?>

        <?php echo $form->textFieldRow($modelUsersData, 'site', array('size' => 60, 'maxlength' => 1500, 'class' => 'span4'));?>

        <?php echo $form->textFieldRow($modelUsersData, 'facebook_address', array('size' => 60, 'maxlength' => 60, 'class' => 'span4'));?>

        <?php echo $form->textFieldRow($modelUsersData, 'twitter_address', array('size' => 60, 'maxlength' => 60, 'class' => 'span4'));?>
    </fieldset>


            <?php if (( Yii::app()->user->checkAccess('users_all_view'))): ?>
        <fieldset>
            <legend>User things:</legend><?php
            if (Yii::app()->getModule('bum')->invitationBasedSignUp || Yii::app()->getModule('bum')->invitationButtonDisplay):
                ?><?php echo $form->textFieldRow($modelUsersData, 'invitations_left', array('maxlength' => 5, 'class' => 'span4'));?>
                <?php
            else:
                echo $form->hiddenField($modelUsersData, 'invitations_left');
            endif;
                ?>
            <?php echo $form->textAreaRow($modelUsersData, 'obs', array('rows' => 6, 'cols' => 50, 'class' => 'span4'));?>
        </fieldset>
    <?php endif; ?>

    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Create' : 'Save',
        ));
        ?>
    </div>

        <?php $this->endWidget(); ?>

</div><!-- form --><?php
