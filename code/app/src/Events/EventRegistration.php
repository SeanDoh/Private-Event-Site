<?php

namespace {

  use SilverStripe\ORM\DataObject;
  use SilverStripe\Versioned\Versioned;

  class EventRegistration extends DataObject
  {
    private static $db = [
      'Name' => 'Varchar(255)',
      'PlusOne' => 'Boolean', // is there a plus one
      'PlusOneName' => 'Varchar(255)',
      'Attendance' => 'Varchar(255)',
      'AttendancePlusOne' => 'Varchar(255)', // what days are they attending
      'FoodChoice' => 'Varchar(255)',
      'FoodChoicePlusOne' => 'Varchar(255)',
      'FoodAllergies' => 'Text',
      'FoodAllergiesPlusOne' => 'Text',
      'Code' => 'Varchar(255)'
    ];

    private static $summary_fields = [
      'Name',
      'Attendance',
      'PlusOne',
    ];

    private static $has_one = [
      'Event' => Event::class
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
