<?php

namespace {
  
  use SilverStripe\Forms\DropdownField;
  use SilverStripe\CMS\Model\SiteTree;

  // check if they have access and secret code stored in session
  // if they have it, show reg form, otherwise, show a form to enter secret code
  class EventRegistrationPage extends Page
  {
    private static $db = [
      'Title' => 'Varchar',
      'RedirectLink' => 'Varchar',
    ];

    private static $has_one = [
      'Event' => Event::class,
    ];

    public function getCMSFields(){
      $fields = parent::getCMSFields();
      $fields->addFieldToTab(
        'Root.Main',
        DropdownField::create(
        'EventID',
        'Event',
        Event::get()->map()
        )->setEmptyString('Select an Event')
        ->setDescription('Select an Event')
      );
      $pages = SiteTree::get();
      $pagesDropDownData = [];
      foreach ($pages as $key => $value) {
        $pagesDropDownData[$value->URLSegment] = $value->Title;
      }
      $fields->addFieldToTab('Root.Main',
        DropDownField::create(
          'RedirectLink',
          'Which page to redirect to after registering?',
          $pagesDropDownData
      ));
      return $fields;
    }
  }
}