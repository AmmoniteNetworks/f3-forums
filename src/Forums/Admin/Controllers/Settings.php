<?php 
namespace Forums\Admin\Controllers;

class Settings extends \Admin\Controllers\BaseAuth 
{
	use \Dsc\Traits\Controllers\Settings;
	
	protected $layout_link = 'Forums/Admin/Views::settings/default.php';
	protected $settings_route = '/admin/forums/settings';
    
    protected function getModel()
    {
        $model = new \Forums\Models\Settings;
        return $model;
    }
}