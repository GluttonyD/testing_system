<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\models\ProfileForm $form
 */

use yii\widgets\ActiveForm;

$this->title='Редактирование профиля';
?>

<div class="row">
    <?php $active_form=ActiveForm::begin(); ?>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Введите новые данные</h3>
            </div>
            <div class="box-body">
                <?= $active_form->field($form,'username')->textInput()->label('Имя пользователя') ?>
                <?= $active_form->field($form,'email')->textInput()->label('Email') ?>
                <?= $active_form->field($form,'phone')->textInput()->label('Телефон') ?>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Сохранить изменения</button>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
