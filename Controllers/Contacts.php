<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\ModelRequest;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\libraries\XLSXWriter;

use App\com_zeapps_contact\Models\Contacts as ContactsModel;
use App\com_zeapps_contact\Models\AccountFamilies;
use App\com_zeapps_contact\Models\Topologies;

class Contacts extends Controller
{

    private $sheet_name;

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

    public function make_export()
    {
        $contacts = ContactsModel::orderBy('id', 'ASC') ;

        // Filters
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {

            // Get posted data by json
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['last_name LIKE']) && $data['last_name LIKE']) {
                $contacts = $contacts->where('last_name', 'like', '%' . $data['last_name LIKE'] . '%');
            }

            if (isset($data['first_name LIKE']) && $data['first_name LIKE']) {
                $contacts = $contacts->where('first_name', 'like', '%' . $data['first_name LIKE'] . '%');
            }

            if (isset($data['id_topology']) && $data['id_topology']) {
                $contacts = $contacts->where('id_topology', $data['id_topology']);
            }

            if (isset($data['id_account_family']) && $data['id_account_family']) {
                $contacts = $contacts->where('id_account_family', $data['id_account_family']);
            }

        }

        $contacts = $contacts->get();

        if ($contacts) {

            $header = array("string");

            $row1 = array("Liste des contacts");
            $row2 = array("#", "Nom", "Téléphone", "Code postal", "Ville", "Etat", "Pays", "Gestionnaire du compte");

            $writer = new XLSXWriter();

            $this->sheet_name = 'Sheet1';

            $writer->writeSheetHeader($this->sheet_name, $header, $suppress_header_row = true);

            // Formatage
            $format = array('font' => 'Arial',
                'font-size' => 12,
                'font-style' => 'bold,italic',
                'border' => 'top, right, left, bottom',
                'color' => '#000',
                'halign'=>'center');

            $writer->writeSheetRow($this->sheet_name, $row1, $format);

            $format['font-size'] = 10;
            $format['color'] = '#000';
            $format['width'] = 'max-content';

            $writer->writeSheetRow($this->sheet_name, $row2, $format);

            foreach ($contacts as $key => $contact) {

                $row3 = array(
                    $contact->id,
                    $contact->last_name . ' ' . $contact->first_name,
                    $contact->phone,
                    $contact->zipcode,
                    $contact->city,
                    $contact->state,
                    $contact->country_name,
                    $contact->name_user_account_manager
                );

                // Formatage
                $format = array('halign'=>'center');

                $writer->writeSheetRow($this->sheet_name, $row3, $format);
            }

            $writer->markMergedCell($this->sheet_name, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = 4);

            // Gnérer une url temporaire unique pour le fichier Excel dans /tmp
            $link = BASEPATH . 'tmp/contacts_' . self::generateRandomString() . '.xlsx';
            $writer->writeToFile($link);

            echo json_encode(array(
                'link' => $link
            ));

        } else {

            echo json_encode(false);
        }
    }

    public function get_export(Request $request)
    {
        $link = $request->input('link', 0);

        // Verifier si l'url commence par /tmp/ et ne contient pas ..
        if ( !strpos($link, '/tmp/') || (strpos($link, '/tmp/') && strpos($link, '/tmp/') == 0) || strpos($link, '..') ) {
            abort(404);
        }

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($link) . "\"");
        header('Content-Length: '. filesize($link));
        header('Expires: 0');
        header('Pragma: no-cache');

        readfile($link);

        // Suppression du fichier zip sur le serveur
        unlink($link);
    }

    public static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

}