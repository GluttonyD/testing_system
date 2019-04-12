<?php
/**
 * @var \yii\web\View $this
 * @var backend\models\SectionForm $form
 */

$this->title = 'Редактирование раздела'
?>

<div class="row">
    <div class="col-md-3">
        <div class="box box-primary">
            <?php $active_form = \yii\widgets\ActiveForm::begin(
                [
                    'options' => [
                        'role' => 'form'
                    ],
                    'action'=>'/section/edit?section_id='.$form->getSectionId()
                ]
            ); ?>
            <div class="box-body">
                <div class="form-group">
                    <?= $active_form->field($form, 'name')->textInput(['class' => 'form-control'])->label('Название раздела') ?>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-flat">Сохранить изменения</button>
            </div>
            <?php \yii\widgets\ActiveForm::end() ?>
        </div>
    </div>
</div>
