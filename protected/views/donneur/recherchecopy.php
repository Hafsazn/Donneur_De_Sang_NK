<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::app()->clientscript
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/kendo.web.min.js', CClientScript::POS_END);
       //  ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/searcheAutocomplete.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScript('search', "
$('.search-buttondown').click(function(){
        $('.search-buttondown').css('display', 'none');
	$('.search-form').toggle(800);
        $('.search-buttonup').css('display', 'block');
        $('.search-buttonup').css('width', '30px');
	return false;
});
$('.search-buttonup').click(function(){
        $('.search-buttonup').css('display', 'none');
	$('.search-form').toggle(800);
        $('.search-buttondown').css('display', 'block');
        $('.search-buttondown').css('width', '30px');
	return false;
});

$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl . '/css/metrotheme.min.css'; ?>"/>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl . '/css/kendo.common.min.css'; ?>"/>
<script>
    $(".table td").css("text-align", "center");
</script>

<?php $this->widget('bootstrap.widgets.TbButton',
    array(
       // 'label' => 'Highlighted',
      //  'type' => 'primary',
        'htmlOptions'=>array('class'=>'search-buttondown'),
        'icon' =>'icon-circle-arrow-down',
    )
);
$this->widget('bootstrap.widgets.TbButton',
    array(
       // 'label' => 'Highlighted',
      //  'type' => 'primary',
        'htmlOptions'=>array('class'=>'search-buttonup', 'style'=>'display:none'),
        'icon' =>'icon-circle-arrow-up',
    )
);
?>
<div class="search-form" style="display:none">
    
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'donneur-grid',
    //'type'=>'striped bordered',
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'template' => "{items}",
    'dataProvider' => $model->search(),
    'columns' => array(
        array('name' => 'first_name', 'header' => 'Nom'),
        array('name' => 'last_name', 'header' => 'Prénom'),
        array('name' => 'gender', 'header' => 'Sexe'),
        'age',
        array('name' => 'address', 'header' => 'Adresse'),
        array('name' => 'groupe_sangun', 'header' => 'GS'),
        array('name' => 'phone', 'header' => 'Téléphone'),
        array('name' => 'email', 'header' => 'GS'),
        array(
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'name' => 'date_donation',
            // 
            'headerHtmlOptions' => array('style' => 'width: 100px'),
            'editable' => array(
                'type' => 'date',
                'viewformat' => 'yyyy-mm-dd ',
                'url' => $this->createUrl('donneur/update'),
                'placement' => 'left',
                'emptytext' => 'pas en court',
                'model' => $model,
                'title' => 'Séléctionner une date',
            )
        ),
        /*
          'phone',
          'date_donation',
          'email',
          'postal_code',
         */
        array(
           // 'class' => 'bootstrap.widgets.TbToggleColumn',
            //       'toggleAction' => 'donneur/toggle',
            'name' => 'vehicle',
            'header' => 'vehiclé'
        ),
    ),
));
?>
