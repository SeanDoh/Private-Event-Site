<?php

namespace {
  use SilverStripe\Forms\FieldList;
  use SilverStripe\ORM\DataExtension;
  use SilverStripe\Assets\Image;
  use SilverStripe\Forms\DropdownField;
  use SilverStripe\AssetAdmin\Forms\UploadField;
  use SilverStripe\CMS\Model\SiteTree;

  class CustomSiteConfig extends DataExtension 
  {
    private static $db = [
      'RedirectLink' => 'Varchar(255)'
    ];
    private static $has_one = [
      'Image' => Image::class,
    ];
    private static $owns = [
      'Image'
    ];
    public function updateCMSFields(FieldList $fields) 
    {
      $fields->addFieldToTab('Root.Main',  UploadField::create('Image', 'Site Backgound Image'));
      $pages = SiteTree::get();
      $pagesDropDownData = [];
      foreach ($pages as $key => $value) {
        $pagesDropDownData[$value->URLSegment] = $value->Title;
      }
      $fields->addFieldToTab('Root.Main',
        DropDownField::create(
          'RedirectLink',
          'Which page to redirect to if someone tries to access event pages manually entering URLs',
          $pagesDropDownData
      ));
    }
  }
}