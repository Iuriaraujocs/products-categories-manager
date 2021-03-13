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
			'' => 'app\Controllers\Teste',   //url, controller, action
			);

		$this->run();
	}

}


