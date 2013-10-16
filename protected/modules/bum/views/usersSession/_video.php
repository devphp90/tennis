<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'session-video-form',
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

	<?php echo $form->errorSummary($video_model); ?>

    <?php if (!empty($uploaded_video)) {
        echo "<strong>Uploaded Videos</strong>";
        echo "<ul class='thumbnails'>";
        foreach ($uploaded_video as $video) {
            echo "<li>";

            $this->widget('application.extensions.videojs.EVideoJS', array(
                'options' => array(
                    // Unique identifier, is autogenerated by default, useful for jQuery integrations.
                    'id' => false,
                    // Video and poster width in pixels
                    'width' => 320,
                    // Video and poster height in pixels
                    'height' => 240,
                    // Poster image absolute URL
                    'poster' => false,
                    // Absolute URL of the video in MP4 format
                    'video_mp4' => Yii::app()->baseUrl.'/videos/'.$video->file_name,
                    //'video_mp4' => false,
                    // Absolute URL of the video in OGV format
                    'video_ogv' => false,
                    // Absolute URL of the video in WebM format
                    //'video_webm' => Yii::app()->baseUrl.'/videos/'.$video->file_name,
                    // Use Flash fallback player ?
                    'flash_fallback' => true,
                    // Address of custom Flash player to use as fallback
                    'flash_player' => 'http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf',
                    // Show controls ?
                    'controls' => true,
                    // Preload video content ?
                    'preload' => false,
                    // Autostart the playback ?
                    'autoplay' => false,
                    // Show VideoJS support link ?
                    'support' => false,
                    // Show video download links ?
                    'download' => true,
                ),
            ));?>

            <?php if (!$readOnly) echo CHtml::link('Delete', 'javascript:void(0);', array('title' => "Click to delete this video", "class" => "btn btn-danger deleteVbtn", "data-id" => $video->id))?>
            </li>
        <?php }
        echo "</ul>";
    }
?>
    <?php if (!$readOnly) echo $form->fileField($video_model, 'file_name'); ?>

    <?php echo $form->error($video_model, 'file_name'); ?>

    <div class="form-actions" style="<?php echo $display;?>">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Save',
		)); ?>
	</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">

    $('.deleteVbtn').on('click', function () {
        if(!confirm("Are you sure you want to delete this video?"))
            return false;
        id = $(this).attr('data-id');
        $.ajax({
            url: '<?php echo Yii::app()->createUrl('/bum/usersSession/deleteVideo')?>',
            data: {id: id},
            type: 'POST',
            success: function () {}
        });
        $(this).parent().remove();
    });

</script>