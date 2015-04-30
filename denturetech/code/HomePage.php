<?php

/**
 * Class HomePage
 */
class HomePage extends Page {

    private static $icon = 'denturetech/images/icons/home.png';

    private static $db = array(
        'HeaderButtonText' => 'Varchar',
        'GridButtonTitle' => 'Varchar',
        'GridButtonText' => 'Varchar'
    );

    private static $has_one = array(
        'HeaderButtonLink' => 'SiteTree',
        'GridButtonLink' => 'SiteTree'
    );

    /**
     * @return FieldList
     */
    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->removeByName('Content');

        /* =========================================
         * Header Button
         =========================================*/

        $fields->addFieldToTab('Root.Main', new HeaderField('', 'Header Button', 4), 'Metadata');
        $fields->addFieldToTab('Root.Main', new LiteralField('',
            '<p>Displayed in the header to the right of the Logo.</p>'
        ), 'Metadata');
        $fields->addFieldToTab('Root.Main', new TextField('HeaderButtonText', 'Button Text'), 'Metadata');
        $fields->addFieldToTab('Root.Main', new TreeDropdownField('HeaderButtonLinkID', 'Link', 'SiteTree'), 'Metadata');

        /* =========================================
         * Survey Button
         =========================================*/

        $fields->addFieldToTab('Root.Main', new HeaderField('', 'Grid Button', 4), 'Metadata');
        $fields->addFieldToTab('Root.Main', new LiteralField('',
            '<p>Displayed as the last item in the Product Category grid.</p>'
        ), 'Metadata');
        $fields->addFieldToTab('Root.Main', new TextField('GridButtonTitle', 'Title'), 'Metadata');
        $fields->addFieldToTab('Root.Main', new TextField('GridButtonText', 'Button Text'), 'Metadata');
        $fields->addFieldToTab('Root.Main', new TreeDropdownField('GridButtonLinkID', 'Link', 'SiteTree'), 'Metadata');

        return $fields;
    }

    /**
     * Get the Category Holder of the site
     * so that this page can loop through it's children.
     *
     * @return DataObject
     */
    public function getCategoryHolder() {
        return ProductCategoryHolder::get()->first();
    }

}

/**
 * Class HomePage_Controller
 */
class HomePage_Controller extends Page_Controller {}