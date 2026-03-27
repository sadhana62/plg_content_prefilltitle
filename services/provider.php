<?php

defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\Plugin\Content\Prefilltitle\Extension\Prefilltitle;

return new class () implements ServiceProviderInterface {
	public function register(Container $container): void
	{
		$container->set(
			PluginInterface::class,
			function (Container $container) {
				return new Prefilltitle(
					$container->get(DispatcherInterface::class),
					(array) PluginHelper::getPlugin('content', 'prefilltitle')
				);
			}
		);
	}
};