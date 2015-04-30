<?php

/**
 * Class ProductRow
 */
class ProductRow extends DataObject {

    private static $db = array (
        'SortOrder' => 'Int',
        'ColumnOne' => 'Varchar(255)',
        'ColumnTwo' => 'Varchar(255)',
        'ColumnThree' => 'Varchar(255)',
        'ColumnFour' => 'Currency',
        'ProductPage' => 'Varchar'
    );

    private static $singular_name = 'Row';
    private static $plural_name = 'Rows';

    private static $has_one = array (
        'ProductTab' => 'ProductTab'
    );

    private static $summary_fields = array(
        'ColumnTwo' => 'Product',
        'ColumnOne' => 'Type',
        'ColumnThree' => 'Code',
        'ColumnFour' => 'Price',
    );

    private static $default_sort = 'SortOrder';

    //public function getCMSValidator() {
    //    return new RequiredFields(array());
    //}

    /**
     * @return FieldList
     */
    public function getCMSFields() {
        $fields = FieldList::create(TabSet::create('Root'));

        $fields->addFieldToTab('Root.Main', new TextField('ColumnOne', 'Type'));
        $fields->addFieldToTab('Root.Main', new TextField('ColumnTwo', 'Product'));
        $fields->addFieldToTab('Root.Main', new TextField('ColumnThree', 'Code'));
        $fields->addFieldToTab('Root.Main', new CurrencyField('ColumnFour', 'Price'));
        $fields->addFieldToTab('Root.Main', $productPage = new TreeDropdownField('ProductPage', 'Product', 'SiteTree'));
        $productPage->setRightTitle('Used on the Product Page to display the price. If this is not set, the link will default to the Price List page.');

        return $fields;
    }

}