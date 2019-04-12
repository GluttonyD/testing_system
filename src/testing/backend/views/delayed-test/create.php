<?php
/**
 * @var \yii\web\View $this
 * @var \backend\models\PassedTestForm $form
 */

$this->title = 'Добавление отложенного теста';
?>
<form id="delayed-test-form" action="/delayed-test/create" method="post">
    <?= yii\helpers\Html:: hiddenInput(\Yii:: $app->getRequest()->csrfParam, \Yii:: $app->getRequest()->getCsrfToken(), []) ?>
    <div class="row">
        <div class="col-md-4 col-xs-4">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Информация о тесте</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="test-id">Тест</label>
                            <select id="test-id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" tabindex="-1" aria-hidden="true"
                                    name="PassedTestForm[test_id]">
                                <option selected="selected" disabled>Выберите тест</option>
                                <?php foreach ($form->tests as $id => $name) { ?>
                                    <option value="<?= $id ?>"><?= $name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="test-id">Пользователь</label>
                            <select id="test-id" class="form-control select2 select2-hidden-accessible"
                                    style="width: 100%;" tabindex="-1" aria-hidden="true"
                                    name="PassedTestForm[user_id]">
                                <option selected="selected" disabled>Выберите пользователя</option>
                                <?php foreach ($form->users as $id => $name) { ?>
                                    <option value="<?= $id ?>"><?= $name ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Добавить отложенный тест</button>
                </div>
            </div>
        </div>
    </div>
</form>