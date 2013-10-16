<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'session-photo-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    ),
)); ?>

    <?php if ( Yii::app()->user->type == "reviewer") {

        $readOnly = 'readOnly';
        $display = "display:none";
    }?>

	<?php echo $form->errorSummary($photo_model); ?>

    <?php if (!empty($uploaded_photo)) {
        $gallery = array();?>

        <div><strong>Uploaded Photos</strong></div>

        <ul class="thumbnails">
        <?php foreach ($uploaded_photo as $photo) {
            $gallery[] = Yii::app()->baseUrl.'/photos/'.$photo->file_name;
            ?>
            <li>
            <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl.'/photos/thumb/'.$photo->file_name, $photo->file_name), Yii::app()->baseUrl.'/photos/'.$photo->file_name, array('class' => 'thumbnail', 'rel' => 'gallery'));?>

            <?php if (!$readOnly) echo CHtml::link('Delete', 'javascript:void(0);', array('title' => "Click to delete this image", "class" => "btn btn-danger deletebtn", "data-id" => $photo->id))?>

            </li>

        <?php }?>
        </ul>
        <hr/>
    <?php }
?>



    <?php if (!$readOnly) {
        echo "<p class='highlight'>The file must be less than and equal to 640*480 px</p>";
        echo $form->fileField($photo_model, 'file_name');

    }?>

    <?php echo $form->error($photo_model, 'file_name'); ?>

    <div class="form-actions" style="<?php echo $display;?>">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<?php
$this->widget('ext.yiiColorbox.colorboxWidget', array(
    'registerScript' => true,
    "theme" => "4",
    "triggerclass" => "thumbnail", //
    "options" => array("height" => "600", "width" => "860"),
    "actions" => array(
    ),
));
?>

<script type="text/javascript">

    $('.deletebtn').on('click', function () {
        if(!confirm("Are you sure you want to delete this image?"))
            return false;
        id = $(this).attr('data-id');
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('/bum/usersSession/deletePhoto')?>',
            data: {id: id},
            type: 'POST',
            success: function () {}
        });
        $(this).parent().remove();
    });

    //$('a.thumbnail').colorbox({rel:'gallery'});
</script>