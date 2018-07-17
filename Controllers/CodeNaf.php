<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;

use App\com_zeapps_contact\Models\CodeNaf as CodeNafModel ;

class CodeNaf extends Controller
{
    public function modal_code_naf()
    {
        $data = array();
        return view("code_naf/modalCode_naf", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function get(Request $request) {
        $id = $request->input('id', 15);
        echo json_encode(CodeNafModel::where('id', $id)->first());
    }

    public function getAll() {
        $code_naf = CodeNafModel::orderBy('code_naf')->get();

        if ($code_naf == false) {
            echo json_encode(array());
        } else {
            echo json_encode($code_naf);
        }

    }

    public function modal(Request $request)
    {
        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $code_naf_rs = CodeNafModel::orderBy('code_naf') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $code_naf_rs = $code_naf_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $code_naf_rs = $code_naf_rs->where($key, $value) ;
            }
        }

        $total = $code_naf_rs->count();

        $code_naf = $code_naf_rs->limit($limit)->offset($offset)->get();

        if(!$code_naf) {
            $code_naf = array();
        }

        echo json_encode(array("data" => $code_naf, "total" => $total));
    }
}