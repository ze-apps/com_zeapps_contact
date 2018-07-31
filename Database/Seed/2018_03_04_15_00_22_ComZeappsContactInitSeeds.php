<?php

use Illuminate\Database\Capsule\Manager as Capsule;
use App\com_zeapps_contact\Models\Companies;
use App\com_zeapps_contact\Models\Contacts;
use App\com_zeapps_contact\Models\CodeNaf;
use App\com_zeapps_contact\Models\AccountFamilies;
use App\com_zeapps_contact\Models\Modalities;
use App\com_zeapps_contact\Models\ModalitiesLang;
use App\com_zeapps_contact\Models\AccountingNumbers;


class ComZeappsContactInitSeeds
{
    public function run()
    {
        // import de AccountingNumbers
        Capsule::table('com_zeapps_contact_accounting_numbers')->truncate();
        $json_content = json_decode(file_get_contents(dirname(__FILE__) . "/AccountingNumbers.json"));
        foreach ($json_content as $data_json) {
            $obj_data = new AccountingNumbers();

            foreach ($data_json as $key => $value) {
                $obj_data->$key = $value ;
            }

            $obj_data->save();
        }



        // import de compagnies
        Capsule::table('com_zeapps_contact_companies')->truncate();
        $compagnies = json_decode(file_get_contents(dirname(__FILE__) . "/compagnies.json"));
        foreach ($compagnies as $compagny_json) {
            $company = new Companies();

            foreach ($compagny_json as $key => $value) {
                $company->$key = $value ;
            }

            $company->save();
        }



        // import de contacts
        Capsule::table('com_zeapps_contact_contacts')->truncate();
        $contacts = json_decode(file_get_contents(dirname(__FILE__) . "/contacts.json"));
        foreach ($contacts as $contact_json) {
            $contact = new Contacts();

            foreach ($contact_json as $key => $value) {
                $contact->$key = $value ;
            }

            $contact->save();
        }




        // import de code naf
        Capsule::table('com_zeapps_contact_code_naf')->truncate();
        $code_nafs = json_decode(file_get_contents(dirname(__FILE__) . "/code_naf.json"));
        foreach ($code_nafs as $code_naf_json) {
            $codeNaf = new CodeNaf();

            foreach ($code_naf_json as $key => $value) {
                $codeNaf->$key = $value ;
            }

            $codeNaf->save();
        }




        // import de account_families
        Capsule::table('com_zeapps_contact_account_families')->truncate();
        $account_families = json_decode(file_get_contents(dirname(__FILE__) . "/acount_families.json"));
        foreach ($account_families as $account_family_json) {
            $accountFamily = new AccountFamilies();

            foreach ($account_family_json as $key => $value) {
                $accountFamily->$key = $value ;
            }

            $accountFamily->save();
        }









        // com_zeapps_contact_modalities
        Capsule::table('com_zeapps_contact_modalities')->truncate();
        Capsule::table('com_zeapps_contact_modalities_lang')->truncate();
        $modalities = json_decode(file_get_contents(dirname(__FILE__) . "/modalities.json"));
        foreach ($modalities as $modality_json) {
            $modality = new Modalities();
            foreach ($modality_json as $key => $value) {
                if (!in_array($key, array('label', 'label_doc'))) {
                    $modality->$key = $value;
                }
            }
            $modality->save();

            $modalityLang = new ModalitiesLang();
            $modalityLang->id_modality = $modality->id ;
            $modalityLang->id_lang = 1 ;
            $modalityLang->label = $modality_json->label ;
            $modalityLang->label_doc = $modality_json->label_doc ;
            $modalityLang->save() ;
        }

    }
}
