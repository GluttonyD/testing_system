<?php
/**
 * @var \common\models\User $user
 * @var \yii\web\View $this
 */

$this->title='Профиль';
?>
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Ваши данные</h3>
            </div>
            <div class="box-body">
                <dl>
                    <dt>Имя</dt>
                    <dd><?= $user->username ?></dd>
                    <dt>Email</dt>
                    <dd><?= ($user->email)?$user->email:'Нет' ?></dd>
                    <dt>Телефон</dt>
                    <dd><?= ($user->phone)?$user->phone:'Нет' ?></dd>
                    <dt>Зарегистрирован</dt>
                    <dd><?= date('Y-m-d H:i',$user->created_at+3*3600) ?></dd>
                    <dt>Последние изменения профиля</dt>
                    <dd><?= date('Y-m-d H:i',$user->updated_at+3*3600) ?></dd>
                </dl>
            </div>
            <div class="box-footer">
                <a href="/profile/edit" class="btn btn-primary btn-flat">Изменить данные</a>
                <a href="/profile/edit-password" class="btn btn-warning btn-flat">Изменить пароль</a>
            </div>
        </div>
    </div>
</div>
