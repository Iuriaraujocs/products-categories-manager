<?php

namespace app;

use system\InitManager;

/**
 * Classe responsável por inicializar a aplicação 
 * a partir da URL utilizada no navegador 
 */
class Init extends InitManager
{
	/** relaciona uma URL amigável com uma controller */
	public function __construct()
	{
		$this->urlpatterns = array(
			'' => 'app\Controllers\Product',   //url, controller, action
            'dashboard' => 'app\Controllers\Product',   //url, controller, action
            'products' => 'app\Controllers\Product@products',
            'categories' => 'app\Controllers\Product@categories',
            'addProduct' => 'app\Controllers\Product@addProduct',
            'addCategory' => 'app\Controllers\Product@addCategory',
			);

		$this->run();
	}

}


