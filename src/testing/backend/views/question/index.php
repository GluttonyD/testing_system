<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Question[] $questions
 */

$this->title='Список вопросов';
?>
<div class="row">
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Разделы вопросов</h3>
                <a class="btn btn-success" href="/question/create">Добавить вопрос</a>
            </div>
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row"></div>
                    <div class="row">
                        <div class="col-xs-9">
                            <table class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th>Текст вопроса</th>
                                    <th>Раздел</th>
                                    <th>Кто добавил</th>
                                    <th>Время добавления</th>
                                    <th>Посмотреть ответы</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($questions as $question) { ?>
                                    <tr role="row" id="question-<?= $question->id ?>">
                                        <td><?= $question->text ?></td>
                                        <td><?= $question->section->name ?></td>
                                        <td><?= $question->author->username ?></td>
                                        <td><?= date('d-m-Y H:i', $question->created_at + 3 * 3600) ?></td>
                                        <td><button id="<?= $question->id ?>" data-id="<?= $question->id ?>" class="btn btn-info show-question-answers" data-toggle="modal" data-target="#answers-modal">Ответы</button></td>
                                        <td>
                                            <a href="/question/edit?question_id=<?= $question->id ?>" class="fa fa-edit" title="Редактировать"></a>
                                            <a id="<?= $question->id ?>" data-id="<?= $question->id ?>" href="/question/delete?question=<?= $question->id ?>" class="fa fa-trash delete-question" title="Удалить"></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-info fade in" id="answers-modal" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Ответы на вопрос</h4>
            </div>
            <div class="modal-body">
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
