<?php

namespace system;

use system\Route;
use system\mvc\ViewControl;

class InitManager{

	public $urlpatterns;
	private $pageContent;

	private $routeDisplay = 'index';
	private $templateName = 'index.tpl';

	protected function run()
	{
		// $this->tmpManager();
		$this->pageContent = Route::getPage($this->urlpatterns);
		if(is_object($this->pageContent) || is_array($this->pageContent) ) echo json_encode($this->pageContent);
		else $this->viewControl();
	}

	private function viewControl(){
		$smartManager = new ViewControl();
		$smartManager->smartySettings();
		$smartManager->assign($this->routeDisplay, $this->pageContent);
		try {
			$smartManager->display($this->templateName);
		} catch (\SmartyException $e) {
		} catch (\Exception $e) {
		}
	}

}