<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/********** CONFIG MENU ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_ze_apps_contact_account_families" ;
$tabMenu["space"] = "com_ze_apps_config" ;
$tabMenu["label"] = "Familles de compte" ;
$tabMenu["fa-icon"] = "tasks" ;
$tabMenu["url"] = "/ng/com_zeapps/account_families" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 35 ;
$menuLeft[] = $tabMenu ;



$tabMenu = array () ;
$tabMenu["id"] = "com_ze_apps_contact_topologies" ;
$tabMenu["space"] = "com_ze_apps_config" ;
$tabMenu["label"] = "Topologies" ;
$tabMenu["fa-icon"] = "tasks" ;
$tabMenu["url"] = "/ng/com_zeapps/topologies" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 36 ;
$menuLeft[] = $tabMenu ;



/********* insert in essential menu *********/
$tabMenu = array () ;
$tabMenu["label"] = "Entreprises" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/companies" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 10 ;
$menuEssential[] = $tabMenu ;


$tabMenu = array () ;
$tabMenu["label"] = "Contacts" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/contacts" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 20 ;
$menuEssential[] = $tabMenu ;






/********** insert in left menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_company" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Entreprises" ;
$tabMenu["fa-icon"] = "address-book" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/companies" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 1 ;
$menuLeft[] = $tabMenu ;


$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_contact" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Contacts" ;
$tabMenu["fa-icon"] = "users" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/contacts" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 2 ;
$menuLeft[] = $tabMenu ;




/********** insert in top menu ************/
$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_company" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Entreprises" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/companies" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 1 ;
$menuHeader[] = $tabMenu ;

$tabMenu = array () ;
$tabMenu["id"] = "com_zeapps_sales_contact" ;
$tabMenu["space"] = "com_ze_apps_sales" ;
$tabMenu["label"] = "Contacts" ;
$tabMenu["url"] = "/ng/com_zeapps_contact/contacts" ;
$tabMenu["access"] = "com_zeapps_contact_read" ;
$tabMenu["order"] = 2 ;
$menuHeader[] = $tabMenu ;


