<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

use App\com_zeapps_contact\Models\AddressFormat;
use App\com_zeapps_contact\Models\Country;
use App\com_zeapps_contact\Models\CountryLang;
use App\com_zeapps_contact\Models\States;
use App\com_zeapps_contact\Models\ZoneAddress;

class ComZeappsContactUpdate1
{

    public function up()
    {
        Capsule::schema()->table('com_zeapps_contact_modalities', function (Blueprint $table) {
            $table->string('code_web', 50)->after('sort')->default("");
        });
    }


    public function down()
    {
    }
}
