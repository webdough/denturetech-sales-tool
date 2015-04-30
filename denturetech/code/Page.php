<?php

/**
 * Class Page
 */
class Page extends SiteTree {

	private static $db = array(
        'BackgroundColor' => 'Varchar'
    );

	private static $has_one = array(
        'BackgroundImage' => 'Image'
    );

	/**
	 * @return FieldList
	 */
	public function getCMSFields() {
		$fields = parent::getCMSFields();

        $fields->removeByName('Slider');

        /* =========================================
         * Background
         =========================================*/

        $fields->addFieldToTab('Root.Background', new HeaderField('', 'Background'));
        $fields->addFieldToTab('Root.Background', new LiteralField('',
            '<p>The background image, and color for this page. Displayed in medium, and large screens.</p>'
        ));
        $fields->addFieldToTab('Root.Background', new LiteralField('',
            '<div class="message"><p><strong>Note:</strong> These fields are optional.</p></div>'
        ));
        $fields->addFieldToTab('Root.Background', new ColorField('BackgroundColor'));
        $fields->addFieldToTab('Root.Background', $backgroundImage = new UploadField('BackgroundImage'));
        $backgroundImage->setFolderName('Uploads/pages/backgrounds');

		return $fields;
	}

	/**
	 * @return FieldList
	 */
	public function getSettingsFields() {
		$fields = parent::getSettingsFields();
		$fields->removeByName('ShowInSearch');
		return $fields;
	}

    /**
     * @return bool|string
     */
    public function getBackground() {
        if($this->BackgroundImage()->ID || $this->BackgroundColor) {
            $html = new HTMLText();
            $style = ' style="';
            if($this->BackgroundImage()->ID) {
                $style .= 'background-image: url(\''.$this->BackgroundImage()->URL.'\');';
            }
            if($this->BackgroundColor) {
                $style .= 'background-color: '.$this->BackgroundColor.';';
            }
            $style .= '"';
            $html->setValue($style);
            return $html;
        }
        return false;
    }

}

/**
 * Class Page_Controller
 */
class Page_Controller extends ContentController {

	private static $allowed_actions = array ();

	public function init() {
		parent::init();
    }

}