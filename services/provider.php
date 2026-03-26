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
				$plugin = new Prefilltitle(
					$container->get(DispatcherInterface::class),
					(array) PluginHelper::getPlugin('content', 'prefilltitle')
				);

				$plugin->setApplication($container->get(\Joomla\CMS\Application\CMSApplicationInterface::class));
				$plugin->setDatabase($container->get(\Joomla\Database\DatabaseInterface::class));

				return $plugin;
			}
		);
	}
};