<?php
use Zeapps\Core\Routeur ;


Routeur::get("/com_zeapps_contact/code_naf/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@modal');
Routeur::get("/com_zeapps_contact/code_naf/modal_code_naf", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@modal_code_naf');
Routeur::get("/com_zeapps_contact/code_naf/get/{id}", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@get');
Routeur::post("/com_zeapps_contact/code_naf/getAll", 'App\\com_zeapps_contact\\Controllers\\CodeNaf@getAll');
