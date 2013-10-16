<?php
$this->breadcrumbs=array(
	'Users Sessions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Session','url'=>array('index')),
	array('label'=>'Create Session','url'=>array('create')),
	array('label'=>'Update Session','url'=>array('update','id'=>$model->id)),
	array('label'=>'Delete Session','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Session','url'=>array('admin')),
);
?>

<h3>View Session #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'name',
		'date',
	),
)); ?>
