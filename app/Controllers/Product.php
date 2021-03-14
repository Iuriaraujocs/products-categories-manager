<?php

namespace app\Controllers;

use system\mvc\BaseController;

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
        return $this->view('addProduct');
	}

    public function addCategory()
	{
        return $this->view('addCategory');
	}


}


