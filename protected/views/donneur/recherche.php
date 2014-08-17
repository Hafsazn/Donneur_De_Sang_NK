<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
Yii::app()->clientscript
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/kendo.web.min.js', CClientScript::POS_END)
        ->registerScriptFile(Yii::app()->theme->baseUrl . '/js/searcheAutocomplete.js', CClientScript::POS_END);

Yii::app()->clientScript->registerScript('search', "
    $('.search-buttondown').click(function(){
$('.search-form').toggle(800);
return false;
});
$('.search-form form').submit(function(){
	$('#donneur-grid').yiiGridView('update', {
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

<?php
$this->widget('bootstrap.widgets.TbButton', array(
    // 'label' => 'Highlighted',
    //  'type' => 'primary',
    'htmlOptions' => array('class' => 'search-buttondown', 'style'=>'margin-left:20px'),
    'icon' => 'icon-circle-arrow-down',
        )
);
$this->widget('bootstrap.widgets.TbButton', array(
    // 'label' => 'Highlighted',
    //  'type' => 'primary',
    'htmlOptions' => array('class' => 'search-buttonup', 'style' => 'display:none;margin-left:15px'),
    'icon' => 'icon-circle-arrow-up',
        )
);
?>
<div class="search-form" style="display: none">
    <?php
    $this->renderPartial('_search', array(
        'model' => $model,
    ));
    ?>
</div><!-- search-form -->

<?php
$this->widget('bootstrap.widgets.TbExtendedGridView', array(
    'id' => 'donneur-grid',
    //'type'=>'striped bordered',
    'itemsCssClass' => 'table table-striped table-bordered table-condensed',
    'dataProvider' => $model->search(),
    'columns' => array(
        array('name' => 'first_name', 'header' => 'Nom'),
        array('name' => 'last_name', 'header' => 'Prénom'),
        array('name' => 'gender', 'header' => 'Sexe'),
        'age',
        array('name' => 'address', 'header' => 'Adresse'),
        array('name' => 'groupe_sangun', 'header' => 'GS'),
        array('name' => 'phone', 'header' => 'Téléphone'),
        array('name' => 'email', 'header' => 'Email'),
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
   
    'extendedSummary' => array(
        'title' => 'Groupes sanguns',
        'columns' => array(
            'groupe_sangun' => array(
                'label' => 'Répartition des groupes sanguns',
                'types' => array(
                    'O+' => array('label' => 'O+'),
                    'O-' => array('label' => 'O-'),
                    'A+' => array('label' => 'A+'),
                    'A-' => array('label' => 'A-'),
                    'B+' => array('label' => 'B+'),
                    'B-' => array('label' => 'B-'),
                    'AB+' => array('label' => 'AB+'),
                    'AB-' => array('label' => 'AB-')
                ),
                'class' => 'TbPercentOfTypeEasyPieOperation',
// you can also configure how the chart looks like
                'chartOptions' => array(
                   // 'barColor' => '#2C3E50',
                    'scaleColor'=>'#fff',
                    'trackColor' => '#fff',
                    'lineWidth' => 5,
                    'lineCap' => 'circle',
                    'animate'=>8000,
                )
            )
        )
    ),
    'extendedSummaryOptions' => array(
        'class' => 'well pull-left',
        'style' => 'width:920px'
    ),
));
?>
