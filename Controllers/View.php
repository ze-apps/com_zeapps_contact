<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;

class View extends Controller
{
    public function companiesSearch(){
        $data = array();
        return view("companies/search", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function companiesFormModal(){
        $data = array();
        return view("companies/search", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }
}