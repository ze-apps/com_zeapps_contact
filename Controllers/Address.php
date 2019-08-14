<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;

use App\com_zeapps_contact\Models\Address as AddressModel ;

class Address extends Controller
{
    public function get(Request $request) {
        $filters = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE)) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $id_company = isset($filters["id_company"])?$filters["id_company"]:0;
        $id_address_company = isset($filters["id_address_company"])?$filters["id_address_company"]:0;
        $id_contact = isset($filters["id_contact"])?$filters["id_contact"]:0;
        $id_address_contact = isset($filters["id_address_contact"])?$filters["id_address_contact"]:0;
        $typeAdresse = isset($filters["typeAdresse"])?$filters["typeAdresse"]:"billing";

        $address = AddressModel::getAddresseObject($id_company, $id_address_company, $id_contact, $id_address_contact, $typeAdresse) ;
        echo json_encode($address);
    }


    public function getText(Request $request) {
        $filters = [];

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && (isset($_SERVER['CONTENT_TYPE']) && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE)) {
            // POST is actually in json format, do an internal translation
            $filters = json_decode(file_get_contents('php://input'), true);
        }

        $id_company = isset($filters["id_company"])?$filters["id_company"]:0;
        $id_address_company = isset($filters["id_address_company"])?$filters["id_address_company"]:0;
        $id_contact = isset($filters["id_contact"])?$filters["id_contact"]:0;
        $id_address_contact = isset($filters["id_address_contact"])?$filters["id_address_contact"]:0;
        $typeAdresse = isset($filters["typeAdresse"])?$filters["typeAdresse"]:"billing";

        echo AddressModel::getTextAddress($id_company, $id_address_company, $id_contact, $id_address_contact, $typeAdresse);
    }
}
