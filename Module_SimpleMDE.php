<?php
namespace GDO\SimpleMDE;

use GDO\Core\GDO_Module;
use GDO\HTML\Decoder;
use GDO\Javascript\Module_Javascript;
use GDO\UI\GDT_Message;

/**
 * SimpleMDE integration module.
 *
 * @version 7.0.2
 * @since 7.0.1
 * @author gizmore
 */
final class Module_SimpleMDE extends GDO_Module
{

	public string $license = 'MIT';

	##############
	### Module ###
	##############
	public function getDependencies(): array
	{
		return [
			'HTML',
		];
	}

	public function getFriendencies(): array
	{
		return [
			'Javascript',
			'JQuery',
		];
	}

	public function getLicenseFilenames(): array
	{
		return [
			'MIT.LICENSE',
		];
	}

	# ###########
	# ## Init ###
	# ###########
	public function onModuleInit(): void
	{
		GDT_Message::addDecoder('SimpleMDE', [Decoder::class, 'purify']);
	}

	public function onLoadLanguage(): void
	{
		$this->loadLanguage('lang/simplemde');
	}

	public function onIncludeScripts(): void
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

	##############
	### Config ###
	##############

	#############
	### Hooks ###
	#############
}
