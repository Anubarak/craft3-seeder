<?php
/**
 * Seeder plugin for Craft CMS 3.x
 *
 * Seeder
 *
 * @link      https://studioespresso.co
 * @copyright Copyright (c) 2018 studioespresso
 */

namespace studioespresso\seeder\controllers;

use craft\elements\Entry;
use craft\elements\User;
use studioespresso\seeder\models\SeederEntryModel;
use studioespresso\seeder\records\SeederAssetRecord;
use studioespresso\seeder\records\SeederEntryRecord;
use studioespresso\seeder\records\SeederUserRecord;
use studioespresso\seeder\Seeder;

use Craft;
use craft\web\Controller;

/**
 * @author    studioespresso
 * @package   Seeder
 * @since     1.0.0
 */
class SeederController extends Controller
{
	// Public Methods
    // =========================================================================

    /**
     * @return mixed
     */
    public function actionIndex()
    {
        $data = [];
        $sections = Craft::$app->getSections();
        foreach($sections->getAllSections() as $section) {
        	$seededEntries = SeederEntryRecord::findAll( [
        		    'section' => $section->id
		        ] );
	        if(count($seededEntries)) {
	        	$data['sections'][$section->id]['id'] = $section->id;
	        	$data['sections'][$section->id]['name'] = $section->name;
	        	$data['sections'][$section->id]['count'] = count($seededEntries);
	        }
        }

        $seededAssets = SeederAssetRecord::find();
        if($seededAssets->count()) {
        	$data['assets']['count'] = $seededAssets->count();
        }

        $seededUsers = SeederUserRecord::find();
        if($seededUsers->count()) {
            $data['users']['count'] = $seededUsers->count();
        }


        return $this->renderTemplate('seeder/_index', [ 'data' => $data]);
    }

    public function actionClean() {
    	$data = Craft::$app->request->post('data');
		if($data) {
			if(!empty($data['sections'])) {
				foreach($data['sections'] as $sectionId) {
					Seeder::$plugin->weeder->entries($sectionId);
				}
			}
			if(!empty($data['assets'])) {
				Seeder::$plugin->weeder->assets();
			}
            if(!empty($data['users'])) {
                Seeder::$plugin->weeder->users();
            }
		}
		return $this->redirectToPostedUrl();
    }

}
