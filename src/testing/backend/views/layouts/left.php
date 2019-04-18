<?php
/**
 * @var \common\models\User $user
 */
$user = Yii::$app->user->getIdentity();
?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= $user->username ?></p>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => [
                    ['label' => 'Меню', 'options' => ['class' => 'header']],
                    [
                        'label' => 'Тесты',
                        'icon' => 'check-circle',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Список тестов', 'icon' => 'check-circle', 'url' => ['/test/index']],
                            ['label' => 'Отложенные тесты', 'icon' => 'check-circle', 'url' => ['/delayed-test/index']],
                            ['label' => 'Пройденные тесты', 'icon' => 'check-circle', 'url' => ['/completed-test/index']],
                        ],
                    ],
                    [
                        'label' => 'Пользователи',
                        'icon' => 'user',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Список пользователей', 'icon' => 'users', 'url' => ['#']],
                            ['label' => 'Добавить из EXCEL', 'icon' => 'file-excel-o', 'url' => ['/user/add-user-from-excel']],
                            ['label' => 'Пройденные тесты', 'icon' => 'check-circle', 'url' => ['/completed-test/index']],
                        ],
                    ],
                    ['label' => 'Разделы', 'icon' => 'folder-o', 'url' => ['/section/index']],
                    ['label' => 'Вопросы', 'icon' => 'question', 'url' => ['/question/index']],
                ],

            ]
        ) ?>

    </section>

</aside>
