<?php

/**
 * Class ProductTab
 */
class ProductTab extends DataObject {

    private static $db = array (
        'SortOrder' => 'Int',
        'Title' => 'Varchar'
    );

    private static $singular_name = 'Tab';
    private static $plural_name = 'Tabs';

    private static $has_one = array (
        'Page' => 'Page'
    );

    private static $has_many = array (
        'Rows' => 'ProductRow'
    );

    //private static $summary_fields = array();

    private static $default_sort = 'SortOrder';

    //public function getCMSValidator() {
    //    return new RequiredFields(array());
    //}

    /**
     * @return FieldList
     */
    public function getCMSFields() {
        $fields = FieldList::create(TabSet::create('Root'));

        $fields->addFieldToTab('Root.Main', new TextField('Title'));

        /* =========================================
         * Rows
         =========================================*/

        $config = GridFieldConfig_RelationEditor::create(10);
        $config->addComponent(new GridFieldSortableRows('SortOrder'))
            ->addComponent(new GridFieldDeleteAction());
        $gridField = new GridField(
            'Rows',
            'Rows',
            $this->Rows(),
            $config
        );
        $fields->addFieldToTab('Root.Main', $gridField);

        return $fields;
    }

}