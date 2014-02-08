<?php
/* @var $this DeliveyInfoController */
/* @var $model DeliveyInfo */

$this->breadcrumbs=array(
	'Delivey Infos'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List DeliveyInfo', 'url'=>array('index')),
	array('label'=>'Create DeliveyInfo', 'url'=>array('create')),
	array('label'=>'Update DeliveyInfo', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete DeliveyInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DeliveyInfo', 'url'=>array('admin')),
);
?>

<h1>View DeliveyInfo #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'fio',
		'date',
		'status',
		'weight',
		'code',
	),
)); ?>
