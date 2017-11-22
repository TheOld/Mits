<?php

/**
 * Non namespaced Page & controller, so any page in modules does not need to be
 * aware of our project specific namespacing
 */

use MitsubishiMotors\Pages\Page as HeydayPage;
use MitsubishiMotors\Pages\PageController as HeydayPageController;
use \SilverStripe\ORM\HiddenClass;

/**
 * Class Page
 */
class Page extends HeydayPage implements HiddenClass
{
    /**
     * @var bool
     */
    private static $hide_from_cms_tree = true;

    /**
     * @var string
     */
    private static $table_name = 'zzPage';
}

/**
 * Class PageController
 */
class PageController extends HeydayPageController
{

}
