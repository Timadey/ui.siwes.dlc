<?php
namespace app\models;

Use app\helpers\Help;
use app\operations\Database;
use app\operations\Field;

class Company extends Database
{
        public string $table;

        public Field $id;
        public Field $name;
        public Field $address;
        public Field $specialization;
        public Field $employer;
        public int $date;


        public function __construct(Database $db, array $columns = [])
        {
                $this->conn = $db->conn;
                $this->table = 'company_directory';
                
                $this->id = new Field((int) ($columns['id'] ?? null));
                $this->name = new Field($columns['name'] ?? null, ['isRequired', 'minLength:3', 'maxLength:128']);
                $this->address = new Field($columns['address'] ?? null, ['isRequired', 'minLength:3', 'maxLength:256']);
                $this->specialization = new Field($columns['specialization'] ?? null, ['isRequired']);
                $this->employer = new Field((int) ($columns['employer'] ?? null), ['isRequired', 'minLength:3', 'maxLength:128']);
                $this->date = time();

                parent::__construct();
        }

        /**
         * validate - Takes each field and run it validators on it if not empty
         * @Return a dictionary of list of errors
         */
        public function validate()
        {
            // For each field of this object
            $attrs = get_object_vars($this);
            unset($attrs["conn"]);
            $errorBag = [];
            foreach ($attrs as $attr => $field) {
                // Run the list of validators on the field
                if (!empty($field->validators))
                {
                        $errors = $field->validate_field();
                        if (!empty($errors)){
                                $errorBag[$attr] = $errors;
                        }
                
                // var_dump( $field->validators);
                    
                }
            }
            // Run extra validations
            $errorBag = $this->validateColumns($errorBag);
            return (object) $errorBag;
        }

        public function validateColumns($errorBag)
        {
                return $errorBag;
        }

        public function load() // Create an abstract model and move this to it
        {
                $where = array ('`id`' => ':id');
                $value = array (':id' => $this->id->value);
                $data = $this->dbGetData(null, "`$this->table`", null, $where, $value, null);

                return $data[0] ?? null;
        }

        public function get($lookup, $val) // Create an abstract model and move this to it
        {
                $val = Help::clean($val);
                $where = array ("`$lookup`" => ":$lookup");
                $value = array (":$lookup" => $val);
                $data = $this->dbGetData(null, "`$this->table`", null, $where, $value, null);

                return $data[0] ?? null;
        }

        public function all() {
            $data = $this->dbGetData(null, "`$this->table`", null, null, null, null);
            return $data;
        }

        public function save()
        {
                // Run validation logic
                $saved_obj = (object) [
                        'last_inserted' => null,
                        'errors' => null
                ];
                $error = $this->validate();
                if (!empty(get_object_vars($error)))
                {
                        $saved_obj->errors = $error;
                        return $saved_obj;
                }

                $last_inserted = $this->insertData("`$this->table`", [
                    '`id`', '`name`', '`address`', '`specialization`', '`employer`', '`date`'
                    
                ], [ // This insertData implementation is not efficient, needs refactoring and optimization - Timothy
                        ':name' => $this->name,
                        ':address' => $this->address->value,
                        ':specialization' => $this->specialization->value,
                        ':employer' => $this->employer->value,
                        ':date' => $this->date,

                ]);
                
                if ($last_inserted===false) 
                {
                        return $saved_obj;
                }
                // $this->clear();
                $this->id->value = (int)$last_inserted;
                $saved_obj->last_inserted = $this->id;
                $saved_obj->inserted_obj = $this->thisObj();
                return $saved_obj;
        }
        /**
         * thisObj
         * @Return a this object without the validors
         */
        public function thisObj() // Create an abstract model and move this to it
        {
            // For each field of this object
            $thisObj = [];
            $attrs = get_object_vars($this);
            unset($attrs["conn"]);
            foreach ($attrs as $attr => $field) {
                $thisObj[$attr] = $field->value ?? $field;
            }
            return (object) $thisObj;

        }
}
?>