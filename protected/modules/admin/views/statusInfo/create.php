<?php
/* @var $this StatusInfoController */
/* @var $model StatusInfo */

$this->breadcrumbs=array(
	'Status Infos'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StatusInfo', 'url'=>array('index')),
	array('label'=>'Manage StatusInfo', 'url'=>array('admin')),
);
?>

<h1>Create StatusInfo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>