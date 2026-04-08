<?php
/**
 * Updater class
 *
 * @package SG_AI_Studio
 */

namespace SG_AI_Studio\Updater;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

// Load the update checker.
require_once \SG_AI_Studio\DIR . '/vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';

/**
 * Autoupdater functions.
 */
class Updater {
	/**
	 * URL to the json file, containing information about the plugin.
	 *
	 * @var string
	 */
	const PLUGIN_JSON = 'https://aistudio.web-platform.net/updater/ai-studio/sg-ai-studio.json';

	/**
	 * The constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		$update_checker = PucFactory::buildUpdateChecker(
			self::PLUGIN_JSON,
			\SG_AI_Studio\DIR . '/sg-ai-studio.php',
			'sg-ai-studio'
		);
	}
}
