<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

use App\com_zeapps_contact\Models\AddressFormat;
use App\com_zeapps_contact\Models\Country;
use App\com_zeapps_contact\Models\CountryLang;
use App\com_zeapps_contact\Models\States;
use App\com_zeapps_contact\Models\ZoneAddress;

class ComZeappsContactInit
{

    public function up()
    {
        Capsule::schema()->create('com_zeapps_contact_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user_account_manager', false, true)->default(0);
            $table->string('name_user_account_manager', 100)->default("");
            $table->integer('id_price_list')->default(0);
            $table->string('company_name', 255)->default("");
            $table->integer('id_parent_company', false, true)->default(0);
            $table->string('name_parent_company', 255)->default("");
            $table->integer('id_account_family', false, true)->default(0);
            $table->string('name_account_family', 100)->default("");
            $table->integer('id_topology', false, true)->default(0);
            $table->string('name_topology', 100)->default("");
            $table->integer('id_activity_area', false, true)->default(0);
            $table->string('name_activity_area', 100)->default("");
            $table->bigInteger('turnover')->default(0);
            $table->string('billing_address_1', 100)->default("");
            $table->string('billing_address_2', 100)->default("");
            $table->string('billing_address_3', 100)->default("");
            $table->string('billing_city', 100)->default("");
            $table->string('billing_zipcode', 50)->default("");
            $table->integer('billing_state_id')->default(0);
            $table->string('billing_state', 100)->default("");
            $table->integer('billing_country_id', false, true)->default(0);
            $table->string('billing_country_name', 100)->default("");
            $table->string('delivery_address_1', 100)->default("");
            $table->string('delivery_address_2', 100)->default("");
            $table->string('delivery_address_3', 100)->default("");
            $table->string('delivery_city', 100)->default("");
            $table->string('delivery_zipcode', 50)->default("");
            $table->integer('delivery_state_id', false, true)->default(0);
            $table->string('delivery_state', 100)->default("");
            $table->integer('delivery_country_id', false, true)->default(0);
            $table->string('delivery_country_name', 100)->default("");
            $table->text('comment');
            $table->string('email', 255)->default("");
            $table->tinyInteger('opt_out', false, true)->default(0);
            $table->string('phone', 25)->default("");
            $table->string('fax', 25)->default("");
            $table->string('website_url', 255)->default("");
            $table->string('code_naf', 15)->default("");
            $table->string('code_naf_libelle', 255)->default("");
            $table->string('company_number', 30)->default("");
            $table->string('accounting_number', 15)->default("");
            $table->timestamp('last_order')->nullable();
            $table->float('discount', 5,2)->default(0);
            $table->integer('id_modality', false, true)->default(0);
            $table->string('label_modality', 255)->default("");

            $table->timestamps();
            $table->softDeletes();
        });


        
        Capsule::schema()->create('com_zeapps_contact_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user_account_manager', false, true)->default(0);
            $table->string('name_user_account_manager', 100)->default("");
            $table->integer('id_price_list')->default(0);
            $table->integer('id_company', false, true)->default(0);
            $table->string('name_company', 255)->default("");
            $table->integer('id_account_family', false, true)->default(0);
            $table->string('name_account_family', 100)->default("");
            $table->integer('id_topology', false, true)->default(0);
            $table->string('name_topology', 100)->default("");
            $table->string('title_name', 30)->default("");
            $table->string('first_name', 50)->default("");
            $table->string('last_name', 50)->default("");
            $table->string('email', 255)->default("");
            $table->string('phone', 25)->default("");
            $table->string('other_phone', 25)->default("");
            $table->string('mobile', 25)->default("");
            $table->string('fax', 25)->default("");
            $table->string('assistant', 70)->default("");
            $table->string('assistant_phone', 25)->default("");
            $table->string('department', 25)->default("");
            $table->string('job', 25)->default("");
            $table->tinyInteger('opt_out', false, true)->default(0);
            $table->string('skype_id', 100)->default("");
            $table->string('twitter', 100)->default("");
            $table->date('date_of_birth')->nullable();
            $table->string('address_1', 100)->default("");
            $table->string('address_2', 100)->default("");
            $table->string('address_3', 100)->default("");
            $table->string('city', 100)->default("");
            $table->string('zipcode', 50)->default("");
            $table->integer('state_id')->default(0);
            $table->string('state', 100)->default("");
            $table->integer('country_id', false, true)->default(0);
            $table->string('country_name', 100)->default("");
            $table->text('comment');
            $table->string('website_url', 255)->default("");
            $table->string('accounting_number', 15)->default("");
            $table->timestamp('last_order')->nullable();
            $table->float('discount', 5,2)->default(0);
            $table->integer('id_modality', false, true)->default(0);
            $table->string('label_modality', 255)->default("");

            $table->timestamps();
            $table->softDeletes();
        });



        Capsule::schema()->create('com_zeapps_contact_code_naf', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code_naf', 6)->default("");
            $table->string('libelle', 255)->default("");

            $table->timestamps();
            $table->softDeletes();
        });




        Capsule::schema()->create('com_zeapps_contact_account_families', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 255)->default("");
            $table->tinyInteger('sort', false, true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });




        Capsule::schema()->create('com_zeapps_contact_address_format', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_country', false, true)->default(0);
            $table->text('format');

            $table->timestamps();
            $table->softDeletes();
        });



        Capsule::schema()->create('com_zeapps_contact_country', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_zone', false, true)->default(0);
            $table->integer('id_currency', false, true)->default(0);
            $table->string('iso_code', 3)->default("");
            $table->integer('call_prefix', false, true)->default(0);
            $table->tinyInteger('active', false, true)->default(0);
            $table->tinyInteger('contains_states', false, true)->default(0);
            $table->tinyInteger('need_identification_number', false, true)->default(0);
            $table->tinyInteger('need_zip_code', false, true)->default(0);
            $table->string('zip_code_format', 12)->default("");
            $table->tinyInteger('display_tax_label', false, true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });



        Capsule::schema()->create('com_zeapps_contact_country_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_country', false, true)->default(0);
            $table->integer('id_lang', false, true)->default(0);
            $table->string('name', 64)->default("");

            $table->timestamps();
            $table->softDeletes();
        });


        Capsule::schema()->create('com_zeapps_contact_modalities', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('type_modality', false, true)->default(0);
            $table->string('id_cheque', 255)->default("");
            $table->tinyInteger('situation', false, true)->default(0);
            $table->string('accounting_account', 255)->default("");
            $table->string('journal', 20)->default("");
            $table->tinyInteger('settlement_type', false, true)->default(0);
            $table->tinyInteger('settlement_date', false, true)->default(0);
            $table->integer('settlement_delay', false, true)->default(0);
            $table->string('export', 255)->default("");
            $table->integer('sort', false, true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });


        Capsule::schema()->create('com_zeapps_contact_modalities_lang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_modality', false, true)->default(0);
            $table->integer('id_lang', false, true)->default(0);
            $table->string('label', 255)->default("");
            $table->string('label_doc', 255)->default("");

            $table->timestamps();
            $table->softDeletes();
        });



        Capsule::schema()->create('com_zeapps_contact_states', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_country', false, true)->default(0);
            $table->integer('id_zone', false, true)->default(0);
            $table->string('name', 64)->default("");
            $table->string('iso_code', 7)->default("");
            $table->smallInteger('tax_behavior', false, true)->default(0);
            $table->tinyInteger('active', false, true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });


        Capsule::schema()->create('com_zeapps_contact_topologies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 255)->default("");
            $table->integer('sort', false, true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });


        Capsule::schema()->create('com_zeapps_contact_zone_address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 64)->default("");
            $table->tinyInteger('active', false, true)->default(0);

            $table->timestamps();
            $table->softDeletes();
        });


        Capsule::schema()->create('com_zeapps_contact_accounting_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 255)->default("");
            $table->string('number', 255)->default("");
            $table->integer('type', false, true)->default(0);
            $table->string('type_label', 255)->default("");

            $table->timestamps();
            $table->softDeletes();
        });



        // **** import default data ****

        // import de address_format
        Capsule::table('com_zeapps_contact_address_format')->truncate();
        $address_formats = json_decode(file_get_contents(dirname(__FILE__) . "/address_format.json"));
        foreach ($address_formats as $address_format_json) {
            $addressFormat = new AddressFormat();

            foreach ($address_format_json as $key => $value) {
                $addressFormat->$key = $value ;
            }

            $addressFormat->save();
        }


        // import de country & country_lang
        Capsule::table('com_zeapps_contact_country')->truncate();
        $countries = json_decode(file_get_contents(dirname(__FILE__) . "/country.json"));
        foreach ($countries as $country_json) {
            $country = new Country();
            foreach ($country_json as $key => $value) {
                $country->$key = $value ;
            }
            $country->save();
        }

        Capsule::table('com_zeapps_contact_country_lang')->truncate();
        $countries_lang = json_decode(file_get_contents(dirname(__FILE__) . "/country_lang.json"));
        foreach ($countries_lang as $country_lang_json) {
            $countryLang = new CountryLang();
            foreach ($country_lang_json as $key => $value) {
                $countryLang->$key = $value ;
            }
            $countryLang->save();
        }



        // states
        Capsule::table('com_zeapps_contact_states')->truncate();
        $states = json_decode(file_get_contents(dirname(__FILE__) . "/states.json"));
        foreach ($states as $states_json) {
            $states = new States();
            foreach ($states_json as $key => $value) {
                $states->$key = $value ;
            }
            $states->save();
        }


        // zone addresse
        Capsule::table('com_zeapps_contact_zone_address')->truncate();
        $zone_addresses = json_decode(file_get_contents(dirname(__FILE__) . "/zone_address.json"));
        foreach ($zone_addresses as $zone_address_json) {
            $zoneAddress = new ZoneAddress();
            foreach ($zone_address_json as $key => $value) {
                $zoneAddress->$key = $value ;
            }
            $zoneAddress->save();
        }
    }


    public function down()
    {
        Capsule::schema()->dropIfExists('com_zeapps_contact_companies');
        Capsule::schema()->dropIfExists('com_zeapps_contact_contacts');
        Capsule::schema()->dropIfExists('com_zeapps_contact_code_naf');
        Capsule::schema()->dropIfExists('com_zeapps_contact_account_families');
        Capsule::schema()->dropIfExists('com_zeapps_contact_address_format');
        Capsule::schema()->dropIfExists('com_zeapps_contact_country');
        Capsule::schema()->dropIfExists('com_zeapps_contact_country_lang');
        Capsule::schema()->dropIfExists('com_zeapps_contact_modalities');
        Capsule::schema()->dropIfExists('com_zeapps_contact_modalities_lang');
        Capsule::schema()->dropIfExists('com_zeapps_contact_states');
        Capsule::schema()->dropIfExists('com_zeapps_contact_topologies');
        Capsule::schema()->dropIfExists('com_zeapps_contact_zone_address');
        Capsule::schema()->dropIfExists('com_zeapps_contact_accounting_numbers');
    }
}
