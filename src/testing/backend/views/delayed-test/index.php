<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\PassedTest[] $tests
 */

$this->title='Список отложенных тестов';
?>
<div class="row">
    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Список тестов для прохождения</h3>
                <a class="btn btn-success" href="/delayed-test/create">Добавить тест</a>
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
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tests as $test) { ?>
                                    <tr role="row">
                                        <td><?= $test->user->username ?></td>
                                        <td><?= $test->test->name?></td>
                                        <td>
                                            <a id="generate-test-pdf" class="btn btn-app" href="/delayed-test/generate-pdf?test_id=<?= $test->test->id ?>&user_id=<?= $test->user->id ?>"><i class="fa fa-file-pdf-o"></i>PDF</a>
                                            <a id="pass-delayed-test" class="btn btn-app" href="/delayed-test/pass-test?delayed_test_id=<?= $test->id ?>"><i class="fa fa-edit"></i>Пройти тест</a>
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
