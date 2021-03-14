<?php

namespace app\Models;

use system\mvc\BaseModel;
use app\Models\Category;

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
        
        if(is_array($idCategories)){
            foreach($idCategories as $idCategory) 
                $this->queryBuilder("INSERT INTO `{$this->database}`.`products_vs_categories` (id_category,id_product) VALUES (?,?)",[$idCategory,$idProduct]);
        }
        else  $this->queryBuilder("INSERT INTO `{$this->database}`.`products_vs_categories` (id_category,id_product) VALUES (?,?)",[$idCategories,$idProduct]);
    }

    public function getCategories($idProduct){
        $sql = "SELECT * FROM `{$this->database}`.`categories` c
                LEFT JOIN `{$this->database}`.`products_vs_categories` pc
                on  c.id = pc.id_category
                where pc.id_product = ?";

        return $this->selectApply($sql,[$idProduct]);
    }

    public function getAll(){
        $products = $this->all();

        foreach($products as &$product){
            $sql = "SELECT * FROM `{$this->database}`.`categories` c
                    LEFT JOIN `{$this->database}`.`products_vs_categories` pc
                    on  c.id = pc.id_category
                    where pc.id_product = ?";
    
            $product['categories'] = $this->selectApply($sql,[$product['id']]);
        }

        return $products;
    }
}