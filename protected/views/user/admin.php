<h1 class="well" style="text-align: center">Gestion des utilisateurs</h1>

<?php

$this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'user-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    // 'template' => "{items}",
    'itemsCssClass' => 'table table-striped table-bordered ',
    //  'htmlOptions'=> array("style"=>"background-color:rgb(249, 249, 249);padding:10px;border-radius:10px", ),
    'columns' => array(
        //'id',
        'firt_name',
        'last_name',
        'username',
        //'password',
        'email',
        array(
            'class' => 'bootstrap.widgets.TbToggleColumn',
            'toggleAction' => 'user/admin',
            'name' => 'isActivated',
            'header' => 'Activé ?'
        ),
        
         array(
            'class' => 'bootstrap.widgets.TbToggleColumn',
            'toggleAction' => 'user/admin',
            'name' => 'isAdministrator',
            'header' => 'Admnistrateur ?',
             'htmlOptions'=>array('style'=>'width:130px'),
        ),
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template'=>'{update} {delete}',
             'buttons'=>array
    (
            'delete' => array
                (
            'visible'=>'("'.Yii::app()->user->name.'"==="root") ',
             ),
              'update' => array
             (
            'visible'=>'("'.Yii::app()->user->name.'"==="root") || (    $data->username === "'.Yii::app()->user->name.'") || !($data->isAdministrator) ',
             ),
        ),
    ),)
));
?>
