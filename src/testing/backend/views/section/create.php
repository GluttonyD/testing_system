<?php
/**
 * @var \yii\web\View $this
 * @var backend\models\SectionForm $form
 */

$this->title='Добавление раздела'
?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <?php $active_form=\yii\widgets\ActiveForm::begin(
                [
                    'options'=>[
                        'role'=>'form'
                    ]
                ]
            ); ?>
                <div class="box-body">
                    <div class="form-group">
                        <?= $active_form->field($form,'name')->textInput(['class'=>'form-control'])->label('Название раздела') ?>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Добавить раздел</button>
                </div>
            <?php \yii\widgets\ActiveForm::end() ?>
        </div>
    </div>
</div>
