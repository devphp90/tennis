<?php
$this->breadcrumbs=array(
	'Users Sessions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Create Session','url'=>array('create')),
	array('label'=>'Manage Session','url'=>array('admin')),
    array('label' => 'Guider On', 'url'=>array('update', 'id' => $model->id, 'flag' => true)),
);
?>

<?php $this->header_title='Session: '.$model->name.', '.Yii::app()->dateFormatter->format("MM/d/y",strtotime($model->date));?>

<?php
    $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs', // 'tabs' or 'pills'
        'tabs'=>array(
            array('label'=>'Info', 'content'=>$this->renderPartial('_form',array('model'=>$model), true), 'active'=>true),
            array('label'=>'Subjective', 'content'=>$this->renderPartial('_subjective',array('model'=>$model), true)),
            array('label'=>'Objective', 'content'=>$this->renderPartial('_objective',array('model'=>$model), true)),
            array('label'=>'Assessment', 'content'=>$this->renderPartial('_assessment',array('model'=>$model), true)),
            array('label'=>'Plan', 'content'=>$this->renderPartial('_plan',array('model'=>$model), true)),
            array('label'=>'Match Stats', 'content'=>$this->renderPartial('_match_stats',array('model'=>$model), true)),
            array('label'=>'Video', 'content'=>$this->renderPartial('_video',array('video_model'=>$video_model, 'uploaded_video'=>$uploaded_video), true)),
            array('label'=>'Photos', 'content'=>$this->renderPartial('_photos',array('photo_model'=>$photo_model, 'uploaded_photo'=>$uploaded_photo), true)),
            array('label'=>'Review', 'content'=>$this->renderPartial('_review',array('model'=>$model), true)),
        ),
    ));
?>
<?php
//echo $this->action->id;die();
$this->widget('ext.eguiders.EGuider', array(
            'id'			=> 'intro',
            'next' 			=> 'position',
            'title'			=> 'Welcome',
           // 'buttons'		=> array(array('name'=>'Next')),
            'description' 	=> 'here goes description', //$this->renderPartial('_guide_intro',null,true),
            'overlay'		=> true,
            'xButton'		=> true,
            'show'			=> $guider_flag // give true of false
        ));?>