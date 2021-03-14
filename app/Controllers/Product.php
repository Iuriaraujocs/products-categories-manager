<?php

namespace app\Controllers;

use system\mvc\BaseController;
use app\Models\Product as ProductModel;
use app\Models\Category;

class Product extends BaseController
{
	public function index()
	{
        return $this->view('dashboard');
	}

    public function products()
	{
        return $this->view('products');
	}

    public function categories()
	{
        return $this->view('categories');
	}

    public function addProduct()
	{
        if($this->isPost() && $this->isXmlHttpRequest()){

            try {
                $product = new ProductModel();
                $product->sku = $this->request('sku');
                $product->name = $this->request('name');
                $product->price = $this->request('price');
                $product->amount = $this->request('quantity');
                $product->description = $this->request('description');

                $categories = $this->request('category');

                if($product->verifyIfCodeExist()) return $this->errorResponse('SKU de produto já cadastrado!');
               
                $product->save();
      
                $product->addProductsVsCategories($categories, $product->getColumns()['sku']);

                return $this->jsonResponse(['msg' => 'Produto cadastrado com sucesso!']);

            } catch (\Exception $e) {
                return $this->errorResponse('Error no processamento dos dados: ' . $e->getMessage());
            }
            return $this->jsonResponse(['teste'=>'enviou', 'teste2' => 'testou']);    
        }

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

    public function send()
	{
        $file = APP_PATH . '/resources/assets/images/menu-go-jumpers.png';
        $type = 'image/png';
        header('Content-Type:'.$type);
        header('Content-Length: ' . filesize($file));
        readfile($file);
	}

}


