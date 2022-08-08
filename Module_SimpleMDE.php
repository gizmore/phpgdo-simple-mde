<?php
namespace GDO\SimpleMDE;

use GDO\Core\GDO_Module;
use GDO\Javascript\Module_Javascript;

/**
 * SimpleMDE integration module.
 * 
 * @author gizmore
 * @version 7.0.1
 * @since 7.0.1
 */
final class Module_SimpleMDE extends GDO_Module
{
	public string $license = 'MIT';
	
	##############
	### Module ###
	##############
	public function onLoadLanguage() : void
	{
		$this->loadLanguage('lang/simplemde');
	}
	
	public function onIncludeScripts() : void
	{
		$minify = Module_Javascript::instance()->cfgMinifyJS();
		if ($minify === 'no')
		{
			$this->addBowerJS('simplemde/src/js/simplemde.js');
			$this->addBowerCSS('simplemde/src/css/simplemde.css');
		}
		else
		{
			$this->addBowerJS('simplemde/dist/simplemde.min.js');
			$this->addBowerCSS('simplemde/dist/simplemde.min.css');
		}
		$this->addJS('js/gdo-simplemde.js');
		$this->addCSS('css/gdo-simplemde.css');
	}
	
	public function getDependencies() : array
	{
		return [
			'Core',
		];
	}
	
	public function getFriendencies() : array
	{
		return [
			'Javascript', 'JQuery',
		];
	}
	
	public function getLicenseFilenames() : array
	{
		return [
			'MIT.LICENSE',
		];
	}
	
	##############
	### Config ###
	##############
	
	#############
	### Hooks ###
	#############
}
