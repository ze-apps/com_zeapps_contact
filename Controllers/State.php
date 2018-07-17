<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;

use App\com_zeapps_contact\Models\States as StatesModel ;

class State extends Controller
{
    public function modal(Request $request)
    {
        $limit = $request->input('limit', 15);
        $offset = $request->input('offset', 0);

        $filters = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $states_rs = StatesModel::orderBy('name') ;
        foreach ($filters as $key => $value) {
            if (strpos($key, " LIKE")) {
                $key = str_replace(" LIKE", "", $key);
                $states_rs = $states_rs->where($key, 'like', '%' . $value . '%') ;
            } else {
                $states_rs = $states_rs->where($key, $value) ;
            }
        }

        $total = $states_rs->count();


        $states = $states_rs->limit($limit)->offset($offset)->get();

        if(!$states) {
            $states = array();
        }


        echo json_encode(array("data" => $states, "total" => $total));
    }
}