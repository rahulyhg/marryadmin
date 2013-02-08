<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'marryId'); ?>
		<?php echo $form->textField($model,'marryId',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'marryId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'emailId'); ?>
		<?php echo $form->textField($model,'emailId',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'emailId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'dob'); ?>
		<?php echo $form->textField($model,'dob'); ?>
		<?php echo $form->error($model,'dob'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'gender'); ?>
		<?php echo $form->textField($model,'gender',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'gender'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'motherTounge'); ?>
		<?php echo $form->textField($model,'motherTounge'); ?>
		<?php echo $form->error($model,'motherTounge'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'createdOn'); ?>
		<?php echo $form->textField($model,'createdOn'); ?>
		<?php echo $form->error($model,'createdOn'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->textField($model,'active'); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'handicapped'); ?>
		<?php echo $form->textField($model,'handicapped'); ?>
		<?php echo $form->error($model,'handicapped'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'highlighted'); ?>
		<?php echo $form->textField($model,'highlighted'); ?>
		<?php echo $form->error($model,'highlighted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'userType'); ?>
		<?php echo $form->textField($model,'userType'); ?>
		<?php echo $form->error($model,'userType'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->