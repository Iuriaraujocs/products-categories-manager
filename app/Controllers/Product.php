<?php

namespace app\Controllers;

use system\mvc\BaseController;
use app\Models\Product as ProductModel;
use app\Models\Category;

class Product extends BaseController
{
    /** tela de dashboard */
	public function index()
	{
        $product = new ProductModel();
        $productsAll = $product->all();
        return $this->view('dashboard',['product' => $productsAll, 'countProducts' => count($productsAll)]);
	}

    /** tela de produtos */
    public function products()
	{
        $product = new ProductModel();
        return $this->view('products',['product' => $product->getAll()]);
	}

    /** tela de categorias */
    public function categories()
	{
        $category = new Category();
        return $this->view('categories',['category' => $category->all()]);
	}

    /** tela de cadastro de produtos */
    public function addProduct()
	{
        //Se acessado via ajax e post
        if($this->isPost() && $this->isXmlHttpRequest()){
            try {
                list($product,$categories) = $this->getProductsInfo();
                
                list($price,$amount) = $this->validateForm($product->getColumns()['price'],$product->getColumns()['amount']);
                if(!$price)  return $this->errorResponse('Formato Inválido para preço!');
                if(!$amount) return $this->errorResponse('Formato Inválido para quantidade!');
                
                /** Garante que o produto já está cadastrado */
                if($product->verifyIfCodeExist()) return $this->errorResponse('SKU de produto já cadastrado!');
               
                /** Salva o produto e seu relacionamento com as categorias */
                $product->save();
                $product->addProductsVsCategories($categories, $product->getColumns()['sku']);
                app_log('Produto Salvo com sucesso');
                
                return $this->jsonResponse(['msg' => 'Produto cadastrado com sucesso!']);

            } catch (\Exception $e) {
                app_log('Error no cadastro de produtos -> ' . $e->getMessage() ,'ERROR');
                return $this->errorResponse('Error no processamento dos dados: ' . $e->getMessage());
            }
        }

        //Se acessado pelo browser
        $category = new Category();
        return $this->view('addProduct', ['category' => $category->getAll()]);
	}

    /** tela de cadastro de categorias */
    public function addCategory()
	{
        if($this->isPost() && $this->isXmlHttpRequest()){
            try {
                $category = new Category();
                $category->code = $this->request('code');
                $category->name = $this->request('name');

                if($category->verifyIfCodeExist()) return $this->errorResponse('Código de categoria já cadastrada!');
               
                $category->save();
                app_log('Categoria Salva com sucesso');
                return $this->jsonResponse(['msg' => 'Categoria cadastrada com sucesso!']);

            } catch (\Exception $e) {
                app_log('Error no cadastro de categorias -> ' . $e->getMessage() ,'ERROR');
                return $this->errorResponse('Error no processamento dos dados: ' . $e->getMessage());
            }
                  
            return $this->jsonResponse($category);
        }
        
        return $this->view('addCategory');
	}

    /** envia as imagens dos produtos dinamicamente, para pode ser usada no navegador */
    public function sendImage($id)
	{
        $id = $id[0];
        $product = new ProductModel();
        
        $file = $product->addColumns(['img_path'])
        ->where('id',$id)->first()['img_path'];

        $this->sendImageResponse($file);
	}

    /** obtém as informações do produto a ser cadastrado */
    private function getProductsInfo(){

        $price = str_replace([','],'.', $this->request('price'));
        
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

    /** valida se o preço e a quantidade são númericos */
    private function validateForm($price, $amount)
    {
        $price = is_numeric($price) ? true : false;
        $amount = is_numeric($amount) ? true : false;
        return [$price,$amount];
    }

}


