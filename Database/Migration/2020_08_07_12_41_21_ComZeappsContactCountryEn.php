<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

use App\com_zeapps_contact\Models\AddressFormat;
use App\com_zeapps_contact\Models\Country;
use App\com_zeapps_contact\Models\CountryLang;
use App\com_zeapps_contact\Models\States;
use App\com_zeapps_contact\Models\ZoneAddress;

class ComZeappsContactCountryEn
{

    public function up()
    {
        // import de country_lang (anglais)
        $countries_lang = json_decode(file_get_contents(dirname(__FILE__) . "/country_lang_en.json"));
        foreach ($countries_lang as $country_lang_json) {
            $countryLang = new CountryLang();
            foreach ($country_lang_json as $key => $value) {
                $countryLang->$key = $value ;
            }
            $countryLang->save();
        }
    }


    public function down()
    {

    }
}
