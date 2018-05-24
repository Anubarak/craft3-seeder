<?php
/**
 * Seeder plugin for Craft CMS 3.x
 *
 * Entries seeder for Craft CMS
 *
 * @link      https://studioespresso.co
 * @copyright Copyright (c) 2018 Studio Espresso
 */

namespace studioespresso\seeder;

use studioespresso\seeder\models\Settings;
use studioespresso\seeder\services\Entries as EntriesService;
use studioespresso\seeder\services\Products as ProductsService;
use studioespresso\seeder\services\Categories as CategoriesService;
use studioespresso\seeder\services\Weeder as WeederService;
use studioespresso\seeder\services\Users as UsersService;
use studioespresso\seeder\services\fields\Fields as FieldsService;
use studioespresso\seeder\services\fields\Redactor as RedactorService;
use studioespresso\seeder\services\fields\CkEditor as CkEditorService;
use studioespresso\seeder\services\fields\Supertable as SupertableService;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\console\Application as ConsoleApplication;
use craft\web\UrlManager;
use craft\events\RegisterUrlRulesEvent;

use yii\base\Event;

/**
 * Craft plugins are very much like little applications in and of themselves. We’ve made
 * it as simple as we can, but the training wheels are off. A little prior knowledge is
 * going to be required to write a plugin.
 *
 * For the purposes of the plugin docs, we’re going to assume that you know PHP and SQL,
 * as well as some semi-advanced concepts like object-oriented programming and PHP namespaces.
 *
 * https://craftcms.com/docs/plugins/introduction
 *
 * @author    Studio Espresso
 * @package   Seeder
 * @since     1.0.0
 * @property  WeederService weeder
 * @property  EntriesService  entries
 * @property  ProductsService products
 * @property  CategoriesService categories
 * @property  UsersService users
 * @property  FieldsService fields
 * @property  RedactorService redactor
 * @property  CkEditorService ckeditor
 * @property  SupertableService supertable
 * @property  Settings $settings
 * @method    Settings getSettings()
 */
class Seeder extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * Static property that is an instance of this plugin class so that it can be accessed via
     * Seeder::$plugin
     *
     * @var Seeder
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * To execute your plugin’s migrations, you’ll need to increase its schema version.
     *
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    public function init() {
	    parent::init();

	    self::$plugin = $this;

	    Event::on(
		    UrlManager::class,
		    UrlManager::EVENT_REGISTER_CP_URL_RULES,
		    function (RegisterUrlRulesEvent $event) {
			    $event->rules['seeder'] = 'seeder/seeder/index';
		    }
	    );

	    // Add in our console commands
	    if ( Craft::$app instanceof ConsoleApplication ) {
		    $this->controllerNamespace = 'studioespresso\seeder\console\controllers';
	    }
    }

    // Protected Methods
    // =========================================================================

    /**
     * Creates and returns the model used to store the plugin’s settings.
     *
     * @return \craft\base\Model|null
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }

}
