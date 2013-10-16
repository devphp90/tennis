<?php
$this->breadcrumbs=array(
	'Users Sessions'=>array('index'),
	'Manage',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-session-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<?php $this->menu=array(
	array('label'=>'Create Session','url'=>array('create')),
    array('label'=>'Advanced Search', 'url'=>'#', 'linkOptions'=>array('class' => 'search-button'))
);?>

<?php $this->header_title='Manage Sessions';?>


<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'users-session-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
    'summaryText' => '',
	'columns'=>array(
        array(
            'name' =>'date',
            'type' => 'raw',
            'value'=>'CHtml::link(Yii::app()->dateFormatter->format("MM/d/y",strtotime($data->date)), array("update", "id" => $data->id), array("title" => "Edit"))'
        ),
        'name',
		'id',
		array(
            'name' => 'user_id',
            'value' => '$data->user->name'
        ),
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
));?>
