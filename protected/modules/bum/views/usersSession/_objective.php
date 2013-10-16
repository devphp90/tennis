<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'users-objective-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
        ));
?>
    <?php if ( Yii::app()->user->type == "reviewer") {

        $readOnly = 'readOnly';
        $display = "display:none";
    }?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textArea($model, 'objective', array('class' => 'span8', 'rows' => '8', 'readOnly' => $readOnly)); ?>
    <?php echo $form->error($model, 'objective'); ?>

    <?php echo $form->textFieldRow($model, 'serves_number_of', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'forehands_number_of', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'backhands_number_of', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'serve_mph', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'forehand_mph', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'backhand_mph', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'forehand_longest_rally', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'backhand_longest_rally', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'strokes_longest_rally', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'footwork_speed_sidetoside', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'footwork_speed_forward', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

    <?php echo $form->textFieldRow($model, 'footwork_speed_backward', array('class' => 'span4', 'readOnly' => $readOnly)); ?>

<div class="form-actions" style="<?php echo $display;?>">
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'buttonType' => 'submit',
        'type' => 'primary',
        'label' => 'Save',
    ));
    ?>
</div>

<?php $this->endWidget(); ?>
