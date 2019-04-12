<?php
/**
 * @var \yii\web\View $this
 * @var backend\models\QuestionForm $form
 */

$this->title = 'Редактирование вопроса';
$i = 1;
?>

<div class="row">
    <form id="question-form" data-count="<?= $form->getQuestion()->getAnswersCount() ?>" role="form" method="post"
          action="/question/edit?question_id=<?= $form->getQuestionId() ?>" data-edit="1" data-id="<?= $form->getQuestion()->id ?>">
        <?= yii\helpers\Html:: hiddenInput(\Yii:: $app->getRequest()->csrfParam, \Yii:: $app->getRequest()->getCsrfToken(), []) ?>
        <div class="col-md-3">
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">Информация о вопросе</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="section-id">Раздел вопроса</label>
                            <select data-lalala="<?= $form->getSectionId() ?>" id="section-id"
                                    class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" tabindex="-1" aria-hidden="true"
                                    name="QuestionForm[section_id]">
                                <option selected="selected" disabled>Выберите раздел</option>
                                <?php foreach ($form->sections as $id => $section) { ?>
                                    <option value="<?= $id ?>" <?= ($form->getSectionId() == $id) ? 'selected="selected"' : null ?>><?= $section ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="question-text">Текст вопроса</label>
                            <input id="question-text" class="form-control" name="QuestionForm[text]"
                                   value="<?= $form->text ?>">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    Не забудьте добавить ответы к вопросу
                    <button class="btn btn-success">Сохранить изменения</button>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Добавление ответов</h3>
                    <button id="add-answer" class="btn btn-success">Добавить ответ</button>
                    <button id="remove-answer" class="btn btn-danger">Убрать ответ</button>
                </div>
                <div id="question-answers" class="box-body">
                    <?php foreach ($form->getQuestion()->answers as $answer) { ?>
                        <div id="answer-<?= $i ?>" class="row">
                            <div class="form-group col-md-9">
                                <label for="answer-text">Текст ответа</label>
                                <input id="answer-text" type="text" class="form-control"
                                       name="QuestionForm[answers][<?= $i ?>][text]" value="<?= $answer->text ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="right-answer">Правильный?</label>
                                <select id="right-answer" class="form-control select2"
                                        name="QuestionForm[answers][<?= $i ?>][is_right]">
                                    <option selected="selected" value="1">Да</option>
                                    <option value="0" <?= ($answer->is_right==0)?'selected="selected"':null ?>>Нет</option>
                                </select>
                            </div>
                        </div>
                        <?php $i++;
                    } ?>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal modal-danger fade in" id="question-error-modal" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ошибки</h4>
            </div>
            <div id="question-errors-list" class="modal-body">
                <p>Тут будут ответы</p>
            </div>
            <div class="modal-footer">
                <button id="close-question-answers" type="button" class="btn btn-outline pull-left"
                        data-dismiss="modal">Закрыть
                </button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>