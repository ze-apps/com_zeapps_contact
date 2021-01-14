<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;

use Zeapps\Models\Config as Config ;

use App\com_zeapps_contact\Models\Country as CountryModel ;

class Country extends Controller
{
    public function get_all()
    {
        $langAffichage = 1 ;

        $langueParDefaut = Config::find("zeapps_default_language");
        if ($langueParDefaut) {
            $langAffichage = $langueParDefaut->value ;
        }

        if(!$countries = CountryModel::SELECT("com_zeapps_contact_country.*", "com_zeapps_contact_country_lang.name")
            ->join('com_zeapps_contact_country_lang', 'com_zeapps_contact_country.id', '=', 'com_zeapps_contact_country_lang.id_country')
            ->orderBy('com_zeapps_contact_country_lang.name')
            ->where("id_lang", $langAffichage)
            ->get()){
            $countries = [];
        }

        echo json_encode(array(
            "countries" => $countries
        ));
    }

    public function modal(Request $request)
    {
        $langAffichage = 1 ;

        $langueParDefaut = Config::find("zeapps_default_language");
        if ($langueParDefaut) {
            $langAffichage = $langueParDefaut->value ;
        }

        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $contries_rs = CountryModel::SELECT("com_zeapps_contact_country.*", "com_zeapps_contact_country_lang.name")
            ->join('com_zeapps_contact_country_lang', 'com_zeapps_contact_country.id', '=', 'com_zeapps_contact_country_lang.id_country')
            ->orderBy('com_zeapps_contact_country_lang.name')
            ->where("id_lang", $langAffichage) ;

        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $contries_rs = $contries_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $contries_rs = $contries_rs->where($key, $value) ;
            }
        }

        $total = $contries_rs->count();


        $countries = $contries_rs->limit($limit)->offset($offset)->get();

        if(!$countries) {
            $countries = array();
        }


        echo json_encode(array(
            "data" => $countries,
            "total" => $total
        ));
    }
}