<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 15.03.2019
 * Time: 16:31
 */

namespace backend\controllers;


use yii\helpers\VarDumper;
use yii\web\Controller;
use Yii;
use moonland\phpexcel\Excel;
use dastanaron\translit\Translit;

class TestingController extends Controller
{
    public function actionTest(){
        $filename='files/test.xls';
        $data = Excel::import($filename,[
            'setFirstRecordAsKeys' => true, // if you want to set the keys of record column with first record, if it not set, the header with use the alphabet column on excel.
        ]);
        $str = 'Привет МИР';

        $translit = new Translit();

        echo $translit->translit($str, true, 'ru-en');
//        VarDumper::dump($data[0]['name']);
    }
}