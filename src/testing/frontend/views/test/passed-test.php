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