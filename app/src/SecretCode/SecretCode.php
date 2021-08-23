<?php

namespace {

  use SilverStripe\ORM\DataObject;
  use SilverStripe\Versioned\Versioned;

  // admin is in eventsAdmin
  class SecretCode extends DataObject
  {
    private static $db = [
      'Code' => 'Varchar(255)'
    ];

    private static $summary_fields = [
      'Code'
    ];

    private static $extensions = [
      Versioned::class,
    ];
    
    public function getCMSFields(){
      $fields = parent::getCMSFields();
      return $fields;
    }
  }
}
