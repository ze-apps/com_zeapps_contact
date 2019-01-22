<?php

namespace App\com_zeapps_contact\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelHelper;
use Zeapps\Core\iModelExport;
use Zeapps\Core\ModelExportType;
use Zeapps\Core\ObjectHistory;

class Country extends Model implements iModelExport {
    use SoftDeletes;

    static protected $_table = 'com_zeapps_contact_country';
    protected $table ;

    protected $fieldModelInfo ;

    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;

        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->integer('id', true, true);
        $this->fieldModelInfo->integer('id_zone', false, true)->default(0);
        $this->fieldModelInfo->integer('id_currency', false, true)->default(0);

        $this->fieldModelInfo->string('iso_code', 3)->default('');

        $this->fieldModelInfo->integer('call_prefix', false, true)->default(0);

        $this->fieldModelInfo->tinyInteger('active', false, true)->default(0);
        $this->fieldModelInfo->tinyInteger('contains_states', false, true)->default(0);
        $this->fieldModelInfo->tinyInteger('need_identification_number', false, true)->default(0);
        $this->fieldModelInfo->tinyInteger('need_zip_code', false, true)->default(0);

        $this->fieldModelInfo->string('zip_code_format', 12)->default('');

        $this->fieldModelInfo->tinyInteger('display_tax_label', false, true)->default(0);

        parent::__construct($attributes);
    }

    public static function getSchema() {
        return $schema = Capsule::schema()->getColumnListing(self::$_table) ;
    }

    public function getFields() {
        return $this->fieldModelInfo->getFields();
    }

    public function save(array $options = []) {

        // for history
        $valueOriginal = $this->original ;

        /**** to delete unwanted field ****/
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
        $objModelExport->tableLabel = "Pays" ;
        $objModelExport->fields = $this->getFields() ;
        return $objModelExport;
    }
}