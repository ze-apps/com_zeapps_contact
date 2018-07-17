<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;

use App\com_zeapps_contact\Models\Country as CountryModel ;

class Country extends Controller
{
    public function get_all()
    {
        if(!$countries = CountryModel::join('com_zeapps_contact_country_lang', 'com_zeapps_contact_country.id', '=', 'com_zeapps_contact_country_lang.id_country')
            ->orderBy('com_zeapps_contact_country_lang.name')
            ->where("id_lang", 1)
            ->get()){
            $countries = [];
        }

        echo json_encode(array(
            "countries" => $countries
        ));
    }
    public function modal(Request $request)
    {
        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $contries_rs = CountryModel::join('com_zeapps_contact_country_lang', 'com_zeapps_contact_country.id', '=', 'com_zeapps_contact_country_lang.id_country')
            ->orderBy('com_zeapps_contact_country_lang.name')
            ->where("id_lang", 1) ;

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