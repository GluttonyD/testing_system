<?php
/**
 * @var \yii\web\View $this
 * @var \backend\models\ExcelParseForm $form
 */

$this->title = 'Добавление пользователей';
?>

<div class="row">
    <div class="col-md-4">
        <form method="post" action="/user/add-user-from-excel" enctype="multipart/form-data">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Выберите файл для загрузки</h3>
                </div>
                <div class="box-body">
                    <input id="excel-file" type="file" style="display: none;" name="ExcelParseForm[excel]">
                    <button id="choose-excel-file" class="btn btn-primary btn-flat">
                        Выберите файл
                        <span id="file-input-flag" style="display: none" class="label label-danger"><span
                                    class="fa fa-folder"></span></span>
                    </button>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">Добавить пользователей</button>
                </div>
            </div>
        </form>
    </div>
</div>
