<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;

class View extends Controller
{
    public function view(){
        $data = array();
        return view("companies/view", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function companiesSearch(){
        $data = array();
        return view("companies/search", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function companiesFormModal(){
        $data = array();
        return view("companies/form_modal", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function companiesModal(){
        $data = array();
        return view("companies/modalCompany", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function summary_partial(){
        $data = array();
        return view("companies/summary_partial", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }
}