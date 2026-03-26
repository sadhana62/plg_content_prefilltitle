<?php

namespace Joomla\Plugin\Content\Prefilltitle\Extension;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Plugin\CMSPlugin;
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

	public function onContentPrepareForm(Form $form, $data): void
	{
		$app = Factory::getApplication();

		if (!$app->isClient('administrator')) {
			return;
		}

		if ($form->getName() !== 'com_content.article') {
			return;
		}

		$document = $app->getDocument();
		$wa = $document->getWebAssetManager();

		$wa->registerAndUseScript(
			'plg_content_prefilltitle.admin',
			'plg_content_prefilltitle/admin-prefilltitle.js',
			[],
			['type' => 'module']
		);
	}

	public function onAjaxPrefilltitle()
	{
		return [
			'title' => (string) $this->params->get('default_title', '')
		];
	}
}