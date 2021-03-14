<?php

namespace app\Models;

use system\mvc\BaseModel;

class Product extends BaseModel
{
    protected $table = 'products';

    public function __construct()
    {
        parent::__construct();
    }

    public function verifyIfCodeExist(){

        $exist =  $this->addColumns(['id'])
                 ->where('sku',$this->getColumns()['sku'])
                 ->first();
 
         return !empty($exist) ? true : false;
     }

     public function addProductsVsCategories($idCategories, $sku){

        $idProduct = $this->addColumns(['id'])
        ->where('sku',$sku)->first()['id'];
        
        foreach($idCategories as $idCategory) 
            $this->queryBuilder("INSERT INTO `{$this->database}`.`products_vs_categories` (id_categories,id_products) VALUES (?,?)",[$idCategory,$idProduct]);
     }
}