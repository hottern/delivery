<?php
/* @var $this DeliveyInfoController */
/* @var $data DeliveyInfo */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fio')); ?>:</b>
	<?php echo CHtml::encode($data->fio); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('adress')); ?>:</b>
    <?php echo CHtml::encode($data->adress); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status_id')); ?>:</b>
	<?php echo CHtml::encode($data->status_id); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('china_id')); ?>:</b>
    <?php echo CHtml::encode($data->china_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('ems_id')); ?>:</b>
    <?php echo CHtml::encode($data->ems_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('code')); ?>:</b>
    <?php echo CHtml::encode($data->code); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	<?php echo CHtml::encode($data->weight); ?>
	<br />


</div>