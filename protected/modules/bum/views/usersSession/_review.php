<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'users-review-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

    <?php if ( Yii::app()->user->type != "admin" && Yii::app()->user->type != "reviewer") {

        $readOnly = 'readOnly';
    } else 
        $readOnly = '';
    ?>

    <?php echo $form->textAreaRow($model,'mechanics',array('class'=>'span8','rows'=>6 )); ?>

    <?php echo $form->textAreaRow($model,'timing',array('class'=>'span8','rows'=>6 )); ?>

    <?php echo $form->textAreaRow($model,'footwork',array('class'=>'span8','rows'=>6 )); ?>

    <?php echo $form->textAreaRow($model,'fitness',array('class'=>'span8','rows'=>6 )); ?>

    <?php echo $form->textAreaRow($model,'effectiveness',array('class'=>'span8','rows'=>6 )); ?>

    <?php echo $form->textAreaRow($model,'strategy',array('class'=>'span8','rows'=>6 )); ?>




	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
