<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;
use App\com_zeapps_contact\Models\AccountingNumbers as AccountingNumbersModel ;

class AccountingNumbers extends Controller
{
    public function form_modal()
    {
        $data = array();
        return view("accounting_numbers/form_modal", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function modal(Request $request){
        $filters = array() ;

        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $accounting_rs = AccountingNumbersModel::orderBy('number', 'ASC') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $accounting_rs = $accounting_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $accounting_rs = $accounting_rs->where($key, $value) ;
            }
        }

        $total = $accounting_rs->count();


        $accounting_numbers = $accounting_rs->limit($limit)->offset($offset)->get();

        if(!$accounting_numbers) {
            $accounting_numbers = array();
        }

        echo json_encode(array("data" => $accounting_numbers, "total" => $total));
    }

    public function save(){
        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $accountingNumbers = new AccountingNumbersModel() ;

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $accountingNumbers = AccountingNumbersModel::where('id', $data["id"])->first();
        }

        foreach ($data as $key => $value) {
            $accountingNumbers->$key = $value ;
        }
        $accountingNumbers->save();

        echo $accountingNumbers->id;
    }
}