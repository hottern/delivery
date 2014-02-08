<?php
/* @var $this StatusInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Status Infos',
);

$this->menu=array(
	array('label'=>'Create StatusInfo', 'url'=>array('create')),
	array('label'=>'Manage StatusInfo', 'url'=>array('admin')),
);
?>

<h1>Status Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
