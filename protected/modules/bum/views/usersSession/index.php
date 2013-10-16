<?php
$this->breadcrumbs=array(
	'Users Sessions',
);

$this->menu=array(
	array('label'=>'Create Session','url'=>array('create')),
	array('label'=>'Manage Session','url'=>array('admin')),
);
?>

<h3>Sessions</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
