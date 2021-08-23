<?php

namespace {

  class EventPageController extends PageController
  {
    private static $allowed_actions = [
      'CheckAccess'
    ];

    // if access is not stored in session cookie, redirect to home page
    public function CheckAccess() 
    {
      if(!$this->getRequest()->getSession()->get('Access')){
        $this->redirect('home/');
      }
    }
  }
}
