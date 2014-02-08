<?php
/* @var $this StatusInfoController */
/* @var $model StatusInfo */

$this->breadcrumbs=array(
	'Status Infos'=>array('index'),
	$model->status_id=>array('view','id'=>$model->status_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List StatusInfo', 'url'=>array('index')),
	array('label'=>'Create StatusInfo', 'url'=>array('create')),
	array('label'=>'View StatusInfo', 'url'=>array('view', 'id'=>$model->status_id)),
	array('label'=>'Manage StatusInfo', 'url'=>array('admin')),
);
?>

<h1>Update StatusInfo <?php echo $model->status_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>