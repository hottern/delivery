<?php
/* @var $this DeliveyInfoController */
/* @var $model DeliveyInfo */

$this->breadcrumbs=array(
	'Delivey Infos'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List DeliveyInfo', 'url'=>array('index')),
	array('label'=>'Create DeliveyInfo', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
alert('kjk');
	document.getElementById('Grid').style.display = 'block';

});

");


?>


<h1><?php echo Yii::t('main-ui', 'tracking'); ?></h1>


<div class="search-form" >
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<div class="Grid" id="Grid" style="display: none">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'delivey-info-grid',
	'dataProvider'=>$model->search(),

	'columns'=>array(
		'id',
		'fio',
		'date',
		'status',
		'weight',
		'code',

	),
)); ?>
</div>