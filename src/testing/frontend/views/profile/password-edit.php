<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\models\EditPasswordForm $form
 */

use yii\widgets\ActiveForm;

$this->title='Редактирование пароля';
?>

<div class="row">
    <?php $active_form=ActiveForm::begin(); ?>
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Введите старый и новый пароли</h3>
            </div>
            <div class="box-body">
                <?= $active_form->field($form,'old_password')->passwordInput()->label('Старый пароль') ?>
                <?= $active_form->field($form,'new_password')->passwordInput()->label('Новый пароль') ?>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success btn-flat">Сохранить изменения</button>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
