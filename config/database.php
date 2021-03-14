<?php

/**
 * Configurações gerais do banco de dados
 */
return [

	'hostname' => app_get_env('HOSTNAME','localhost'),

    'port' => app_get_env('PORT','3306'),
	
	'database' => app_get_env('DATABASE','default-database'),
	
	'charset' => app_get_env('CHARSET','UTF-8'),
	
	'username' => app_get_env('USERNAME','root'),
	
	'password' => app_get_env('PASSWORD','01ica!'),

];