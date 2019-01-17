<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;
use App\com_zeapps_contact\Models\Companies as CompaniesModel;
use App\com_zeapps_contact\Models\AccountFamilies;
use App\com_zeapps_contact\Models\Topologies;
use App\com_zeapps_contact\Models\Contacts;

use Zeapps\libraries\XLSXWriter;

class Companies extends Controller
{
    private $sheet_name;

    public function getAll(Request $request){
        $filters = array() ;

        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);
        $context = $request->input('context', false);

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE)) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $companies_rs = CompaniesModel::orderBy('company_name') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $companies_rs = $companies_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $companies_rs = $companies_rs->where($key, $value) ;
            }
        }

        $total = $companies_rs->count();
        $companies_rs_id = $companies_rs ;


        $companies = $companies_rs->limit($limit)->offset($offset)->get();

        if(!$companies) {
            $companies = array();
        }


        $ids = [];
        if($total < 500) {
            $rows = $companies_rs_id->select(array("id"))->get();
            foreach ($rows as $row) {
                array_push($ids, $row->id);
            }
        }

        if($context) {
            $account_families = AccountFamilies::orderBy('sort')->get();
            if (!$account_families) {
                $account_families = array();
            }

            $topologies = Topologies::orderBy('sort')->get();
            if (!$topologies) {
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
            'companies' => $companies,
            'total' => $total,
            'ids' => $ids
        ));
    }

    public function modal(Request $request) {
        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $companies_rs = CompaniesModel::orderBy('company_name') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $companies_rs = $companies_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $companies_rs = $companies_rs->where($key, $value) ;
            }
        }

        $total = $companies_rs->count();


        $companies = $companies_rs->limit($limit)->offset($offset)->get();

        if(!$companies) {
            $companies = array();
        }

        echo json_encode(array("data" => $companies, "total" => $total));
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
            $account_families = [];
        }

        if(!$topologies = Topologies::orderBy('sort')->get()){
            $topologies = [];
        }

        if(!$contacts = Contacts::orderBy('last_name')->where('id_company', $id)->get()){
            $contacts = [];
        }

        if($company = CompaniesModel::where('id', $id)->first()){
            //$company->average_order = $this->orders->frequencyOf($id, 'company');
            //$company->turnovers = $this->invoices->turnoverByYearsOf($id, 'company');
        } else{
            $company = [];
        }

        echo json_encode(array(
            'account_families' => $account_families,
            'topologies' => $topologies,
            'contacts' => $contacts,
            'company' => $company
        ));
    }

    public function save() {
        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $company = new CompaniesModel() ;

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $company = CompaniesModel::where('id', $data["id"])->first() ;
        }

        foreach ($data as $key =>$value) {
            $company->$key = $value ;
        }

        $company->save() ;

        echo $company->id;
    }

    public function delete(Request $request) {
        $id = $request->input('id', 0);

        echo json_encode(CompaniesModel::where('id', $id)->delete());
    }

    public function make_export()
    {
        $companies = CompaniesModel::orderBy('id', 'ASC') ;

        // Filters
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {

            // Get posted data by json
            $data = json_decode(file_get_contents('php://input'), true);

            if (isset($data['company_name LIKE']) && $data['company_name LIKE']) {
                $companies = $companies->where('company_name', 'like', '%' . $data['company_name LIKE'] . '%');
            }

            if (isset($data['id_topology']) && $data['id_topology']) {
                $companies = $companies->where('id_topology', $data['id_topology']);
            }

            if (isset($data['id_account_family']) && $data['id_account_family']) {
                $companies = $companies->where('id_account_family', $data['id_account_family']);
            }

        }

        $companies = $companies->get();

        if ($companies) {

            $header = array("string");

            $row1 = array("Liste des contacts");
            $row2 = array("#", "Nom", "Téléphone", "Ville", "Gestionnaire du compte");

            $writer = new XLSXWriter();

            $this->sheet_name = 'Sheet1';

            $writer->writeSheetHeader($this->sheet_name, $header, $suppress_header_row = true);

            // Formatage
            $format = array('font' => 'Arial',
                'font-size' => 12,
                'font-style' => 'bold,italic',
                'border' => 'top, right, left, bottom',
                'color' => '#000',
                'halign' => 'center');

            $writer->writeSheetRow($this->sheet_name, $row1, $format);

            $format['font-size'] = 10;
            $format['color'] = '#000';

            $writer->writeSheetRow($this->sheet_name, $row2, $format);

            foreach ($companies as $key => $companie) {

                $row3 = array(
                    $companie->id,
                    $companie->company_name,
                    $companie->phone,
                    $companie->billing_city,
                    $companie->name_user_account_manager
                );

                // Formatage
                $format = array('halign'=>'center');

                $writer->writeSheetRow($this->sheet_name, $row3, $format);
            }

            $writer->markMergedCell($this->sheet_name, $start_row = 0, $start_col = 0, $end_row = 0, $end_col = 4);

            // Gnérer une url temporaire unique pour le fichier Excel dans /tmp
            $link = BASEPATH . 'tmp/companies_' . self::generateRandomString() . '.xlsx';
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