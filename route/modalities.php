<?php
use Zeapps\Core\Routeur ;





Routeur::get("/com_zeapps_contact/modalities/config", 'App\\com_zeapps_contact\\Controllers\\Modalities@config');
Routeur::get("/com_zeapps_contact/modalities/form_modal", 'App\\com_zeapps_contact\\Controllers\\Modalities@form_modal');
Routeur::get("/com_zeapps_contact/modalities/get/{id}", 'App\\com_zeapps_contact\\Controllers\\Modalities@get');
Routeur::get("/com_zeapps_contact/modalities/getAll/", 'App\\com_zeapps_contact\\Controllers\\Modalities@getAll');
Routeur::post("/com_zeapps_contact/modalities/save", 'App\\com_zeapps_contact\\Controllers\\Modalities@save');
Routeur::post("/com_zeapps_contact/modalities/delete/{id}", 'App\\com_zeapps_contact\\Controllers\\Modalities@delete');


