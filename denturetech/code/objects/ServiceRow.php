<?php

/**
 * Class ServiceRow
 */
class ServiceRow extends ProductRow {

    private static $has_one = array (
        'ServiceTab' => 'ServiceTab'
    );

    /**
     * @return FieldList
     */
    public function getCMSFields() {
        $fields = FieldList::create(TabSet::create('Root'));

        $fields->addFieldToTab('Root.Main', new TextField('ColumnOne', 'Type'));
        $fields->addFieldToTab('Root.Main', new TextField('ColumnTwo', 'Service'));
        $fields->addFieldToTab('Root.Main', new TextField('ColumnThree', 'Code'));
        $fields->addFieldToTab('Root.Main', new CurrencyField('ColumnFour', 'Price'));

        return $fields;
    }

}