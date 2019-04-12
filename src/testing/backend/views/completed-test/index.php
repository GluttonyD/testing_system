<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\PassedTest[] $tests
 */

$this->title='Список пройденных тестов';
?>
<div class="row">
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Список пройденных тестов</h3>
            </div>
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row"></div>
                    <div class="row">
                        <div class="col-xs-9">
                            <table class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th>Пользователь</th>
                                    <th>Название теста</th>
                                    <th>Количество вопросов</th>
                                    <th>Количество правильных ответов</th>
                                    <th>Результат</th>
                                    <th>Посмотреть подробнее</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tests as $test) { ?>
                                    <tr role="row">
                                        <td><?= $test->user->username ?></td>
                                        <td><?= $test->test->name?></td>
                                        <td><?= $test->question_count ?></td>
                                        <td><?= $test->right_answers ?></td>
                                        <td><?= $test->result*100 ?>%</td>
                                        <td><button id="<?= $test->id ?>" data-id="<?= $test->id ?>" class="btn btn-info btn-flat show-passed-details" data-toggle="modal" data-target="#detail-modal">Подробнее</button> </td>
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
<div class="modal modal-info fade in" id="detail-modal" style="display: none; padding-right: 17px;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Информация о прохождении теста</h4>
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