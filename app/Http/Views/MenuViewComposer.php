<?php
namespace App\Http\Views;

use App\Module;

class MenuViewComposer
{
	// private $module;

	// public function __construct(Module $module)
	// {
	// 	$this->module = $module;
	// }

	public function compose($view)
	{
		$roleUser = auth()->user()->role;

        $modulesFiltered = [];

        foreach($roleUser->modules as $key => $module) {
					$modulesFiltered[$key]['name'] = $module->name;

					foreach($module->resources  as $resource) {
						if($resource->roles->contains($roleUser)) {

							$modulesFiltered[$key]['resources'][] = $resource;
						}
					}
				}

		return $view->with('modules', $modulesFiltered);
	}

}