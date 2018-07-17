<?php

namespace App\com_zeapps_contact\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modalities extends Model {
    use SoftDeletes;

    protected $table = 'com_zeapps_contact_modalities';

    public static function getAll() {
        return self::select('com_zeapps_contact_modalities.*', 'com_zeapps_contact_modalities_lang.label', 'com_zeapps_contact_modalities_lang.label_doc')
            ->join('com_zeapps_contact_modalities_lang', 'com_zeapps_contact_modalities.id', '=', 'com_zeapps_contact_modalities_lang.id_modality')
            ->orderBy('com_zeapps_contact_modalities.sort')
            ->where('com_zeapps_contact_modalities_lang.id_lang', 1)
            ->get();
    }

    public static function get($id) {
        return self::select('com_zeapps_contact_modalities.*', 'com_zeapps_contact_modalities_lang.label', 'com_zeapps_contact_modalities_lang.label_doc')
            ->join('com_zeapps_contact_modalities_lang', 'com_zeapps_contact_modalities.id', '=', 'com_zeapps_contact_modalities_lang.id_modality')
            ->orderBy('com_zeapps_contact_modalities.sort')
            ->where('com_zeapps_contact_modalities.id', $id)
            ->where('com_zeapps_contact_modalities_lang.id_lang', 1)
            ->first();
    }
}