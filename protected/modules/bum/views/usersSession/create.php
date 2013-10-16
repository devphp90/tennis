<?php
$this->breadcrumbs=array(
	'Users Sessions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage Session','url'=>array('admin')),
);
?>

<h3>Create Session</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>