<?php

/**
 * Class ProductPage
 */
class ProductPage extends Page {

    private static $icon = 'denturetech/images/icons/box-small.png';

    private static $db = array(
        'GalleryThumbnailText' => 'Varchar',
        'BenefitsContent' => 'HTMLText'
    );

    public static $has_one = array(
        'ThumbnailImage' => 'Image'
    );

    public static $many_many = array(
        'Images' => 'Image'
    );

    private static $can_be_root = false;
    private static $allowed_children = array('');

    private static $defaults = array(
        'GalleryThumbnailText' => 'View Gallery',
        'BackgroundColor' => '#b7e2fa'
    );

    //public function getCMSValidator() {
    //    return new RequiredFields(array());
    //}

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', $content = new HtmlEditorField('Content'), 'Metadata');
        $content->setRows(15);

        $fields->addFieldToTab('Root.Main', $contentImage = new UploadField('ThumbnailImage', 'Thumbnail'), 'Content');
        $contentImage->setRightTitle('Re-sized to 360px by 360px');
        $contentImage->setFolderName('Uploads/products/thumbnails');

        /* =========================================
         * Benefits
         =========================================*/

        $fields->addFieldToTab('Root.Main', new HeaderField('', 'Benefits', 4), 'Metadata');
        $fields->addFieldToTab('Root.Main', $benefitsContent = new HtmlEditorField('BenefitsContent', 'Content'), 'Metadata');
        $benefitsContent->setRows(15);

        /* =========================================
         * Gallery
         =========================================*/

        $fields->addFieldToTab('Root.Gallery', new HeaderField('', 'Gallery'));
        $fields->addFieldToTab('Root.Gallery', new LiteralField('',
            '<div class="message"><p><strong>Note:</strong> Images are re-sized to 1140px by 641px.</p></div>'
        ));
        $fields->addFieldToTab('Root.Gallery', new TextField('GalleryThumbnailText', 'Thumbnail Image Text'));
        $fields->addFieldToTab('Root.Gallery', $images = new UploadField('Images', 'Images', $this->Images()));
        $images->setFolderName('Uploads/products/gallery');

        return $fields;
    }

    /**
     * Get the first image from the gallery
     * to be displayed as the thumbnail for the gallery link
     *
     * @return mixed
     */
    public function getFirstImage() {
        return $this->Images()->First();
    }

    /**====================================================
     * Header Button
    ====================================================*/

    /**
     * @return bool|string
     */
    public function getHeaderButtonText() {
        if($parent = $this->Parent()) {
            return 'Go Back to '.$parent->MenuTitle;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function getHeaderButtonLink() {
        if($parent = $this->Parent()) {
            return $parent;
        }
        return false;
    }

    /**
     * @return bool|string
     */
    public function GalleryHeaderButtonText() {
        return 'Go Back to '.$this->MenuTitle;
    }

    /**
     * @return bool
     */
    public function GalleryHeaderButtonLink() {
        return $this;
    }

    /**====================================================
     * Price
    ====================================================*/

    /**
     * Get the price dictated by the Product/ServiceRow
     *
     * @return DataList
     */
    public function getPrice() {
        $product = ProductRow::get()->filter(array(
            'ProductPage' => $this->ID
        ))->first();
        if(!$product) {
            $product = ServiceRow::get()->filter(array(
                'ProductPage' => $this->ID
            ))->first();
        }
        return $product;
    }

}

/**
 * Class ProductPage_Controller
 */
class ProductPage_Controller extends Page_Controller {

    private static $allowed_actions = array(
        'gallery'
    );

    /**
     * Create a page that displays all of the images.
     *
     * @return array
     */
    public function gallery(){
        $images = $this->Images();
        if($images){
            $class = $this->ClassName . "_Controller";
            $controller = new $class($this);
            return $controller->customise(array(
                'Images' => $images,
                'HeaderButtonText' => $this->GalleryHeaderButtonText(),
                'HeaderButtonLink' => $this->GalleryHeaderButtonLink()
            ))->renderWith(array('ProductPage_Gallery', 'Page'));
        }
        return array();
    }

}