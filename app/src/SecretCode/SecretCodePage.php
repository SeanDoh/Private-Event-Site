<?php

namespace {

  use SilverStripe\Assets\Image;
  use SilverStripe\Forms\DropdownField;

  class SecretCodePage extends Page
  {
    private static $db = [
      'Title' => 'Varchar',
    ];

    private static $has_one = [
      'Event' => Event::class,
    ];

    public function getCMSFields(){
      $fields = parent::getCMSFields();
      $fields->removeByName('Content');
      $fields->removeByName('Metadata');
      $fields->addFieldToTab(
        'Root.Main',
        DropdownField::create(
        'EventID',
        'Event',
        Event::get()->map()
        )->setEmptyString('Select an Event')
        ->setDescription('Select an Event')
      );
      return $fields;
    }
  }
}