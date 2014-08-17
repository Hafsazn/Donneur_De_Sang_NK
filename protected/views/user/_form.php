
<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => true,
    'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well', 'style' => "width: 65%;margin-left: 15%;"), // for inset effect
        ));
$isASave = $model->isNewRecord;
if ($isASave)
    echo '<h1 style="text-align: center;font-family:  serif, Arial, sans-serif;color: #a80101">Créer un utilisateur</h1>';
else
    echo '<h1 style="text-align: center;font-family:  serif, Arial, sans-serif;color: #a80101">Mettre à jour l\'utilisateur :' .
        User::model()->findByPk($model->id)->username. '</h1>';
?>




<hr/>

<div class="cutom-create-form">
    <p class="help-block">Champs avec <span class="required">*</span> sont obligatoires.</p>
    <br/>
    <?php
    $isASave = $model->isNewRecord;
    echo $form->errorSummary($model);
    ?>

    <?php echo $form->textFieldRow($model, 'firt_name', array('class' => 'span5', 'maxlength' => 128)); ?>

    <?php echo $form->textFieldRow($model, 'last_name', array('class' => 'span5', 'maxlength' => 128)); ?>

    <?php if (($model->username === Yii::app()->user->name) || ($model->username != 'root') || $isASave)
        echo $form->textFieldRow($model, 'username', array('class' => 'span5', 'maxlength' => 128));
    ?>

    <?php
    if (($model->username === Yii::app()->user->name) || $isASave) {
        if (!$isASave) {
            $model->password = NULL;
        }
        echo $form->passwordFieldRow($model, 'password', array('class' => 'span5', 'maxlength' => 128));
    }
    ?>


<?php echo $form->textFieldRow($model, 'email', array('class' => 'span5', 'maxlength' => 512)); ?>



    <?php
    if ($isASave) {
        echo $form->toggleButtonRow($model, 'isActivated', array('enabledLabel' => 'Oui',
            'disabledLabel' => 'Non'
        ));
    } else if ($model->username != "root") {
        if (($model->username === Yii::app()->user->name) || !($model->isAdministrator) || (Yii::app()->user->name === 'root')) {

            echo $form->toggleButtonRow($model, 'isActivated', array('enabledLabel' => 'Oui',
                'disabledLabel' => 'Non'));
        }
    }
    ?>

    <?php
    if ($isASave) {
        if (Yii::app()->user->name === 'root') {
            echo $form->toggleButtonRow($model, 'isAdministrator', array('enabledLabel' => 'Oui',
                'disabledLabel' => 'Non'
            ));
        }
    } else if ($model->username !== 'root') {

        if (($model->username == Yii::app()->user->name) || (Yii::app()->user->name == 'root' )) {
            echo $form->toggleButtonRow($model, 'isAdministrator', array('enabledLabel' => 'Oui',
                'disabledLabel' => 'Non'));
        }
    }
    ?>

    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'danger',
            'label' => $isASave ? 'Créer' : 'Sauvgarder',
        ));
        ?>
    </div>
</div>

<?php $this->endWidget(); ?>
