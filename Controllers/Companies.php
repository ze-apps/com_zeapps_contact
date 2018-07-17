<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;
use App\com_zeapps_contact\Models\Companies as CompaniesModel;
use App\com_zeapps_contact\Models\AccountFamilies;
use App\com_zeapps_contact\Models\Topologies;
use App\com_zeapps_contact\Models\Contacts;
use Zeapps\libraries\PHPExcel;

class Companies extends Controller
{
    public function getAll(Request $request){
        $filters = array() ;

        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);
        $context = $request->input('context', false);

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

        if(!$contacts = Contacts::orderBy('last_name')->get()){
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

    public function make_export(){
        $filters = [];

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

        $companies = $companies_rs->get();



        if($companies){

            $objPHPExcel = new PHPExcel();

            $objPHPExcel->getActiveSheet()->setCellValue('A1', "Raison Sociale");
            $objPHPExcel->getActiveSheet()->setCellValue('B1', "Compagnie mère");
            $objPHPExcel->getActiveSheet()->setCellValue('C1', "Type de compte");
            $objPHPExcel->getActiveSheet()->setCellValue('D1', "Topologie");
            $objPHPExcel->getActiveSheet()->setCellValue('E1', "Domaine d'activité");
            $objPHPExcel->getActiveSheet()->setCellValue('F1', "Chiffre d'affaires");
            $objPHPExcel->getActiveSheet()->setCellValue('G1', "Adresse de facturation 1");
            $objPHPExcel->getActiveSheet()->setCellValue('H1', "Adresse 2");
            $objPHPExcel->getActiveSheet()->setCellValue('I1', "Adresse 3");
            $objPHPExcel->getActiveSheet()->setCellValue('J1', "Ville");
            $objPHPExcel->getActiveSheet()->setCellValue('K1', "Code postal");
            $objPHPExcel->getActiveSheet()->setCellValue('L1', "Etat");
            $objPHPExcel->getActiveSheet()->setCellValue('M1', "Pays");
            $objPHPExcel->getActiveSheet()->setCellValue('N1', "Adresse de livraison 1");
            $objPHPExcel->getActiveSheet()->setCellValue('O1', "Adresse 2");
            $objPHPExcel->getActiveSheet()->setCellValue('P1', "Adresse 3");
            $objPHPExcel->getActiveSheet()->setCellValue('Q1', "Ville");
            $objPHPExcel->getActiveSheet()->setCellValue('R1', "Code postal");
            $objPHPExcel->getActiveSheet()->setCellValue('S1', "Etat");
            $objPHPExcel->getActiveSheet()->setCellValue('T1', "Pays");
            $objPHPExcel->getActiveSheet()->setCellValue('U1', "Email");
            $objPHPExcel->getActiveSheet()->setCellValue('V1', "Telephone");
            $objPHPExcel->getActiveSheet()->setCellValue('W1', "Fax");
            $objPHPExcel->getActiveSheet()->setCellValue('X1', "SiteWeb");
            $objPHPExcel->getActiveSheet()->setCellValue('Y1', "Code NAF");
            $objPHPExcel->getActiveSheet()->setCellValue('Z1', "SIRET");

            foreach ($companies as $key => $company) {
                $i = $key + 2;
                $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $company->company_name);
                $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $company->name_parent_company);
                $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $company->name_account_family);
                $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $company->name_topology);
                $objPHPExcel->getActiveSheet()->setCellValue('E' . $i, $company->name_activity_area);
                $objPHPExcel->getActiveSheet()->setCellValue('F' . $i, $company->turnover);
                $objPHPExcel->getActiveSheet()->setCellValue('G' . $i, $company->billing_address_1);
                $objPHPExcel->getActiveSheet()->setCellValue('H' . $i, $company->billing_address_2);
                $objPHPExcel->getActiveSheet()->setCellValue('I' . $i, $company->billing_address_3);
                $objPHPExcel->getActiveSheet()->setCellValue('J' . $i, $company->billing_city);
                $objPHPExcel->getActiveSheet()->setCellValue('K' . $i, $company->billing_zipcode);
                $objPHPExcel->getActiveSheet()->setCellValue('L' . $i, $company->billing_state);
                $objPHPExcel->getActiveSheet()->setCellValue('M' . $i, $company->billing_country_name);
                $objPHPExcel->getActiveSheet()->setCellValue('N' . $i, $company->delivery_address_1);
                $objPHPExcel->getActiveSheet()->setCellValue('O' . $i, $company->delivery_address_2);
                $objPHPExcel->getActiveSheet()->setCellValue('P' . $i, $company->delivery_address_3);
                $objPHPExcel->getActiveSheet()->setCellValue('Q' . $i, $company->delivery_city);
                $objPHPExcel->getActiveSheet()->setCellValue('R' . $i, $company->delivery_zipcode);
                $objPHPExcel->getActiveSheet()->setCellValue('S' . $i, $company->delivery_state);
                $objPHPExcel->getActiveSheet()->setCellValue('T' . $i, $company->delivery_country_name);
                $objPHPExcel->getActiveSheet()->setCellValue('U' . $i, $company->email);
                $objPHPExcel->getActiveSheet()->setCellValue('V' . $i, $company->phone);
                $objPHPExcel->getActiveSheet()->setCellValue('W' . $i, $company->fax);
                $objPHPExcel->getActiveSheet()->setCellValue('X' . $i, $company->website_url);
                $objPHPExcel->getActiveSheet()->setCellValue('Y' . $i, $company->code_naf_libelle);
                $objPHPExcel->getActiveSheet()->setCellValue('Z' . $i, $company->company_number);
            }

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

            recursive_mkdir(FCPATH . 'tmp/com_zeapps_contact/companies/');

            $objWriter->save(FCPATH . 'tmp/com_zeapps_contact/companies/companies.xlsx');

            echo json_encode(true);
        }
        else {
            echo json_encode(false);
        }
    }

    public function get_export(){
        $file_url = FCPATH . 'tmp/com_zeapps_contact/companies/companies.xlsx';

        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary");
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\"");
        readfile($file_url);
    }
}