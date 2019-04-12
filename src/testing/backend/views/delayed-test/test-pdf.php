<?php
/**
 * @var \common\models\Test $test
 * @var \yii\web\View $this
 * @var \common\models\User $user
 */
$this->title = 'Тест';
?>

<h1>Тест "<?= $test->name ?>"</h1>
<h4>Ф.И.О проверяемого: <?= $user->username?></h4>
<ol>
<?php foreach ($test->questions as $question) { ?>
    <li><h4><?= $question->text ?></h4></li>
    <ol>
    <?php foreach ($question->answers as $answer) { ?>
        <li><?= $answer->text ?></li>
    <?php } ?>
    </ol>
<?php } ?>
</ol>
