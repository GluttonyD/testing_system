<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Test[] $tests
 */
$this->title = 'Список тестов';
?>
<div class="row">
    <div class="col-md-6 col-xs-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Список тестов</h3>
            </div>
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row"></div>
                    <div class="row">
                        <div class="col-xs-9 col-md-9">
                            <table class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th>Название теста</th>
                                    <th>Кто добавил</th>
                                    <th>Время добавления</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($tests as $test) { ?>
                                    <tr role="row">
                                        <td><?= $test->name ?></td>
                                        <td><?= $test->author->username ?></td>
                                        <td><?= date('d-m-Y H:i', $test->created_at + 3 * 3600) ?></td>
                                        <td>
                                            <a id="pass-delayed-test" class="btn btn-app" href="/test/pass-test?test_id=<?= $test->id ?>"><i class="fa fa-edit"></i>Пройти тест</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer"></div>
        </div>
    </div>
</div>
