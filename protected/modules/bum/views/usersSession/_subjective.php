<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'users-subjective-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
    <?php 
    if ( Yii::app()->user->type == "reviewer") {
        $readOnly = 'readOnly';
        $display = "display:none";
    } else {
        $readOnly = '';
        $display = "display:block";
    }
    ?>

	<?php echo $form->errorSummary($model); ?>

    <?php echo $form->textArea($model, 'subjective', array('class' => 'span8', 'rows' => '8' )); ?>

    <?php echo $form->error($model, 'subjective'); ?>


    <div class="compactRadioGroup">
        <?php echo $form->radioButtonListRow($model, 'game_on_off', array(1 => 'On', 0 => 'Off')); ?>
    </div>

<div class="compactRadioGroup">
    <?php echo $form->radioButtonListRow($model, 'serve_on_off', array(1 => 'On', 0 => 'Off')); ?>
</div>


<div class="compactRadioGroup">
    <?php echo $form->radioButtonListRow($model, 'return_on_off', array(1 => 'On', 0 => 'Off')); ?>
</div>

<div class="form-actions" style="<?php echo $display;?>">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>