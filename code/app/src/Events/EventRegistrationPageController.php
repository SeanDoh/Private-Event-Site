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

  class EventRegistrationPageController extends PageController
  {
    private static $allowed_actions = [
      'EventRegistrationForm'
    ];

    // event registration form
    public function EventRegistrationForm(){

      // check if secret code in session cookie is already registered
      $reg = EventRegistration::get()->filter([
        'Code' => $this->getRequest()->getSession()->get('Code')
      ]);

      if($reg[0]){
        
        $msg = new ArrayData([
          'RegistrationMessage' => 'Thank you for registering!',
          'RedirectLink' => $this->RedirectLink
        ]);
        return $this->customise($msg)->renderWith(['EventRegistrationPage', 'Page']);
      }
      else{
        // get event start and end date, calculate diff
        // then create array of day names for dropdown
        $eventDays = [];
        $startDay = new DateTime($this->Event->StartDate);
        $endDay = new DateTime($this->Event->EndDate);
        $diff = date_diff($startDay, $endDay)->d;

        for ($i=0; $i <= $diff; $i++) {
          $startDate = new DateTime($this->Event->StartDate);
          $date = date_add($startDate, date_interval_create_from_date_string($i.' days'));
          $day = date_format($date, 'l');
          $eventDays[$day] = $day;
        }

        // get event food choices, make a checkbox for choices
        $foodChoices = [];
        $array = explode(',',$this->Event->FoodChoices);
        foreach ($array as $key => $value) {
          $foodChoices[$value] = $value;
        }

        $mainContact = new FieldGroup(
          TextField::create('Name', _t('EventRegistration.Email', 'Name')),
          CheckboxSetField::create('Attendance', 'Which days will you be attending?', $eventDays),
          CheckboxSetField::create('FoodChoice', 'Which food do you prefer?', $foodChoices),
          TextareaField::create('FoodAllergies', _t('EventRegistration.FoodAllergies', 'Please describe any food allergies for yourself')),
          CheckboxSetField::create('PlusOne', '', ['1' => 'Plus one?'])
        );
        $mainContact->setTitle('Contact Info:');

        $plusOne = new FieldGroup(
          TextField::create('PlusOneName', _t('EventRegistration.PlusOneName', 'Name')),
          CheckboxSetField::create('AttendancePlusOne', 'Which days will your plus one be attending?', $eventDays),
          CheckboxSetField::create('FoodChoicePlusOne', 'Which food does your plus one prefer?', $foodChoices),
          TextareaField::create('FoodAllergiesPlusOne', _t('EventRegistration.FoodAllergiesPlusOne', 'Please describe any food allergies for your plus one'))
        );
        $plusOne->setTitle('Plus One Info:');

        $fields = new FieldList(
          HeaderField::create('FormMessage', $this->Event->RegistrationMessage),
          $mainContact,
          $plusOne
        );
        //$fields->push('Attendance', OptionsetField::create('Attendance', 'Will you be attending?',[
        //  'yes' => 'Yes',
        //  'no' => 'No',
        //  'maybe' => 'Maybe'
        //], 'yes'));
        $actions = new FieldList(
          FormAction::create('submitEventRegistrationForm')->setTitle('Submit')
        );

        $required = new RequiredFields([
          'Name',
          'Attendance',
        ]);

        $form = new RecaptchaForm($this, 'EventRegistrationForm', $fields, $actions, $required);

        return $form;
      }
    }

    // process eventRegistration
    public function submitEventRegistrationForm($data, Form $form){
      // save the form data into a new event registration
      $reg = new EventRegistration();
      $form->saveInto($reg, $form);
      
      // add the code that was saved to the session
      $reg->Code = $this->getRequest()->getSession()->get('Code');
      if(isset($data['Attendance'])){
        $attendance = '';
        foreach ($data['Attendance'] as $key => $value) {
          $attendance .=','.$value;
        }
        $reg->Attendance = ltrim($attendance,',');
      }

      if(isset($data['AttendancePlusOne'])){
        $attendancePlusOne = '';
        foreach ($data['AttendancePlusOne'] as $key => $value) {
          $attendancePlusOne .=','.$value;
        }
        $reg->AttendancePlusOne = ltrim($attendancePlusOne,',');
      }

      if(isset($data['FoodChoice'])){
        $reg->FoodChoice = implode(',', $data['FoodChoice']);
      }

      if(isset($data['FoodChoicePlusOne'])){
        $reg->FoodChoicePlusOne = implode(',', $data['FoodChoicePlusOne']);
      }

      // add the eventID that is connected to the secret code page
      $reg->EventID = $this->Event->ID;
      $reg->write();

      // add 'Access' boolean to session
      $this->getRequest()->getSession()->set('Access', true);
      $msg = new ArrayData([
        'RegistrationMessage' => 'Thank you for registering!',
        'RedirectLink' => $this->RedirectLink
      ]);
      // redirect to the event page
      //return $this->redirect($this->Event->RedirectLink.'/');
      return $this->customise($msg)->renderWith(['EventRegistrationPage', 'Page']);
    }
  }
}
