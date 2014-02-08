<?php
/* @var $this StatusInfoController */
/* @var $model StatusInfo */

$this->breadcrumbs=array(
	'Status Infos'=>array('index'),
	$model->status_id,
);

$this->menu=array(
	array('label'=>'List StatusInfo', 'url'=>array('index')),
	array('label'=>'Create StatusInfo', 'url'=>array('create')),
	array('label'=>'Update StatusInfo', 'url'=>array('update', 'id'=>$model->status_id)),
	array('label'=>'Delete StatusInfo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->status_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StatusInfo', 'url'=>array('admin')),
);
?>

<h1>View StatusInfo #<?php echo $model->status_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'status_id',
		'status_name',
	),
)); ?>
