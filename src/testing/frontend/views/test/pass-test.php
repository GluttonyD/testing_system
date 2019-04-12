<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\models\PassTestForm $form
 */

$this->title = 'Прохождение теста';
$question_count = 0;
?>

<div class="row">
    <div class="col-md-3 col-xs-3">
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Информация о тесте</h3>
            </div>
            <div class="box-body">
                <dl>
                    <dt>Название теста</dt>
                    <dd><?= $form->test_questions->name ?></dd>
                    <dt>Автор теста</dt>
                    <dd><?= $form->test_questions->author->username ?></dd>
                    <dt>Время создания</dt>
                    <dd><?= date("d-m-Y H:i", $form->test_questions->created_at + 3 * 3600) ?></dd>
                </dl>
            </div>
            <div class="box-footer">
                Не забудьте ответить на вопросы
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xs-9">
        <form id="pass-test-form" method="post" action="/test/pass-test">
            <?= yii\helpers\Html:: hiddenInput(\Yii:: $app->getRequest()->csrfParam, \Yii:: $app->getRequest()->getCsrfToken(), []) ?>
            <input id="pass-test-id" type="hidden" value="<?= $form->test_questions->id ?>"
                   name="PassTestForm[test][id]">
            <div id="pass-test-box" style="display: block">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Вопросы теста</h3>
                        <div class="progress">
                            <div id="test-progress" class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar"
                                 aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                            </div>
                        </div>
                    </div>
                    <div id="pass-test-questions" class="box-body">
                        <?php foreach ($form->test_questions->questions as $question) { ?>
                            <div id="question-number-<?= $question_count ?>"
                                 style="display:<?= ($question_count == 0) ? 'block' : 'none' ?>">
                                <input type="hidden" value="<?= $question->text ?>" name="PassTestForm[test][questions][<?= $question->id ?>][text]">
                                <h4><?= $question->text ?></h4>
                                <?php foreach ($question->answers as $answer) { ?>
                                    <div class="row">
                                        <div class="col-md-9" style="padding-top: 3%">
                                            <b><?= $answer->text ?></b>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label for="answer-is-right">Правильный?</label>
                                            <select class="form-control select2 select2-hidden-accessible"
                                                    style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                    name="PassTestForm[test][questions][<?= $question->id ?>][answers][<?= $answer->id ?>][is_right]">
                                                <option selected="selected" value="1">Да</option>
                                                <option value="0">Нет</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <?php
                            $question_count++;
                        }
                        ?>
                    </div>
                    <div id="question_count" data-count="<?= $question_count ?>"></div>
                    <div class="box-footer">
                        <button id="previous-question" class="btn btn-danger">Предыдущий вопрос</button>
                        <button id="next-question" class="btn btn-success">Следующий вопрос</button>
                        <button id="pass-test" class="btn btn-info">Закончить тест</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

