<?php

namespace MitsubishiMotors\ModelAdmins;

use MitsubishiMotors\DataObjects\FAQ;
use SilverStripe\Admin\ModelAdmin;

/**
 * Class FAQAdmin
 * @package MitsubishiMotors\ModelAdmins
 */
class FAQAdmin extends ModelAdmin
{
    /**
     * @var string
     */
    private static $menu_icon_class = 'font-icon-help-circled';

    /**
     * @var array
     */
    private static $managed_models = [
        FAQ::class
    ];

    /**
     * @var string
     */
    private static $url_segment = 'faqs';

    /**
     * @var string
     */
    private static $menu_title = 'FAQs';
}
