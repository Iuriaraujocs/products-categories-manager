<?php

namespace app\Controllers;

use system\mvc\BaseController;
use system\mvc\BaseModel;

class Teste extends BaseController
{
	public function __construct()
	{
	}

	public function control()
	{
		echo 'entrou na action';
	}

	public function index()
	{
		$model = new BaseModel();
		
		// $model->create([
		// 	'name' => 'Iuri teste do orm',
		// 	'password' => '12345',
		// 	'email' => 'iuri@sasasas'
		// ]);

		// $GLOBALS['dbg_pdo'] = 1;

		$result = $model
					->addColumns(['name','password'])
					->where('password','1234')
					->where('name','%iuri%','like')
					->orderBy('name')
					->get();

		// $model->id = 8;
		// $model->name = 'Iuri pelo insert';
		// $model->email = 'email@iuripeloinsert';
		// $model->password = 'asasasssa2';
		print_r($result);
		// $model->save();
	}
}


