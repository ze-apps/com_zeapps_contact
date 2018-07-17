<?php
use Zeapps\Core\Routeur ;


Routeur::get("/com_zeapps_contact/country/get_all/", 'App\\com_zeapps_contact\\Controllers\\Country@get_all');
Routeur::post("/com_zeapps_contact/country/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\Country@modal');
Routeur::post("/com_zeapps_contact/state/modal/{limit}/{offset}", 'App\\com_zeapps_contact\\Controllers\\State@modal');
