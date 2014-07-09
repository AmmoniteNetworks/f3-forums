<?php

namespace Forums\Site;

/**
 * Group class is used to keep track of a group of routes with similar aspects (the same controller, the same f3-app and etc)
 */
class Routes extends \Dsc\Routes\Group{
	
	
	function __construct(){
		parent::__construct();
	}
	
	/**
	 * Initializes all routes for this group
	 * NOTE: This method should be overriden by every group
	 */
	public function initialize(){

		$this->setDefaults(
				array(
					'namespace' => '\Forums\Site\Controllers',
					'url_prefix' => '/forums'
				)
		);
		
		$this->add( '/', 'GET', array(
								'controller' => 'Forums',
								'action' => 'index'
								));
		
		$this->add( '/@catslug', 'GET', array(
				'controller' => 'Forum',
				'action' => 'read'
		));
	
		$this->add( '/@catslug/post/@postslug', 'GET', array(
				'controller' => 'Post',
				'action' => 'read'
		));
		
		$this->add( '/disqus/track', 'POST', array(
				'controller' => 'Post',
				'action' => 'track'
		));
		
	}
}