<?php

namespace app\Controllers;

use system\mvc\BaseController;
use app\Models\Product as ProductModel;
use app\Models\Category;

class Product extends BaseController
{
	public function index()
	{
        $product = new ProductModel();

        return $this->view('dashboard',['product' => $product->all()]);
	}

    public function products()
	{
        $product = new ProductModel();
        return $this->view('products',['product' => $product->getAll()]);
	}

    public function categories()
	{
        $category = new Category();
        return $this->view('categories',['category' => $category->all()]);
	}

    public function addProduct()
	{
        //Se acessado via ajax e post
        if($this->isPost() && $this->isXmlHttpRequest()){
            try {
                list($product,$categories) = $this->getProductsInfo();
                
                /** Garante que o produto já está cadastrado */
                if($product->verifyIfCodeExist()) return $this->errorResponse('SKU de produto já cadastrado!');
               
                /** Salva o produto e seu relacionamento com as categorias */
                $product->save();
                $product->addProductsVsCategories($categories, $product->getColumns()['sku']);
                return $this->jsonResponse(['msg' => 'Produto cadastrado com sucesso!']);

            } catch (\Exception $e) {
                return $this->errorResponse('Error no processamento dos dados: ' . $e->getMessage());
            }
            return $this->jsonResponse(['teste'=>'enviou', 'teste2' => 'testou']);    
        }

        //Se acessado pelo browser
        $category = new Category();
        return $this->view('addProduct', ['category' => $category->getAll()]);
	}

    public function addCategory()
	{
        if($this->isPost() && $this->isXmlHttpRequest()){

            try {
                $category = new Category();
                $category->code = $this->request('code');
                $category->name = $this->request('name');

                if($category->verifyIfCodeExist()) return $this->errorResponse('Código de categoria já cadastrada!');
               
                $category->save();
                return $this->jsonResponse(['msg' => 'Categoria cadastrada com sucesso!']);

            } catch (\Exception $e) {
                return $this->errorResponse('Error no processamento dos dados: ' . $e->getMessage());
            }
                  
            return $this->jsonResponse($category);
        }
        
        return $this->view('addCategory');
	}

    public function sendImage($id)
	{
        $id = $id[0];
        $product = new ProductModel();
        
        $file = $product->addColumns(['img_path'])
        ->where('id',$id)->first()['img_path'];

        $this->sendImageResponse($file);
	}

    private function getProductsInfo(){
        $product = new ProductModel();
        $product->sku = $this->request('sku');
        $product->name = $this->request('name');
        $product->price = $this->request('price');
        $product->amount = $this->request('quantity');
        $product->description = $this->request('description');

        $imageInfo = app_upload_img('imgProduct');
        if(!$imageInfo) $product->img_path = APP_PATH . DS . 'resources' . DS . 'assets' . DS . 'images' . DS . 'empty_image.png';
        else $product->img_path = $imageInfo['filename'];

        $categories = $this->request('category');
        $categories = explode(',', $categories);
        
        return [$product,$categories];

    }

}


