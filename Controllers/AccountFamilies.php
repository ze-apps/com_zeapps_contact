<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;

use App\com_zeapps_contact\Models\AccountFamilies as AccountFamiliesModel ;

class AccountFamilies extends Controller
{
    public function config()
    {
        $data = array();
        return view("account_families/config", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function form_modal(){
        $data = array();
        return view("account_families/form_modal", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function get_all() {
        $account_families = AccountFamiliesModel::all();

        if ($account_families == false) {
            echo json_encode(array());
        } else {
            echo json_encode($account_families);
        }
    }

    public function save(Request $request) {
        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $accountFamilies = new AccountFamiliesModel() ;

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $accountFamilies = AccountFamiliesModel::where('id', $data["id"])->first();
        }

        foreach ($data as $key => $value) {
            $accountFamilies->$key = $value ;
        }
        $accountFamilies->save();

        echo $accountFamilies->id;
    }

    /*public function save_all(){
        $this->load->model("Zeapps_account_families", "account_families");

        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        if($data && is_array($data)){
            foreach($data as $account_families){
                $this->account_families->update($account_families, $account_families['id']);
            }
            echo json_encode('OK');
        }
        else{
            echo json_encode('false');
        }
    }*/

    public function delete(Request $request) {
        $id = $request->input('id', 0);

        $accountFamiliesModel = AccountFamiliesModel::where('id', $id)->first();
        $deleted = $accountFamiliesModel->delete();

        echo json_encode($deleted);
    }
}
