<?php

namespace {
  
  use SilverStripe\Forms\FieldList;
  use SilverStripe\Forms\Form;
  use SilverStripe\Forms\FormAction;
  use SilverStripe\Forms\RequiredFields;
  use SilverStripe\Forms\TextField;
  use SilverStripe\Forms\TextareaField;
  use SilverStripe\Forms\EmailField;
  use SilverStripe\Forms\FieldGroup;
  use SilverStripe\Forms\HeaderField;
  use SilverStripe\Forms\CheckboxSetField;
  use SilverStripe\Forms\OptionsetField;
  use SilverStripe\View\ArrayData;
  use Meldgaard\SilverStripe\ReCaptcha\Form\RecaptchaForm;
  use SilverStripe\CMS\Model\SiteTree;

  class SecretCodePageController extends PageController
  {
    private static $allowed_actions = [
      'SecretCodeForm',
      'EventRegistrationForm',
      'CheckAccess'
    ];

    // if access is stored in session cookie, redirect to event
    public function CheckAccess() 
    {
      if($this->getRequest()->getSession()->get('Access')){
        $this->redirect($this->Event->RedirectLink.'/');
      }
    }

    // display secret code form, enter code to get access to site
    public function SecretCodeForm()
    {
      $fields = new FieldList(
        TextField::create('SecretCode', 'Secret Code (Use code "123")')
      );

      $actions = new FieldList(
        FormAction::create('enterCode')->setTitle('Enter')
      );

      $required = new RequiredFields('SecretCode');

      $form = new RecaptchaForm($this, 'SecretCodeForm', $fields, $actions, $required);

      return $form;
    }

    // process secret code
    public function enterCode($data, Form $form)
    {
      // check if code is correct
      $codes = SecretCode::get()->filter([
        'Code' => $data['SecretCode']
      ]);

      // if code is correct, redirect to event page
      if($codes[0]){
          // add secret code to session cookie to save later
          $this->getRequest()->getSession()->set('Code', $data['SecretCode']);
          // add 'Access' boolean to session
          $this->getRequest()->getSession()->set('Access', true);
          // redirect to the event page
          return $this->redirect($this->Event->RedirectLink.'/');
          // display the registration form
          //return $this->customise($newForm)->renderWith(['EventRegistrationForm', 'Page']);
      }
      else{
        $form->sessionMessage('You Shall Not Pass', 'failure');
      }
      return $this->redirectBack();
    }
  }
}
