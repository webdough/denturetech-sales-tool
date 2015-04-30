<?php

/**
 * Class ProductCategoryHolder
 */
class ProductCategoryHolder extends Page {

    private static $icon = 'denturetech/images/icons/box-share.png';

    private static $db = array();

    //private static $can_be_root = false;
    private static $allowed_children = array(
        'ProductCategoryPage'
    );

    //public function getCMSValidator() {
    //    return new RequiredFields(array());
    //}

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        /* =========================================
         * Fields
         =========================================*/

        return $fields;
    }

}

/**
 * Class ProductCategoryHolder_Controller
 */
class ProductCategoryHolder_Controller extends Page_Controller {}