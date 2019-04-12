<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 02.04.2019
 * Time: 18:24
 */

namespace backend\models;


use common\models\User;
use yii\base\Model;
use moonland\phpexcel\Excel;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
use dastanaron\translit\Translit;
use Yii;

class ExcelParseForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $excel;

    public function rules()
    {
        return [
            ['excel','required']
        ];
    }

    public function parse()
    {
        if ($this->validate()) {
            Yii::debug($this->excel);
            $this->excel->saveAs('files/' . $this->excel->name . '.' . $this->excel->extension);
            /**
             * @var array $data
             */
            $data = Excel::import('files/' . $this->excel->name . '.' . $this->excel->extension, [
                'setFirstRecordAsKeys' => true,
            ]);
            foreach ($data as $item){
                /**
                 * @var User $user
                 */
                $user=new User();
                $translit=new Translit();
                $item['surname']=$translit->translit($item['surname']);
                $item['name']=$translit->translit($item['name']);
                $user->username=$item['surname'][0].$item['name'];
                $pass=rand(1000,9999);
                $user->password_hash=Yii::$app->security->generatePasswordHash($pass);
                $user->auth_key=$pass;
                $user->save();
            }
            return true;
        }
        Yii::debug($this->errors);
    }
}