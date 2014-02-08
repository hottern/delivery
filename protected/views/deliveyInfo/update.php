<?php
/* @var $this DeliveyInfoController */
/* @var $model DeliveyInfo */

$this->breadcrumbs=array(
	'Delivey Infos'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List DeliveyInfo', 'url'=>array('index')),
	array('label'=>'Create DeliveyInfo', 'url'=>array('create')),
	array('label'=>'View DeliveyInfo', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage DeliveyInfo', 'url'=>array('admin')),
);
?>

<h1>Update DeliveyInfo <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>