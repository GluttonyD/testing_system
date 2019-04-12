<?php
/**
 * @var \yii\web\View $this
 * @var \backend\models\EditTestForm $form
 */

$this->title = 'Редактирование теста';
$i = 1;
?>
<form method="post" action="/test/edit?id=<?= $form->getTest()->id ?>" class="test-edit-form"
      data-count="<?= $form->getTest()->getQuestionsCount() ?>">
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Название теста</h3>
                </div>
                <div class="box-body">
                    <label for="test-name">Название теста</label>
                    <input id="test-name" class="form-control" type="text" name="EditTestForm[name]"
                           value="<?= $form->name ?>">
                </div>
                <div class="box-footer">
                    <button class="btn btn-primary btn-flat">Сохранить изменения</button>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Вопросы теста</h3>
                    <button class="btn btn-danger btn-flat" id="remove-test-question">Удалить вопрос</button>
                    <button class="btn btn-success btn-flat" id="add-test-question">Добавить вопрос</button>
                </div>
                <div id="test-question-list" class="box-body">
                    <?php foreach ($form->getTest()->questions as $question) { ?>
                        <div id="test-item-<?= $i ?>">
                            <label for="test-question-<?= $i ?>">Текст вопроса</label>
                            <select id="test-question-<?= $i ?>" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" tabindex="-1" aria-hidden="true"
                                    name="EditTestForm[question_list][<?= $i ?>]">
                                <?php foreach ($form->questions as $item) { ?>
                                    <option value="<?= $item->id ?>" <?= ($question->id == $item->id) ? 'selected="selected"' : null ?>><?= $item->text ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <?php $i++;
                    } ?>
                </div>
            </div>
        </div>
    </div>
</form>
