<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'users-session-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <?php if ( Yii::app()->user->type == "reviewer") {

        $readOnly = 'readOnly';
        $display = "display:none";
    }?>

	<?php echo $form->errorSummary($model); ?>

    <?php echo CHtml::label('Date','UsersSession_date'); ?>
    <?php echo $form->textField($model,'date',array('class'=>'span5', 'readOnly' => $readOnly)); ?>
    <?php echo $form->error($model,'date'); ?>

    <?php echo CHtml::label('Name','UsersSession_name'); ?>
    <?php echo $form->textField($model,'name',array('class'=>'span5', 'maxlength'=>255, 'readOnly' => $readOnly)); ?>
    <?php echo $form->error($model,'name'); ?>

    <?php echo $form->textFieldRow($model,'problem',array('class'=>'span5','maxlength'=>40, 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model,'level',array('class'=>'span5','maxlength'=>255, 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model,'ranking',array('class'=>'span5','maxlength'=>255, 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model,'target_level',array('class'=>'span5','maxlength'=>255, 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model,'target_ranking',array('class'=>'span5','maxlength'=>255, 'readOnly' => $readOnly)); ?>

	<?php
    if ($model->isNewRecord) {
        echo $form->hiddenField($model,'user_id',array('value'=> Yii::app()->user->id, 'readOnly' => 'readOnly'));
    }?>





	<div class="form-actions" style="<?php echo $display;?>">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>