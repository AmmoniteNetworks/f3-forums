<?php 

class ForumsBootstrap extends \Dsc\Bootstrap{
	protected $dir = __DIR__;
	protected $namespace = 'Forums';

	protected function runAdmin(){

		parent::runAdmin();
	}
	protected function runSite(){
		
	 \Dsc\System::instance()->get('theme')->registerViewPath( __dir__ . '/Site/Views/', 'Forums/Site/Views' );

		parent::runSite();
	}
}
$app = new CrmBootstrap();