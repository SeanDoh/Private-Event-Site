<?php

namespace {
  
  use SilverStripe\ORM\DataObject;
  use SilverStripe\Versioned\Versioned;
  use SilverStripe\Assets\Image;
  use SilverStripe\Forms\DropdownField;
  use SilverStripe\Forms\DatetimeField;
  use SilverStripe\Forms\CheckboxSetField;
  use SilverStripe\CMS\Model\SiteTree;

  class Event extends DataObject
  {
    private static $db = [
      'Title' => 'Varchar(255)',
      'StartDate' => 'Datetime',
      'EndDate' => 'Datetime',
      'DisplayDate' => 'Text',
      'Description' => 'HTMLText',
      'RegistrationMessage' => 'Text',
      'Location' => 'Text',
      'FoodChoices' => 'Varchar(255)',
      'FoodDay' => 'Varchar(255)',
      'RedirectLink' => 'Varchar(255)',
    ];

    private static $has_one = [
      'Image' => Image::class
    ];
    
    private static $owns = [
      'Image'
    ];

    private static $summary_fields = [
      'Title' => 'Title',
      'StartDate' => 'Start Date',
      'EndDate' => 'End Date',
      'DisplayDate' => 'Display Date',
      'Location' => 'Location',
    ];

    private static $extensions = [
      Versioned::class,
    ];
    
    public function getCMSFields(){

      $fields = parent::getCMSFields();
      $fields->fieldByName('Root.Main.DisplayDate')->setRightTitle('Date that is displayed on form and event page');
      $fields->fieldByName('Root.Main.RegistrationMessage')->setRightTitle('Message to display at top of registration form');
      $fields->fieldByName('Root.Main.Description')->setRightTitle('Message to display at top of Event Page after registration');
      $image = $fields->fieldByName('Root.Main.Image');
      $fields->removeByName('Image');
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

      $fields->addFieldToTab('Root.Main', $image);

      return $fields;
    }
  }
}
