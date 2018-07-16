<?php

namespace App\com_zeapps_contact\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModalitiesLang extends Model {
    use SoftDeletes;

    protected $table = 'com_zeapps_contact_modalities_lang';
}