<?php

namespace App\com_zeapps_contact\Models;

use Illuminate\Database\Eloquent\Model ;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Capsule\Manager as Capsule;

use Zeapps\Core\ModelHelper;
use Zeapps\Core\iModelExport;
use Zeapps\Core\ModelExportType;
use Zeapps\Core\ObjectHistory;

class Modalities extends Model implements iModelExport {
    use SoftDeletes;

    static protected $_table = 'com_zeapps_contact_modalities';
    protected $table ;

    protected $fieldModelInfo ;

    public function __construct(array $attributes = [])
    {
        $this->table = self::$_table;

        $this->fieldModelInfo = new ModelHelper();
        $this->fieldModelInfo->tinyInteger('type_modality', false, true)->default(0);
        $this->fieldModelInfo->string('id_cheque', 255)->default('');
        $this->fieldModelInfo->tinyInteger('situation', false, true)->default(0);
        $this->fieldModelInfo->string('accounting_account', 255)->default('');
        $this->fieldModelInfo->string('journal', 20)->default('');
        $this->fieldModelInfo->tinyInteger('settlement_type', false, true)->default(0);
        $this->fieldModelInfo->tinyInteger('settlement_date', false, true)->default(0);
        $this->fieldModelInfo->integer('settlement_delay', false, true)->default(0);
        $this->fieldModelInfo->string('export', 255)->default('');
        $this->fieldModelInfo->integer('sort', false, true)->default(0);
        $this->fieldModelInfo->string('code_web', 50)->default("");

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
        $objModelExport->tableLabel = "Modalités" ;
        $objModelExport->fields = $this->getFields() ;
        return $objModelExport;
    }

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