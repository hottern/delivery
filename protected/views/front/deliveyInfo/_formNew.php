<?php
/* @var $this DeliveyInfoController */
/* @var $model DeliveyInfo */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'delivey-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'fio'); ?>
		<?php echo $form->textField($model,'fio',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'fio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'adress'); ?>
        <?php echo $form->textField($model,'adress',array('size'=>60,'maxlength'=>255)); ?>
        <?php echo $form->error($model,'adress'); ?>
    </div>

    <div class="row">
        <?php
        $list = CHtml::listData(StatusInfo::model()->findAll(array('order' => 'status_name')), 'status_id', 'status_name');
        echo $form->dropDownList($model, 'status_id', $list);
        ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'weight'); ?>
		<?php echo $form->textField($model,'weight'); ?>
		<?php echo $form->error($model,'weight'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'china_id'); ?>
        <?php echo $form->textField($model,'china_id',array('size'=>60,'maxlength'=>125)); ?>
        <?php echo $form->error($model,'china_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'ems_id'); ?>
        <?php echo $form->textField($model,'ems_id',array('size'=>60,'maxlength'=>125)); ?>
        <?php echo $form->error($model,'ems_id'); ?>
    </div>
        <?php echo $form->hiddenField($model,'id_user',array('value'=>Yii::app()->user->id)); ?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->