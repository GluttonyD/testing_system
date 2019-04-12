<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Section[] $sections
 */
$this->title = 'Список разделов';
?>
<div class="row">
    <div class="col-xs-9 col-md-9">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Разделы вопросов</h3>
                <a class="btn btn-success" href="/section/create">Добавить раздел</a>
            </div>
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row"></div>
                    <div class="row">
                        <div class="col-xs-9 col-md-9">
                            <table class="table table-bordered table-hover dataTable" role="grid">
                                <thead>
                                <tr role="row">
                                    <th>Название раздела</th>
                                    <th>Кто добавил</th>
                                    <th>Время добавления</th>
                                    <th>Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($sections as $section) { ?>
                                    <tr role="row" id="section-<?= $section->id ?>">
                                        <td><?= $section->name ?></td>
                                        <td><?= $section->author->username ?></td>
                                        <td><?= date('d-m-Y H:i', $section->created_at + 3 * 3600) ?></td>
                                        <td>
                                            <a href="/section/edit?section_id=<?= $section->id ?>" class="fa fa-edit" title="Редактировать"></a>
                                            <a id="<?= $section->id ?>" data-id="<?= $section->id ?>" href="/section/delete?section_id=<?= $section->id ?>" class="fa fa-trash delete-section" title="Удалить"></a>
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
