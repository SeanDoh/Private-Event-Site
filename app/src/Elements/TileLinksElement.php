<?php

namespace {

  use DNADesign\Elemental\Models\BaseElement;
  use SilverStripe\Forms\TextField;
  use SilverStripe\Forms\FieldList;
  use SilverStripe\Assets\Image;
  use SilverStripe\CMS\Model\SiteTree;
  use SilverStripe\Forms\DropdownField;

  class TileElement extends BaseElement
  {
    private static $db = [
      'Content' => 'HTMLText',
      'TileHeight' => 'Varchar(255)',
      'BackgroundSVGBase64' => 'Text',
      'RedirectLink' => 'Varchar(255)'
    ];

    private static $singular_name = 'tile element';

    private static $plural_name = 'tile elements';

    private static $description = 'What my custom element does';

    private static $has_one = [
      'TextImage' => Image::class,
      'BorderImage' => Image::class,
      'Image' => Image::class
    ];

    private static $owns = [
      'TextImage',
      'Image',
      'BorderImage'
    ];

    public function getCMSFields()
    {
      //$fields = parent::getCMSFields();

      $this->beforeUpdateCMSFields(function (FieldList $fields){
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
        $fields->fieldByName('Root.Main.BackgroundSVGBase64')->setRightTitle('Base64 encoded string of an SVG, used for background border.  e.g. data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmL...  NOTE: needs preserveAspectRatio="none" in SVG tag e.g. <svg preserveAspectRatio="none"> 10 23 20 14 </svg');
        $fields->fieldByName('Root.Main.TileHeight')->setRightTitle('Controls height of tile to make border less stretchy, in pixels e.g. 150px');
      });

      return parent::getCMSFields();
    }

    public function getType()
    {
      return 'Tile Element';
    }
  } 
}