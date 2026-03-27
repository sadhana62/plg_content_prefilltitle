<?php

namespace Joomla\Plugin\Content\Prefilltitle\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Event\Model\PrepareFormEvent;
use Joomla\CMS\Event\Plugin\AjaxEvent;
use Joomla\Event\SubscriberInterface;

final class Prefilltitle extends CMSPlugin implements SubscriberInterface
{
	protected $autoloadLanguage = true;

	public static function getSubscribedEvents(): array
	{
		return [
			'onContentPrepareForm' => 'onContentPrepareForm',
			'onAjaxPrefilltitle'   => 'onAjaxPrefilltitle',
		];
	}

	public function onContentPrepareForm(PrepareFormEvent $event): void
	{
		$app = Factory::getApplication();
		$form = $event->getForm();

		if (!$app->isClient('administrator')) {
			return;
		}

		if ($form->getName() !== 'com_content.article') {
			return;
		}

		$document = $app->getDocument();
		$document->addScript(
			'../media/plg_content_prefilltitle/js/admin-prefilltitle.js',
			[],
			['type' => 'module']
		);
	}

	public function onAjaxPrefilltitle(AjaxEvent $event): void
	{
		$event->addResult([
			'title' => (string) $this->params->get('default_title', '')
		]);
	}
}

?>