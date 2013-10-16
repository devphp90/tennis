<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'users-assessment-form',
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

    <?php echo $form->textArea($model, 'assessment', array('class' => 'span8', 'rows' => '8', 'readOnly' => $readOnly)); ?>

    <?php echo $form->error($model, 'assessment'); ?>


    <div class="form-actions" style="<?php echo $display?>">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
