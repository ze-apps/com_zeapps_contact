<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

use App\com_zeapps_contact\Models\AddressFormat;
use App\com_zeapps_contact\Models\Country;
use App\com_zeapps_contact\Models\CountryLang;
use App\com_zeapps_contact\Models\States;
use App\com_zeapps_contact\Models\ZoneAddress;

class ComZeappsContactCompanyV2
{

    public function up()
    {
        Capsule::schema()->table('com_zeapps_contact_companies', function (Blueprint $table) {
            $table->string('tva_intracom', 255)->default("");
        });
    }


    public function down()
    {
    }
}
