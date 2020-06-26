<?php

namespace {

  use SilverStripe\CMS\Model\SiteTree;

  class Page extends SiteTree
  {
    private static $has_one = [];
    
    public function getCMSFields(){
      $fields = parent::getCMSFields();
      return $fields;
    }
  }
}
