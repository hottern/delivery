<?php
/* @var $this DeliveyInfoController */
/* @var $model DeliveyInfo */

$this->breadcrumbs=array(
	'Delivey Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DeliveyInfo', 'url'=>array('index')),
	array('label'=>'Manage DeliveyInfo', 'url'=>array('admin')),
);
?>

<h1>Create DeliveyInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>