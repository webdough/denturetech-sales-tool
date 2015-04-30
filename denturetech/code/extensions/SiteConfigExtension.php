<?php

/**
 * Class SiteConfigExtension
 */
class SiteConfigExtension extends DataExtension {

    private static $db = array(
        'ShowAssetAdmin' => 'Boolean',
        'ShowSecurityAdmin' => 'Boolean',
        'ShowReportAdmin' => 'Boolean',
        'ShowHelpLink' => 'Boolean'
    );

    private static $has_one = array(
        'PriceListLink' => 'SiteTree'
    );

    private static $defaults = array(
        'ShowAssetAdmin' => true,
        'ShowSecurityAdmin' => true,
        'ShowReportAdmin' => false,
        'ShowHelpLink' => false
    );

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields) {

        /* =========================================
         * Settings
         =========================================*/

        if (!$fields->fieldByName('Root.Settings')){
            $fields->addFieldToTab('Root', new TabSet('Settings'));
        }

        /* =========================================
         * Links
         =========================================*/

        $fields->findOrMakeTab('Root.Settings.Links', 'Links');
        $fields->addFieldsToTab('Root.Settings.Links',
            array(
                new HeaderField('', 'Links'),
                new LiteralField('',
                    '<p>Links to various pages on the site that\'re used by the templates.</p>'
                ),
                new TreeDropdownField('PriceListLinkID', 'Price List', 'SiteTree'),
            )
        );

        /* =========================================
         * CMS
         =========================================*/

        $fields->findOrMakeTab('Root.Settings.CMS', 'CMS');
        $fields->addFieldsToTab('Root.Settings.CMS',
            array(
                new HeaderField('', 'CMS Menu'),
                new CheckboxField('ShowAssetAdmin'),
                new CheckboxField('ShowSecurityAdmin'),
                new CheckboxField('ShowReportAdmin'),
                new CheckboxField('ShowHelpLink')
            )
        );

    }

}