

<h1 class="well" style="text-align: center">Traces des utilisateurs</h1>



<?php $this->widget('bootstrap.widgets.TbGridView',array(
'id'=>'user-log-grid',
'dataProvider' => $model->search(),
    'filter' => $model,
    'itemsCssClass' => 'table table-striped table-bordered ',
'columns'=>array(
		array('name'=>'username','header'=>'Utilisateur'),
		array('name'=>'logtime','header'=>'Temps', ),
		array('name'=>'details','header'=>'Les details','htmlOptions'=>array('style'=>'width:70%'))

),
)); ?>
