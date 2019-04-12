<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/select2.css',
        'css/pass-test.css',
    ];
    public $js = [
        'js/select.js',
        'js/select2.js',
        'js/question/answers.js',
        'js/question/index.js',
        'js/test/create.js',
        'js/question/create.js',
        'js/delayed-test/pass-test.js',
        'js/test/details.js',
        'js/user/user-excel.js',
        'js/section/index.js',
        'js/completed-test/index.js',
        'js/test/index.js',

    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
