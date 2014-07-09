<?php
namespace Forums\Admin;

class Routes extends \Dsc\Routes\Group
{
    public function initialize()
    {
        $this->setDefaults( array(
            'namespace' => '\Forums\Admin\Controllers',
            'url_prefix' => '/admin/forums' 
        ) );
        
        $this->addSettingsRoutes();
        
        $this->addCrudGroup( 'Posts', 'Post' );
        
        $this->addCrudGroup( 'Categories', 'Category', array(
            'datatable_links' => true,
            'get_parent_link' => true 
        ) );
        
        $this->add( '/categories/checkboxes', array(
            'GET',
            'POST' 
        ), array(
            'controller' => 'Categories',
            'action' => 'getCheckboxes' 
        ) );
    }
}