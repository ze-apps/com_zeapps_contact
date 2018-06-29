<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;
use Zeapps\Core\Event;

class Test extends Controller
{
    public function index(){
        Event::sendAction('com_zeapps_contact', 'save', array('tototo'), function($strText) {
            echo "retour à la fonction anonyme : " . $strText;
        });
    }
}