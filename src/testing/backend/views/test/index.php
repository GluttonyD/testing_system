<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Test[] $tests
 * @var \yii\data\Pagination $pages
 */
$this->title = 'Список тестов';
?>
<div class="row">
    <div class="col-md-6 col-xs-6">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Список тестов</h3>
                <a href="/test/create" class="btn btn-success">Создать тест</a>
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
                                    <tr role="row" class="test-item" id="test-<?=$test->id ?>">
                                        <td><?= $test->name ?></td>
                                        <td><?= $test->author->username ?></td>
                                        <td><?= date('d-m-Y H:i', $test->created_at + 3 * 3600) ?></td>
                                        <td>
                                            <a class="fa fa-info-circle" title="Информация о тесте" href="/test/details?id=<?= $test->id ?>"></a>
                                            <a href="/test/delete?id=<?= $test->id ?>" class="fa fa-trash delete-test" id="<?= $test->id ?>" title="Удаление"></a>
                                            <a href="/test/edit?id=<?= $test->id ?>" class="fa fa-pencil" title="Редактирование"></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <?= \yii\widgets\LinkPager::widget([
                        'pagination'=>$pages
                ])?>
            </div>
        </div>
    </div>
</div>
