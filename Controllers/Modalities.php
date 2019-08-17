<?php

namespace App\com_zeapps_contact\Controllers;

use Zeapps\Core\Controller;
use Zeapps\Core\Request;
use Zeapps\Core\Session;

use App\com_zeapps_contact\Models\Modalities as ModalitiesModel ;
use App\com_zeapps_contact\Models\ModalitiesLang ;

class Modalities extends Controller
{
    public function config()
    {
        $data = array();
        return view("modalities/config", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }

    public function form_modal()
    {
        $data = array();
        return view("modalities/form_modal", $data, BASEPATH . 'App/com_zeapps_contact/views/');
    }


    public function getAll() {
        echo json_encode(ModalitiesModel::getAll());
    }

    public function get($id) {
        echo json_encode(ModalitiesModel::get($id));
    }

    public function save() {
        // constitution du tableau
        $data = array() ;

        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'post') === 0 && stripos($_SERVER['CONTENT_TYPE'], 'application/json') !== FALSE) {
            // POST is actually in json format, do an internal translation
            $data = json_decode(file_get_contents('php://input'), true);
        }

        $modalities = new ModalitiesModel() ;
        $modalitiesLang = new ModalitiesLang() ;

        if (isset($data["id"]) && is_numeric($data["id"])) {
            $modalities = ModalitiesModel::where("id", $data["id"])->first() ;
            $modalitiesLang = ModalitiesLang::where("id_modality", $data["id"])->where('id_lang', 1)->first() ; // TODO : traiter les différentes langues, attention seul le francais est enregistré
        }

        foreach ($data as $key => $value) {
            $modalities->$key = $value;
            $modalitiesLang->$key = $value;
        }

        $modalities->save();

        $modalitiesLang->id_lang = 1 ; // TODO : traiter les différentes langues, attention seul le francais est enregistré
        $modalitiesLang->id_modality = $modalities->id ;
        $modalitiesLang->save();

        echo json_encode($modalities->id);
    }

    public function delete(Request $request) {
        $id = $request->input('id', 0);
        ModalitiesLang::where('id_modality', $id)->delete();
        $modalityModel = ModalitiesModel::where('id', $id)->first();
        echo json_encode($modalityModel->delete());
    }
}