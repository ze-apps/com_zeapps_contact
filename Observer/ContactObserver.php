<?php

namespace App\com_zeapps_contact\Observer;

use Zeapps\Core\iObserver ;

class ContactObserver implements iObserver
{
    public static function action($transmitterClassName = '', $actionName = '', $arrayParam = array(), $callBack = null) {

        if ($transmitterClassName == 'com_zeapps_crm' && $actionName == 'save') {
            echo "ok contact observer<br>" ;
        }


    }


    public static function getHook() {
        $retour = array();

        return $retour ;
    }



    public static function getCron() {
        $retour = array();

        return $retour ;
    }





}