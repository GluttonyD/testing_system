<?php
/**
 * Created by PhpStorm.
 * User: Aritomo
 * Date: 10.03.2019
 * Time: 19:46
 */
namespace backend\models;

use yii\base\Model;
use common\models\Section;
use Yii;

class SectionForm extends Model
{
    public $name;

    /**
     * @var Section
     */
    private $_section;

    public function __construct($section_id=null)
    {
        parent::__construct();
        if($section_id){
            $this->_section=Section::find()->where(['id'=>$section_id])->one();
            $this->name=$this->_section->name;
        }
        else{
            $this->_section=new Section();
        }
    }

    public function rules()
    {
        return [
          ['name','required'],
          ['name','string'],
          ['name','validateName']
        ];
    }

    public function validateName($attribute,$params){
        $section=Section::find()->where(['name'=>$this->name])->all();
        if($section){
            $this->addError($attribute,'Раздел с таким именем уже существует');
        }
    }

    public function create(){
        if($this->validate()){
            $this->_section->name=$this->name;
            $this->_section->created_at=time();
            $this->_section->created_by=Yii::$app->user->getId();
            $this->_section->save();
            return true;
        }
        return false;
    }

    public function getSectionId(){
        if($this->_section){
            return $this->_section->id;
        }
        return null;
    }
}