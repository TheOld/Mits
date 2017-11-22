<?php

namespace MitsubishiMotors\Extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;

/**
 * Class CustomSiteConfig
 * @package MitsubishiMotors\Extensions
 */
class CustomSiteConfig extends DataExtension
{
    /**
     * @var array
     */
    private static $db = [
        'AdminEmail' => 'Varchar(255)',
        'TwitterLink' => 'Varchar(255)',
        'FacebookLink' => 'Varchar(255)',
        'YoutubeLink' => 'Varchar(255)',
        'GooglePlusLink' => 'Varchar(255)',
        'InstagramLink' => 'Varchar(255)',
        'VehicleHubAuthToken' => 'Text',
        'VehicleHubRefreshToken' => 'Varchar(255)',
        'VehicleHubTokenExpires' => 'Varchar(255)',
        'GraphQLAuthToken' => 'Text',
        'GraphQLAuthTokenExpires' => 'Varchar(255)'
    ];

    /**
     * @param FieldList $fields
     * @return FieldList
     */
    public function updateCMSFields(FieldList $fields)
    {

        $fields->addFieldToTab('Root.Main', $tf = new TextField('AdminEmail', 'Administrator Email Address'));

        $fields->addFieldToTab('Root.Main', new TextField('TwitterLink', 'Twitter page link'));
        $fields->addFieldToTab('Root.Main', new TextField('FacebookLink', 'Facebook page link'));
        $fields->addFieldToTab('Root.Main', new TextField('YoutubeLink', 'YouTube page link'));
        $fields->addFieldToTab('Root.Main', new TextField('GooglePlusLink', 'GooglePlus page link'));
        $fields->addFieldToTab('Root.Main', new TextField('InstagramLink', 'Instagram page link'));

        return $fields;
    }
}
