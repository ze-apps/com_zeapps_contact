<?php

/********** CONFIG MENU ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_ze_apps_contact_account_families" ;
$tabMenu["space"] = "com_ze_apps_config" ;
$tabMenu["label"] = "Type de compte" ;
$tabMenu["fa-icon"] = "tasks" ;
$tabMenu["url"] = "/ng/com_zeapps/account_families" ;
$tabMenu["access"] = "com_ze_apps_contact_com_read" ;
$tabMenu["order"] = 35 ;
$menuLeft[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_ze_apps_modalities" ;
$tabMenu["space"] = "com_ze_apps_config" ;
$tabMenu["label"] = "Modalités" ;
$tabMenu["fa-icon"] = "money-bill-wave" ;
$tabMenu["url"] = "/ng/com_zeapps/modalities" ;
$tabMenu["access"] = "com_zeapps_crm_read" ;
$tabMenu["order"] = 40 ;
$menuLeft[] = $tabMenu ;



/********* insert in essential menu *********/
$tabMenu = array () ;
$tabMenu["label"] = "Entreprises" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/companies" ;
$tabMenu["access"] = "com_ze_apps_contact_com_read" ;
$tabMenu["order"] = 10 ;
$menuEssential[] = $tabMenu ;


$tabMenu = array () ;
$tabMenu["label"] = "Contacts" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/contacts" ;
$tabMenu["access"] = "com_ze_apps_contact_com_read" ;
$tabMenu["order"] = 20 ;
$menuEssential[] = $tabMenu ;






/********** insert in left menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_company" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Entreprises" ;
$tabMenu["fa-icon"] = "address-book" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/companies" ;
$tabMenu["access"] = "com_ze_apps_contact_com_read" ;
$tabMenu["order"] = 1 ;
$menuLeft[] = $tabMenu ;


$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_contact" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Contacts" ;
$tabMenu["fa-icon"] = "users" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/contacts" ;
$tabMenu["access"] = "com_ze_apps_contact_com_read" ;
$tabMenu["order"] = 2 ;
$menuLeft[] = $tabMenu ;




/********** insert in top menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_company" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Entreprises" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/companies" ;
$tabMenu["access"] = "com_ze_apps_contact_com_read" ;
$tabMenu["order"] = 1 ;
$menuHeader[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_contact" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Contacts" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/contacts" ;
$tabMenu["access"] = "com_ze_apps_contact_com_read" ;
$tabMenu["order"] = 2 ;
$menuHeader[] = $tabMenu ;


