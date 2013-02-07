<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'coupon-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'couponCode'); ?>
		<?php echo $form->textField($model,'couponCode',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'couponCode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'creationDate'); ?>
		<?php echo $form->textField($model,'creationDate'); ?>
		<?php echo $form->error($model,'creationDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'startDate'); ?>
		<?php echo $form->textField($model,'startDate'); ?>
		<?php echo $form->error($model,'startDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'endDate'); ?>
		<?php echo $form->textField($model,'endDate'); ?>
		<?php echo $form->error($model,'endDate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'validity'); ?>
		<?php echo $form->textField($model,'validity'); ?>
		<?php echo $form->error($model,'validity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'isUsed'); ?>
		<?php echo $form->textField($model,'isUsed'); ?>
		<?php echo $form->error($model,'isUsed'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'batchNo'); ?>
		<?php echo $form->textField($model,'batchNo',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'batchNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'serialNo'); ?>
		<?php echo $form->textField($model,'serialNo'); ?>
		<?php echo $form->error($model,'serialNo'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'couponId'); ?>
		<?php echo $form->textField($model,'couponId'); ?>
		<?php echo $form->error($model,'couponId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'couponType'); ?>
		<?php echo $form->textField($model,'couponType',array('size'=>6,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'couponType'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->