<?php

/**
 * Class PriceListPage
 */
class PriceListPage extends Page {

    private static $icon = 'denturetech/images/icons/ui-list-box-blue.png';

    private static $db = array();

    private static $has_many = array(
        'ProductTabs' => 'ProductTab',
        'ServiceTabs' => 'ServiceTab'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        /* =========================================
         * Product Tabs
         =========================================*/

        $config = GridFieldConfig_RelationEditor::create(10);
        $config->addComponent(new GridFieldSortableRows('SortOrder'))
            ->addComponent(new GridFieldDeleteAction());
        $gridField = new GridField(
            'ProductTabs',
            'Tabs',
            $this->ProductTabsList(),
            $config
        );
        $fields->addFieldToTab('Root.Products', $gridField);

        /* =========================================
         * Service Tabs
         =========================================*/

        $config = GridFieldConfig_RelationEditor::create(10);
        $config->addComponent(new GridFieldSortableRows('SortOrder'))
            ->addComponent(new GridFieldDeleteAction());
        $gridField = new GridField(
            'ServiceTabs',
            'Tabs',
            $this->ServiceTabsList(),
            $config
        );
        $fields->addFieldToTab('Root.Services', $gridField);

        return $fields;
    }

    /**
     * Get all ProductTabs, since there's a weird interaction with
     * ServiceTabs displaying in the DataList
     *
     * TODO: Find out if this is a bug in Silverstripe.
     *
     * @return DataList
     */
    public function ProductTabsList() {
        return ProductTab::get()->filter(array(
            'ClassName' => 'ProductTab'
        ));
    }

    /**
     * Get all ServiceTabs, since there's a weird interaction with
     * ProductTabs displaying in the DataList
     *
     * @return DataList
     */
    public function ServiceTabsList() {
        return ServiceTab::get()->filter(array(
            'ClassName' => 'ServiceTab'
        ));
    }

    /**
     * @return string
     */
    public function getProductTabSize() {
        $percentage = (int)100 / $this->ProductTabsList()->count();
        $style = ' style="width: '.$percentage.'%"';
        return $style;
    }

    /**
     * @return string
     */
    public function getServiceTabSize() {
        $percentage = (int)100 / $this->ServiceTabsList()->count();
        $style = ' style="width: '.$percentage.'%"';
        return $style;
    }

}

/**
 * Class PriceListPage_Controller
 */
class PriceListPage_Controller extends Page_Controller {

    public function init() {
        parent::init();
        Requirements::javascript(BOWER_COMPONENTS_DIR.'/bootstrap-sass/assets/javascripts/bootstrap/tab.js');
    }

}