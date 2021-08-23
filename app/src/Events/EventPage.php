<?php

namespace {
  
  use SilverStripe\Forms\DropdownField;
  use SilverStripe\CMS\Model\SiteTree;
  use SilverStripe\AssetAdmin\Forms\UploadField;
  use SilverStripe\Assets\Image;

  class EventPage extends Page
  {
    private static $db = [
      'Title' => 'Varchar'
    ];

    private static $has_one = [
      'Event' => Event::class,
      'TitleImage' => Image::class,
      'LocationImage' => Image::class
    ];

    private static $owns = [
      'TitleImage',
      'LocationImage'
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
      $fields->removeByName('Content');

      $titleImage = new UploadField('TitleImage', 'Title Image');
      $titleImage->setFolderName('Uploads');
      $locationImage = new UploadField('LocationImage', 'Location Image');
      $locationImage->setFolderName('Uploads');
      $fields->addFieldToTab('Root.Main', $titleImage);
      $fields->addFieldToTab('Root.Main', $locationImage);
      return $fields;
    }
  }
}