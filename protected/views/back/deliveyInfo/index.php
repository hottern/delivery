<?php
/* @var $this DeliveyInfoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Delivey Infos',
);

$this->menu=array(
	array('label'=>'Create DeliveyInfo', 'url'=>array('create')),
	array('label'=>'Manage DeliveyInfo', 'url'=>array('admin')),
);
?>

<h1>Delivey Infos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
