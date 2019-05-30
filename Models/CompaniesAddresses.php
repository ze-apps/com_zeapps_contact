<?php

namespace App\com_zeapps_contact\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelHelper;
use Zeapps\Core\iModelExport;
use Zeapps\Core\ModelExportType;
use Zeapps\Core\ObjectHistory;

class CompaniesAddresses extends Model implements iModelExport{
    use SoftDeletes;

    static protected $_table = 'com_zeapps_contact_companies_address';
    protected $table ;

    protected $fieldModelInfo ;


    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;


        // stock la liste des champs
        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->increments('id');
        $this->fieldModelInfo->integer('id_company', false, true)->default(0);
        $this->fieldModelInfo->string('company_name', 255)->default("");
        $this->fieldModelInfo->string('title_name', 30)->default("");
        $this->fieldModelInfo->string('first_name', 50)->default("");
        $this->fieldModelInfo->string('last_name', 50)->default("");
        $this->fieldModelInfo->string('address_1', 100)->default("");
        $this->fieldModelInfo->string('address_2', 100)->default("");
        $this->fieldModelInfo->string('address_3', 100)->default("");
        $this->fieldModelInfo->string('city', 100)->default("");
        $this->fieldModelInfo->string('zipcode', 50)->default("");
        $this->fieldModelInfo->integer('state_id')->default(0);
        $this->fieldModelInfo->string('state', 100)->default("");
        $this->fieldModelInfo->integer('country_id', false, true)->default(0);
        $this->fieldModelInfo->string('country_name', 100)->default("");
        $this->fieldModelInfo->string('email', 255)->default("");
        $this->fieldModelInfo->string('phone', 25)->default("");
        $this->fieldModelInfo->string('fax', 25)->default("");

        $this->fieldModelInfo->timestamps();
        $this->fieldModelInfo->softDeletes();

        parent::__construct($attributes);
    }

    public static function getSchema() {
        return $schema = Capsule::schema()->getColumnListing(self::$_table) ;
    }

    public function getFields() {
        return $this->fieldModelInfo->getFields();
    }

    public function save(array $options = []) {

        /******** clean data **********/
        $this->fieldModelInfo->cleanData($this) ;

        // for history
        $valueOriginal = $this->original ;

        /**** to delete unwanted field ****/
        $this->fieldModelInfo->removeFieldUnwanted($this) ;
        $schema = self::getSchema();
        foreach ($this->getAttributes() as $key => $value) {
            if (!in_array($key, $schema)) {
                //echo $key . "\n" ;
                unset($this->$key);
            }
        }
        /**** end to delete unwanted field ****/

        $reponse = parent::save($options) ;

        // save to ObjectHistory
        ObjectHistory::addHistory(self::$_table, $this->id, $this->getFields(), $this, $valueOriginal);

        return $reponse;
    }

    public function delete() {

        // for history
        $valueOriginal = $this->original;

        $deleted = parent::delete();

        // save to ObjectHistory
        if ($deleted) {
            ObjectHistory::addHistory(self::$_table, $this->id, $this->getFields(), null, $valueOriginal);
            return true;
        }

        return false;
    }

    public function getModelExport() : ModelExportType {
        $objModelExport = new ModelExportType() ;
        $objModelExport->table = $this->table ;
        $objModelExport->tableLabel = "Entreprise addresse" ;
        $objModelExport->fields = $this->getFields() ;
        return $objModelExport;
    }
}