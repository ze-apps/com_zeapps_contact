<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;
use App\com_zeapps_contact\Models\Companies as CompaniesModel;

class Companies extends Controller
{
    public function getAll($limit = 15, $offset = 0, $context = false){
        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }


        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;
        echo "********** TODO ICI **************" ;

        if(!$companies = $this->companies->limit($limit, $offset)->order_by('company_name')->all($filters)){
            $companies = [];
        }
        $total = $this->companies->count($filters);

        $ids = [];
        if($total < 500) {
            if ($rows = $this->companies->get_ids($filters)) {
                foreach ($rows as $row) {
                    array_push($ids, $row->id);
                }
            }
        }

        if($context) {
            $this->load->model('Zeapps_account_families', 'account_families');
            $this->load->model('Zeapps_topologies', 'topologies');

            if (!$account_families = $this->account_families->all()) {
                $account_families = [];
            }

            if (!$topologies = $this->topologies->all()) {
                $topologies = [];
            }
        }
        else{
            $account_families = [];
            $topologies = [];
        }

        echo json_encode(array(
            'account_families' => $account_families,
            'topologies' => $topologies,
            'companies' => $companies,
            'total' => $total,
            'ids' => $ids
        ));



        $data = array();
        return view("companies/search", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }
}