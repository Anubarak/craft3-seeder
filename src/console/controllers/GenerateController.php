<?php
/**
 * Seeder plugin for Craft CMS 3.x
 *
 * Entries seeder for Craft CMS
 *
 * @link      https://studioespresso.co
 * @copyright Copyright (c) 2018 Studio Espresso
 */

namespace studioespresso\seeder\console\controllers;

use studioespresso\seeder\Seeder;

use Craft;
use studioespresso\seeder\services\Seeder_EntriesService;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Seeder for Craft CMS 3.x - by Studio Espresso
 *
 * This plugin allows you to quickly create dummy data that you can use while building your site.
 * Issues or feedback: https://github.com/studioespresso/craft3-seeder/issues
 *
 * @author    Studio Espresso
 * @package   Seeder
 * @since     1.0.0
 */
class GenerateController extends Controller
{
    // Public Methods
    // =========================================================================

    /**
     * Generates entries for the specified section
     *
     * The first line of this method docblock is displayed as the description
     * of the Console Command in ./craft help
     *
     * @return mixed
     */
    public function actionEntries($sectionId = null, $count = 20)
    {
        if($sectionId) {
		    $result = Seeder::$plugin->entries->generate($sectionId, $count);
            return $result;
        }
    }

	/**
	 * Generates categories for the specified group
	 *
	 * The first line of this method docblock is displayed as the description
	 * of the Console Command in ./craft help
	 *
	 * @return mixed
	 */
	public function actionCategories($groupId = null, $count = 20)
	{
		$result = Seeder::$plugin->categories->generate($groupId, $count);

		return $result;
	}

    /**
     * Generates users for the specified usergroup
     *
     * The first line of this method docblock is displayed as the description
     * of the Console Command in ./craft help
     *
     * @return mixed
     */
    public function actionUsers($groupId = null, $count = 5)
    {
        if (Craft::$app->getEdition() != Craft::Pro) {
            echo "Users requires your Craft install to be upgrade to Pro. You can trial this in the control panel\n";
            return;
        }
        $result = Seeder::$plugin->users->generate($groupId, $count);
        return $result;
    }

    public function actionProducts($type = null, $count = 5) {
        if(!Craft::$app->getPlugins()->isPluginEnabled('commerce')) {
            echo "Could not find Commerce plugin. Please make sure you have the plugin installed.\n";
        }
    }

    /**
     * Generates a set of elements predefined in your config/seeder.php
     *
     * The first line of this method docblock is displayed as the description
     * of the Console Command in ./craft help
     *
     * @return mixed
     */
    public function actionSet($name = 'default') {
        if(!array_key_exists($name, Seeder::$plugin->getSettings()->sets)) {
            echo "Set not found\n";
            return;
        }
        $settings = Seeder::$plugin->getSettings()->sets[$name];
        foreach($settings as $type => $option) {
            switch ($type) {
                case 'Users':
                    if(is_array($option)) {
                        foreach ($option as $group => $count) {
                            $result = Seeder::$plugin->users->generate($group, $count);
                            if($result) {
                                echo "Seeded " . $count . " entries in " . $result . "\n";
                            }
                        }
                    }
                    break;
                case 'Entries':
                    if(is_array($option)) {
                        foreach ($option as $section => $count) {
                            $result = Seeder::$plugin->entries->generate($section, $count);
                            if($result) {
                                echo "Seeded " . $count . " entries in " . $result . "\n";
                            }
                        }
                    }
                break;
            }
        }
    }
}
