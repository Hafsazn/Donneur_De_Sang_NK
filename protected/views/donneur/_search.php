<?php
/* @var $this DonneurController */
/* @var $model Donneur */
/* @var $form CActiveForm */
?>
<style>
    .k-widget .k-combobox .k-header{
        width: 190px;
    }
</style>
<div class="wide form" >

<?php $form=$this->beginWidget( 'bootstrap.widgets.TbActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
        'id' => 'inlineForm',
        'htmlOptions' => array('class' => 'well'), // for inset effect
	'method'=>'get',
)); ?>
   
    <h2 style="text-align: center;font-family:  serif, Arial, sans-serif;color: #a80101" >Recherche</h2>
    <hr/>
    <div id="cutom-search" style="margin-left: 15%">
	<div class="row">
		<?php echo $form->textFieldRow($model,'groupe_sangun',array('size'=>10,'maxlength'=>10,)); ?>
	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'gender',array('size'=>5,'maxlength'=>5)); ?>
	</div>

	<div class="row">
		<?php echo $form->textFieldRow($model,'address',array('size'=>60,'maxlength'=>512)); ?>
	</div>
        <div class="row">
		<?php echo $form->textFieldRow($model,'vehicle',array('size'=>5,'maxlength'=>8)); ?>
	</div>

	
	

	<div class="row buttons">
		<?php $this->widget(
    'bootstrap.widgets.TbButton',
    array('buttonType' => 'submit', 'label' => 'rechercher')
); ?>
	</div>
</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->