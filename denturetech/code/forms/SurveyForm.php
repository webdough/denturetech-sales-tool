<?php

/**
 * Class SurveyForm
 */
class SurveyForm extends Form {

    /**
     * form constructor
     *
     * @param Controller $controller
     * @param String $name
     */
    public function __construct($controller, $name, $arguments = array()) {

        /* -----------------------------------------
         * Scaffolding
        ------------------------------------------*/

        $row = new LiteralField('', '<div class="row">');
        $column = new LiteralField('', '<div class="col-xs-12 col-sm-6">');
        $close = new LiteralField('', '</div>');

        /* -----------------------------------------
         * Fields
        ------------------------------------------*/

        $appointment = new OptionsetField('QuestionOne', $arguments['QuestionOne'], ArrayLib::valuekey(range(1, 5)));
        $appointment->addExtraClass('radio')
            ->setCustomValidationMessage('Please select one of the following');

        $comfortable = new OptionsetField('QuestionTwo', $arguments['QuestionTwo'], ArrayLib::valuekey(range(1, 5)));
        $comfortable->addExtraClass('radio')
            ->setCustomValidationMessage('Please select one of the following');

        $concerns = new OptionsetField('QuestionThree', $arguments['QuestionThree'], ArrayLib::valuekey(range(1, 5)));
        $concerns->addExtraClass('radio')
            ->setCustomValidationMessage('Please select one of the following');

        $treatment = new OptionsetField('QuestionFour', $arguments['QuestionFour'], ArrayLib::valuekey(range(1, 5)));
        $treatment->addExtraClass('radio')
            ->setCustomValidationMessage('Please select one of the following');

        $fullName = new TextField('FullName', 'Name (optional)');
        $fullName->setAttribute('placeholder', 'Enter your name')
            ->addExtraClass('form-control');

        $message = new TextareaField('Message', 'Additional Comments');
        $message->setAttribute('placeholder', 'Enter your message')
            ->addExtraClass('form-control')
            ->setCustomValidationMessage('Please enter your <strong>Message</strong>');

        $reCaptcha = new LiteralField('', '');
        if(isset($arguments['ReCaptchaSiteKey']) && isset($arguments['ReCaptchaSecretKey'])) {
            $reCaptcha = new LiteralField('ReCaptcha', '<div class="recaptcha g-recaptcha" data-sitekey="'.$arguments['ReCaptchaSiteKey'].'"></div>');
        }

        $fields = new FieldList(
            $row,
            $column,
            $appointment,
            $close,
            $column,
            $comfortable,
            $close,
            $close,
            $row,
            $column,
            $concerns,
            $close,
            $column,
            $treatment,
            $close,
            $close,
            $fullName,
            $message,
            $reCaptcha
        );

        /**
         * Actions
         */
        $actions = new FieldList(
            FormAction::create('Submit')->setTitle('Submit')->addExtraClass('btn btn-primary')
        );

        /**
         * Required
         */
        $required = new RequiredFields(
            'QuestionOne',
            'QuestionTwo',
            'QuestionThree',
            'QuestionFour',
            'Message'
        );

        $form = Form::create($this, $name, $fields, $actions, $required);
        if($formData = Session::get('FormInfo.Form_'.$name.'.data')) {
            $form->loadDataFrom($formData);
        }

        parent::__construct($controller, $name, $fields, $actions, $required);

        $this->addExtraClass('form');
    }

    /**
     * Submit the form
     *
     * @param $data
     * @param $form
     * @return bool|SS_HTTPResponse
     */
    public function Submit($data, $form) {

        /**
         * Set the form state
         */
        Session::set('FormInfo.Form_'.$this->name.'.data', $data);

        /**
         * reCAPTCHA
         * Based on https://github.com/google/recaptcha
         */
        if($this->controller->data()->ReCaptchaSiteKey && $this->controller->data()->ReCaptchaSecretKey) {
            $recaptchaResponse = $data['g-recaptcha-response'];
            $recaptcha = new \ReCaptcha\ReCaptcha($this->controller->data()->ReCaptchaSecretKey);
            $resp = $recaptcha->verify($recaptchaResponse);
            if ($resp->isSuccess()) {
                /**
                 * Verified
                 */
            } else {
                /**
                 * Not Verified
                 */
                $errors = HTMLText::create();
                $html = '';
                /**
                 * Error code reference
                 * https://developers.google.com/recaptcha/docs/verify
                 */
                foreach ($resp->getErrorCodes() as $code) {
                    switch($code) {
                        case 'missing-input-secret':
                            $html.= 'The secret parameter is missing.';
                            break;
                        case 'invalid-input-secret':
                            $html.= 'The secret parameter is invalid or malformed.';
                            break;
                        case 'missing-input-response':
                            $html.= 'Please check the reCAPTCHA below to confirm you\'re human.';
                            break;
                        case 'invalid-input-response':
                            $html.= 'The response parameter is invalid or malformed.';
                            break;
                        default:
                            $html.= 'There was an error submitting the reCAPTCHA, please try again.';
                    }
                }
                $errors->setValue($html);
                $this->controller->setFlash('Your survey has not been submitted, please fill out all of the <strong>required fields.</strong>', 'warning');
                $form->addErrorMessage('ReCaptcha', $errors, 'bad', false);
                return $this->controller->redirect($this->controller->Link());
            }
        }

        /**
         * Get question labels from the controller
         */
        $data['QuestionOneLabel'] = $this->controller->data()->QuestionOne;
        $data['QuestionTwoLabel'] = $this->controller->data()->QuestionTwo;
        $data['QuestionThreeLabel'] = $this->controller->data()->QuestionThree;
        $data['QuestionFourLabel'] = $this->controller->data()->QuestionFour;

        $data['Logo'] = SiteConfig::current_site_config()->LogoImage();
        $From = $this->controller->data()->MailTo;
        $To = $this->controller->data()->MailTo;
        $Subject = SiteConfig::current_site_config()->Title.' - Contact message';
        $email = new Email($From, $To, $Subject);
        if($cc = $this->controller->data()->MailCC){
            $email->setCc($cc);
        }
        if($bcc = $this->controller->data()->MailBCC){
            $email->setBcc($bcc);
        }
        $email->setTemplate('SurveyEmail')
            ->populateTemplate($data)
            ->send();
        if($this->controller->data()->SubmitText){
            $submitText = $this->controller->data()->SubmitText;
        }else{
            $submitText = 'Thank you for filling out the survey.';
        }
        $this->controller->setFlash($submitText, 'success');

        /**
         * Create Record
         */
//        $contactMessage = new ContactMessage();
//        $form->saveInto($contactMessage);
//        $contactMessage->write();

        /**
         * Clear the form state
         */
        Session::clear('FormInfo.Form_'.$this->name.'.data');

        return $this->controller->redirect($this->controller->data()->Link('?success=1'));
    }

    /**
     * @return bool
     */
    public function validate() {
        $result = parent::validate();
        if(!$result) {
            $this->controller->setFlash('Your survey has not been submitted, please fill out all of the <strong>required fields.</strong>', 'warning');
        }
        return $result;
    }

}