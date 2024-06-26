<?php
namespace app\models;

Use app\helpers\Help;
use app\operations\Database;
use app\operations\Field;

class Company extends Database
{
        public string $table;

        public Field $id;
        public Field $company_name;
        public Field $company_address;
        public Field $course_of_study;
        public Field $city_or_area;
        public Field $state;
        public Field $email;
        public Field $website;
        public Field $phone;
        public int $date;


        public function __construct(Database $db, array $columns = [])
        {
                $this->conn = $db->conn;
                $this->table = 'company_directory';
                
                $this->id = new Field((int) ($columns['id'] ?? null));
                $this->company_name = new Field($columns['company_name'] ?? null, ['isRequired', 'minLength:3', 'maxLength:128']);
                $this->company_address = new Field($columns['company_address'] ?? null, ['isRequired', 'minLength:3', 'maxLength:256']);
                $this->course_of_study = new Field($columns['course_of_study'] ?? null, ['isRequired']);
                $this->city_or_area = new Field(($columns['city_or_area'] ?? null), ['isRequired', 'minLength:3', 'maxLength:128']);
                $this->state = new Field(($columns['state'] ?? null), ['isRequired', 'minLength:3', 'maxLength:128']);
                $this->email = new Field(($columns['email'] ?? null), ['validEmail']);
                $this->website = new Field(($columns['website'] ?? null), ['minLength:3', 'maxLength:128']);
                $this->phone = new Field(($columns['phone'] ?? null), ['validPhone']);

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

        public function filter($lookup_with_value) // Move to abstract model
        {
                if ($lookup_with_value)
                {
                        $where = [
                                "`state`" => ":state",
                                "`city_or_area`" => ":city_or_area",
                                "`course_of_study`" => ":course_of_study",
                        ];
                        $value = [
                                ":state" => Help::prepareLike($lookup_with_value['state']),
                                ":city_or_area" => Help::prepareLike($lookup_with_value['city_or_area']),
                                ":course_of_study" => Help::prepareLike($lookup_with_value['course_of_study']),
                        ];
                        
                        $data = $this->dbGetData(null, "`$this->table`", null, $where, $value, null, null, true);

                        return $data ?? array();
                }
        }

        public function all() {
            $data = $this->dbGetData(null, "`$this->table`", null, null, null, null);
            return $data;
        }

        public function save($update=false)
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
                };
                if ($update == false){

                        $last_inserted = $this->insertData("`$this->table`", [
                            '`company_name`', '`company_address`', '`course_of_study`', '`city_or_area`', '`state`', '`email`',
                            '`website`', '`phone`'
                            
                        ], [ // This insertData implementation is not efficient, needs refactoring and optimization - Timothy
                                ':company_name' => $this->company_name->value,
                                ':address' => $this->company_address->value,
                                ':course_of_study' => $this->course_of_study->value
                                                        ? htmlspecialchars_decode($this->course_of_study->value) 
                                                        : $this->course_of_study->value,
                                ':city_or_area' => $this->city_or_area->value,
                                ':state' => $this->state->value,
                                ':email' => $this->email->value,
                                ':website' => $this->website->value,
                                ':phone' => $this->phone->value,
        
                        ]);
                }else{
                        $last_inserted = $this->updateData("`$this->table`", [
                                '`company_name`=:company_name', '`company_address`=:address', '`course_of_study`=:course_of_study',
                                '`city_or_area`=:city_or_area', '`state`=:state', '`email`=:email', '`website`=:website', '`phone`=:phone',
                        ], [
                                '`id`=:id'
                        ], [ // This insertData implementation is not efficient, needs refactoring and optimization - Timothy
                                ':id' => $this->id->value,
                                ':company_name' => $this->company_name->value,
                                ':address' => $this->company_address->value,
                                ':course_of_study' => $this->course_of_study->value
                                                        ? htmlspecialchars_decode($this->course_of_study->value) 
                                                        : $this->course_of_study->value,
                                ':city_or_area' => $this->city_or_area->value,
                                ':state' => $this->state->value,
                                ':email' => $this->email->value,
                                ':website' => $this->website->value,
                                ':phone' => $this->phone->value,
            
                        ]);   
                }
                
                if ($last_inserted===false) 
                {
                        return $saved_obj;
                }
                // $this->clear();
                $this->id->value = $update == true ? (int) $this->id->value : (int)$last_inserted;
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
            unset($attrs["conn"], $attrs["table"]);
            foreach ($attrs as $attr => $field) {
                $thisObj[$attr] = $field->value ?? $field;
            }
            return (object) $thisObj;

        }

        /***
         * delete - Delete a company using its ID
         * @return error if company not found
         */
        public function delete(){
                $num_deleted = $this->deleteData("`$this->table`",['`id`=:id'], [':id' => $this->id->value]);
                return $num_deleted;
        }
}
?>