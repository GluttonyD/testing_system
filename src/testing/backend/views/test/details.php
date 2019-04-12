<?php
/**
 * @var \yii\web\View $this
 * @var \common\models\Test $test
 * @var \common\models\Question[] $questions
 */
$this->title = 'Информация о тесте';
?>
<div id="test-details" data-access="1" class="row">
    <div class="col-md-3 col-xs-3">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Информация о тесте</h3>
            </div>
            <div class="box-body">
                <dl>
                    <dt>Название теста</dt>
                    <dd><?= $test->name ?></dd>
                    <dt>Автор теста</dt>
                    <dd><?= $test->author->username ?></dd>
                    <dt>Время создания</dt>
                    <dd><?= date("d-m-Y H:i", $test->created_at + 3 * 3600) ?></dd>
                </dl>
            </div>
            <div class="box-footer">
                <a id="generate-test-pdf" class="btn btn-app" href="/test/generate-pdf?test_id=<?= $test->id ?>"><i
                            class="fa fa-file-pdf-o"></i>PDF</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Вопросы теста</h3>
            </div>
            <div class="box-body">
                <div id="test-details-questions" class="box-group">
                    <?php foreach ($questions as $question) { ?>
                        <div class="panel box box-warning">
                            <div class="box-header">
                                <h4 class="box-title"><a data-toggle="collapse" data-parent="#accordion"
                                                         href="#collapse-<?= $question->id ?>" aria-expanded="false"
                                                         class="collapsed">
                                        <?= $question->text ?>
                                    </a></h4>
                            </div>
                            <div id="collapse-<?= $question->id ?>" class="panel-collapse collapse" aria-expanded="true"
                                 style="height: 0">
                                <div class="box-body">
                                    <ol>
                                        <?php foreach ($question->answers as $answer) { ?>
                                            <li><?= $answer->text ?><?= ($answer->is_right) ? '<span class="fa fa-check"></span> ' : null ?></li>
                                        <?php } ?>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div id="test-details-pagination" class="box-footer">
                <?=
                \yii\widgets\LinkPager::widget([
                    'pagination' => $pages
                ]) ?>
                <!--                <button id="previous-test-question" class="btn btn-danger"><<</button>-->
                <!--                <button id="next-test-question" class="btn btn-success">>></button>-->
            </div>
        </div>
    </div>
</div>
