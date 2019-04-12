<?php
/**
 * @var \yii\web\View $this
 * @var \backend\models\TestForm $form
 */
$this->title = 'Создание теста';
?>
<div class="row">
    <form id="test-form" method="post" action="/test/create">
        <?= yii\helpers\Html:: hiddenInput(\Yii:: $app->getRequest()->csrfParam, \Yii:: $app->getRequest()->getCsrfToken(), []) ?>
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Название теста</h3>
                </div>
                <div class="box-body">
                    <label for="test-name">Название теста</label>
                    <input id="test-name" type="text" class="form-control" placeholder="Введите название теста" name="TestForm[name]">
                    <label for="test-repeatable">Повторное прохождение</label>
                    <select id="test-repeatable" class="form-control "
                                                        style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                        name="TestForm[repeatable]">
                        <option selected="selected" value="1">Да</option>
                        <option value="0">Нет</option>

                    </select>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Создать тест</button>
                </div>
            </div>
        </div>
        <div class="col-md-5 col-xs-5">
            <div class="box box-info">
                <div class="box-header">
                    <h3 class="box-title">Добавление разделов</h3>
                    <button id="add-test-section" class="btn btn-success">Добавить раздел</button>
                    <button id="remove-test-section" class="btn btn-danger">Убрать раздел</button>
                </div>
                <div id="test-sections" class="box-body">

                </div>
                <div class="box-footer">Не забудьте добавить разделы вопросов!</div>
            </div>
        </div>
    </form>
</div>
<div class="modal modal-danger fade in" id="test-error-modal" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ошибки</h4>
            </div>
            <div id="test-errors-list" class="modal-body">
                <p>Тут будут ответы</p>
            </div>
            <div class="modal-footer">
                <button id="close-question-answers" type="button" class="btn btn-outline pull-left" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>