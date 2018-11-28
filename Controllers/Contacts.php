<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\ModelRequest;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;
use Zeapps\libraries\PHPExcel;

use App\com_zeapps_contact\Models\Contacts as ContactsModel;
use App\com_zeapps_contact\Models\AccountFamilies;
use App\com_zeapps_contact\Models\Topologies;

class Contacts extends Controller
{

    public function search()
    {
        $data = array();
        return view("contacts/search", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function list_partial()
    {
        $data = array();
        return view("contacts/list_partial", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function view()
    {
        $data = array();
        return view("contacts/view", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function form_modal()
    {
        $data = array();
        return view("contacts/form_modal", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function modal_contact()
    {
        $data = array();
        return view("contacts/modalContact", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }




    public function getAll(Request $request) {
        $id_company = $request->input('id_company', "0");
        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);
        $context = $request->input('context', false);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        if ($id_company !== "0") {
            $filters['id_company'] = $id_company;
        }


        $contacts_rs = ContactsModel::orderBy('last_name')->orderBy('first_name') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $contacts_rs = $contacts_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $contacts_rs = $contacts_rs->where($key, $value) ;
            }
        }

        $total = $contacts_rs->count();
        $contacts_rs_id = $contacts_rs ;


        $contacts = $contacts_rs->limit($limit)->offset($offset)->get();

        if(!$contacts) {
            $contacts = array();
        }



        $ids = [];
        if($total < 500) {
            if ($rows = $contacts_rs_id->select(array("id"))->get()) {
                foreach ($rows as $row) {
                    array_push($ids, $row->id);
                }
            }
        }

        if($context){
            if(!$account_families = AccountFamilies::orderBy('sort')->get()){
                $account_families = array();
            }

            if(!$topologies = Topologies::orderBy('sort')->get()){
                $topologies = array();
            }
        }
        else{
            $account_families = array();
            $topologies = array();
        }

        echo json_encode(array(
            'account_families' => $account_families,
            'topologies' => $topologies,
            'contacts' => $contacts,
            "total" => $total,
            'ids' => $ids
        ));
    }

    public function context() {
        if(!$account_families = AccountFamilies::orderBy('sort')->get()){
            $account_families = array();
        }

        if(!$topologies = Topologies::orderBy('sort')->get()){
            $topologies = array();
        }

        echo json_encode(array('account_families' => $account_families, 'topologies' => $topologies));
    }




    public function get(Request $request) {
        $id = $request->input('id', 0);

        if(!$account_families = AccountFamilies::orderBy('sort')->get()){
            $account_families = array();
        }

        if(!$topologies = Topologies::orderBy('sort')->get()){
            $topologies = array();
        }

        if($contact = ContactsModel::where('id', $id)->first()){
            //$contact->average_order = $this->orders->frequencyOf($id, 'contact');
            //$contact->turnovers = $this->invoices->turnoverByYearsOf($id, 'contact');
        }
        else{
            $contact = array();
        }

        echo json_encode(array('account_families' => $account_families, 'topologies' => $topologies, 'contact' => $contact));
    }

    public function modal(Request $request) {
        $id_company = $request->input('id_company', 0);
        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        if($id_company !== "0") {
            $filters['id_company'] = $id_company;
        }


        $contacts_rs = ContactsModel::orderBy('last_name')->orderBy('first_name') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $contacts_rs = $contacts_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $contacts_rs = $contacts_rs->where($key, $value) ;
            }
        }

        $total = $contacts_rs->count();


        $contacts = $contacts_rs->limit($limit)->offset($offset)->get();

        if(!$contacts) {
            $contacts = array();
        }

        echo json_encode(array("data" => $contacts, "total" => $total));
    }

    public function save() {
        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $contact = new ContactsModel();

        if (isset($data["id"])) {
            $contact = ContactsModel::where('id', $data["id"])->first() ;
        }

        foreach ($data as $key => $value) {
            $contact->$key = $value ;
        }

        $contact->save();

        echo $contact->id;
    }

    public function delete(Request $request) {
        $id = $request->input('id', 0);

        echo json_encode(ContactsModel::where('id', $id)->delete());
    }

    public function make_export(){
        $filters = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }



        $contacts_rs = ContactsModel::orderBy('last_name')->orderBy('first_name') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $contacts_rs = $contacts_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $contacts_rs = $contacts_rs->where($key, $value) ;
            }
        }

        $total = $contacts_rs->count();







        $data = array();
        $data[] = array(
            "Civilité",
            "Nom",
            "Prénom",
            "Type de compte",
            "Topologie",
            "Compagnie",
            "Adresse 1",
            "Adresse 2",
            "Adresse 3",
            "Ville",
            "Code postal",
            "Etat",
            "Pays",
            "Email",
            "Telephone 1",
            "Telephone 2",
            "Mobile",
            "Fax",
            "Assistant",
            "Téléphone assistant",
            "Skype",
            "Twitter",
            "Site Web",
            "Date de naissance",
            "Code NAF",
            "Date de la derniere commande"
        );

        if($total > 0) {
            for ($i = 0; $i < $total; $i += 2500) {


                $contacts_rs = ContactsModel::orderBy('last_name')->orderBy('first_name') ;
                foreach ($filters as $key => $value) {
                    if (strpos($key, " LIKE")) {
                        $key = str_replace(" LIKE", "", $key);
                        $contacts_rs = $contacts_rs->where($key, 'like', '%' . $value . '%') ;
                    } else {
                        $contacts_rs = $contacts_rs->where($key, $value) ;
                    }
                }

                $contacts = $contacts_rs->limit(2500)->offset($i)->get();

                if ($contacts) {
                    foreach($contacts as &$contact) {
                        $data[] = array(
                            $contact->title_name,
                            $contact->last_name,
                            $contact->first_name,
                            $contact->name_account_family,
                            $contact->name_topology,
                            $contact->name_company,
                            $contact->address_1,
                            $contact->address_2,
                            $contact->address_3,
                            $contact->city,
                            $contact->zipcode,
                            $contact->state,
                            $contact->country_name,
                            $contact->email,
                            $contact->phone,
                            $contact->other_phone,
                            $contact->mobile,
                            $contact->fax,
                            $contact->assistant,
                            $contact->assistant_phone,
                            $contact->skype_id,
                            $contact->twitter,
                            $contact->website_url,
                            date('d/m/Y', $contact->date_of_birth),
                            $contact->code_naf_libelle,
                            date('d/m/Y', $contact->last_order)
                        );
                    }
                }
            }

            $writer = new XLSXWriter();

            $writer->writeSheet($data);

            recursive_mkdir(FCPATH . 'tmp/com_zeapps_contact/contacts/');
            $writer->writeToFile(FCPATH . 'tmp/com_zeapps_contact/contacts/contacts.xlsx');

            echo json_encode(true);
        }
        else {
            echo json_encode(false);
        }
    }

    public function get_export(){
        $file_url = FCPATH . 'tmp/com_zeapps_contact/contacts/contacts.xlsx';

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
        readfile($file_url);
    }
}