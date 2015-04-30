<?php

/**
 * Class SurveyPage
 */
class SurveyPage extends Page {

    private static $icon = 'denturetech/images/icons/clipboard-invoice.png';

    private static $db = array(
        'MailTo' => 'Varchar(100)',
        'MailCC' => 'Text',
        'MailBCC' => 'Text',
        'SubmitText' => 'Text',
        'ReCaptchaSiteKey' => 'Varchar(255)',
        'ReCaptchaSecretKey' => 'Varchar(255)',
        'QuestionOne' => 'Text',
        'QuestionTwo' => 'Text',
        'QuestionThree' => 'Text',
        'QuestionFour' => 'Text'
    );

    //private static $can_be_root = false;
    //private static $allowed_children = array();

    private static $defaults = array(
        'SubmitText' => 'Thank you for contacting us, we will get back to you as soon as possible.'
    );

    //public function getCMSValidator() {
    //    return new RequiredFields(array());
    //}

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        /* =========================================
         * Contact
         =========================================*/

        $fields->addFieldToTab('Root.Main', new HeaderField('Settings'), 'Content');
        $fields->addFieldToTab('Root.Main', $mailTo = new TextField('MailTo', 'Email'), 'Content');
        $mailTo->setRightTitle('Choose an email address for the contact page to send to');
        $fields->addFieldToTab('Root.Main', $mailCC = new TextField('MailCC', 'Cc'), 'Content');
        $mailCC->setRightTitle('Choose an email, or emails to CC (separate emails with a comma and no space e.g: email1@website.com,email2@website.com)');
        $fields->addFieldToTab('Root.Main', $mailBCC = new TextField('MailBCC', 'Bcc'), 'Content');
        $fields->addFieldToTab('Root.Main', $submissionText = new TextareaField('SubmitText', 'Submission Text'), 'Content');
        $submissionText->setRightTitle('Text for contact form submission once the email has been sent i.e "Thank you for your enquiry"');
        $fields->addFieldToTab('Root.Main', new HeaderField('', 'reCaptcha', 4), 'Content');
        $fields->addFieldToTab('Root.Main', new LiteralField('',
            '<p>By filling in the Site Key, and Secret Key fields a reCaptcha field will be added to the form to protect against spam.</p>'
        ), 'Content');
        $fields->addFieldToTab('Root.Main', new LiteralField('',
            '<div class="message"><p><strong>Note:</strong> you can get your SiteKey, and SecretKey at this address <a href="https://www.google.com/recaptcha/" target="_blank">https://www.google.com/recaptcha/</a></p></div>'
        ), 'Content');
        $fields->addFieldToTab('Root.Main', new TextField('ReCaptchaSiteKey', 'Site Key'), 'Content');
        $fields->addFieldToTab('Root.Main', new TextField('ReCaptchaSecretKey', 'Secret Key'), 'Content');

        /* =========================================
         * Questions
         =========================================*/

        $fields->addFieldToTab('Root.Main', new HeaderField('', 'Questions'), 'Content');
        $fields->addFieldToTab('Root.Main', new LiteralField('',
            '<p>Title for the four questions in the survey form.</p>'
        ), 'Content');
        $fields->addFieldToTab('Root.Main', $questionOne = new TextareaField('QuestionOne', 'One'), 'Content');
        $questionOne->setRows(2);
        $fields->addFieldToTab('Root.Main', $questionTwo = new TextareaField('QuestionTwo', 'Two'), 'Content');
        $questionTwo->setRows(2);
        $fields->addFieldToTab('Root.Main', $questionThree = new TextareaField('QuestionThree', 'Three'), 'Content');
        $questionThree->setRows(2);
        $fields->addFieldToTab('Root.Main', $questionFour = new TextareaField('QuestionFour', 'Four'), 'Content');
        $questionFour->setRows(2);

        return $fields;
    }

}

/**
 * Class SurveyPage_Controller
 */
class SurveyPage_Controller extends Page_Controller {

    private static $allowed_actions = array('SurveyForm');

    public function init() {

        parent::init();

        /**
         * reCaptcha
         */
        if($this->ReCaptchaSiteKey && $this->ReCaptchaSecretKey) {
            Requirements::javascript('https://www.google.com/recaptcha/api.js');
        }

    }

    /**
     * @return SurveyForm
     */
    public function SurveyForm() {
        return new SurveyForm($this, 'SurveyForm', array(
            'MailTo' => $this->MailTo,
            'MailCC' => $this->MailCC,
            'MailBCC' => $this->MailBCC,
            'SubmitText' => $this->SubmitText,
            'ReCaptchaSiteKey' => $this->ReCaptchaSiteKey,
            'ReCaptchaSecretKey' => $this->ReCaptchaSecretKey,
            'QuestionOne' => $this->QuestionOne,
            'QuestionTwo' => $this->QuestionTwo,
            'QuestionThree' => $this->QuestionThree,
            'QuestionFour' => $this->QuestionFour
        ));
    }

    /**
     * @return bool
     */
    public function Success() {
        return isset($_REQUEST['success']) && $_REQUEST['success'] == "1";
    }

}