<?php

/**
 * Class ProductCategoryPage
 */
class ProductCategoryPage extends Page {

    private static $icon = 'denturetech/images/icons/box.png';

    private static $db = array(
        'ContentButtonText' => 'Varchar'
    );

    private static $has_one = array(
        'ThumbnailImage' => 'Image',
        'ContentImage' => 'Image',
        'ContentButtonLink' => 'SiteTree'
    );

    private static $can_be_root = false;
    private static $allowed_children = array(
        'ProductCategoryPage',
        'ProductPage'
    );

    //public function getCMSValidator() {
    //    return new RequiredFields(array());
    //}

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', $contentImage = new UploadField('ThumbnailImage', 'Thumbnail'), 'Content');
        $contentImage->setRightTitle('Thumbnails are only displayed if this page is a child of another Product Category. Re-sized to 375px by 375px');
        $contentImage->setFolderName('Uploads/categories/thumbnails');

        /* =========================================
         * Content
         =========================================*/

        $fields->addFieldToTab('Root.Main', new HeaderField('', 'Content'), 'Content');
        $fields->addFieldToTab('Root.Main', new LiteralField('',
            '<p>Displayed above the Category/Product grid as text, and an image with a button.</p>'
        ), 'Content');
        $fields->addFieldToTab('Root.Main', $content = new HtmlEditorField('Content', 'Content'), 'Metadata');
        $content->setRows(20);
        $fields->addFieldToTab('Root.Main', $contentImage = new UploadField('ContentImage', 'Image'), 'Metadata');
        $contentImage->setFolderName('Uploads/categories/content');
        $fields->addFieldToTab('Root.Main', new HeaderField('', 'Button (optional)', 4), 'Metadata');
        $fields->addFieldToTab('Root.Main', new LiteralField('',
            '<p>Displayed over top of the Content Image.</p>'
        ), 'Metadata');
        $fields->addFieldToTab('Root.Main', new TextField('ContentButtonText', 'Text'), 'Metadata');
        $fields->addFieldToTab('Root.Main', new TreeDropdownField('ContentButtonLinkID', 'Link', 'SiteTree'), 'Metadata');

        return $fields;
    }

    /**====================================================
     * Header Button
    ====================================================*/

    /**
     * @return string
     */
    public function getHeaderButtonText() {
        return 'Go Back Home';
    }

    /**
     * @return DataObject
     */
    public function getHeaderButtonLink() {
        return HomePage::get()->first();
    }

}

/**
 * Class ProductCategoryPage_Controller
 */
class ProductCategoryPage_Controller extends Page_Controller {}