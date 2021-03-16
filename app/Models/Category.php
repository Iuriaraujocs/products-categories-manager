<?php

namespace app\Models;

use system\mvc\BaseModel;

class Category extends BaseModel
{
    protected $table = 'categories';

    public function __construct()
    {
        parent::__construct();
    }

    public function verifyIfCodeExist(){

       $exist =  $this->addColumns(['id'])
                ->where('code',$this->getColumns()['code'])
                ->first();

        return !empty($exist) ? true : false;
    }

    public function getall(){
        $aux = [];
        foreach($this->all() as &$register){
            $aux[$register['id']] = $register['name'];
        }
        return $aux;
    }
}