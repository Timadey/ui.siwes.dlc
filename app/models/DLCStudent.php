<?php
namespace app\models;

Use app\helpers\Help;
use app\operations\Database;
use app\operations\Field;
use app\operations\ImageField;

class DLCStudent extends Database
{
        public Field $id;
        public string $record_id;
        public Field $surname;
        public Field $other_names;
        public Field $matric_no;
        public Field $level;
        public Field $session_of_entry_to_the_department;
        public Field $marital_status;
        public Field $nationality;
        public Field $permanent_home_address;
        public Field $phone_number;
        public Field $email;
        public Field $faculty;
        public Field $department;
        public Field $name_of_next_of_kin;
        public Field $address_of_next_of_kin;
        public Field $phone_number_of_next_of_kin;
        public Field $date_of_birth;
        public Field $physical_disabilities;
        public Field $sex;
        public Field $language_other_than_english;
        public Field $previous_work_experience;
        public Field $where_previous_work_experience;
        // public Field $bank_name;
        // public Field $bank_account_number;
        // public Field $bank_sortcode;
        public Field $duration;
        public ImageField $passport_link;
        public ImageField $signature_link;
        public Field $request_count;
        public Field $session;
        public int $date;


        public function __construct(Database $db, array $columns = [])
        {
                $this->conn = $db->conn;
                
                $this->id = new Field((int) ($columns['id'] ?? null));
                $this->record_id = Help::randomCharacters(16);
                $this->surname = new Field($columns['surname'] ?? null, ['isRequired']);
                $this->other_names = new Field($columns['other_names'] ?? null, ['isRequired']);
                $this->matric_no = new Field($columns['matric_no'] ?? null, ['isRequired', 'minLength:7']);
                $this->level = new Field((int) ($columns['level'] ?? null), ['isRequired', 'minLength:3', 'maxLength:3', 'either:200,300,400']);
                $this->session_of_entry_to_the_department = new Field($columns['session_of_entry_to_the_department'] ?? null, ['isRequired']);
                $this->marital_status = new Field($columns['marital_status'] ?? null, ['isRequired', 'either:single,married,divorced,widowed']);
                $this->nationality = new Field($columns['nationality'] ?? null, ['isRequired', 'minLength:8', 'maxLength:64']);
                $this->permanent_home_address = new Field($columns['permanent_home_address'] ?? null, ['isRequired', 'maxLength:256']);
                $this->phone_number = new Field($columns['phone_number'] ?? null, ['isRequired', 'validPhone']);
                $this->email = new Field($columns['email'] ?? null, ['isRequired', 'validEmail']);
                $this->faculty = new Field($columns['faculty'] ?? null, ['isRequired']);
                $this->department = new Field($columns['department'] ?? null, ['isRequired']);
                $this->name_of_next_of_kin = new Field($columns['name_of_next_of_kin'] ?? null, ['isRequired']);
                $this->address_of_next_of_kin = new Field($columns['address_of_next_of_kin'] ?? null, ['isRequired']);
                $this->phone_number_of_next_of_kin = new Field($columns['phone_number_of_next_of_kin'] ?? null, ['isRequired', 'validPhone']);
                $this->date_of_birth = new Field($columns['date_of_birth'] ?? null, ['isRequired', 'validDate']);
                $this->physical_disabilities = new Field($columns['physical_disabilities'] ?? null, ['isRequired', 'either:yes,no']);
                $this->sex = new Field($columns['sex'] ?? null, ['isRequired', 'either:male,female']);
                $this->language_other_than_english = new Field($columns['language_other_than_english'] ?? null, ['isRequired']);
                $this->previous_work_experience = new Field($columns['previous_work_experience'] ?? null, ['isRequired', 'either:yes,no']);
                $this->where_previous_work_experience = new Field($columns['where_previous_work_experience'] ?? null);
                // $this->bank_name = new Field($columns['bank_name'] ?? null, ['isRequired']);
                // $this->bank_account_number = new Field($columns['bank_account_number'] ?? null, ['isRequired']);
                // $this->bank_sortcode = new Field($columns['bank_sortcode'] ?? null, ['isRequired']);
                $this->duration = new Field($columns['duration'] ?? null, ['isRequired', 'either:6-month,3-month']);
                $this->passport_link = new ImageField("/uploads/passports/", "passport_link");
                $this->signature_link = new ImageField("/uploads/signatures/", "signature_link");
                $this->request_count = new Field((int) ($columns['request_count'] ?? null));
                $this->date = time();
                $this->session = new Field($columns['session'] ?? null, ['isRequired']);

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
                // Validate matric number
                if (!preg_match('/^E\d{6}$/', $this->matric_no->value)){
                        $errorBag['matric_no'][] = "Matric number must be of form E123456";
                }
                //  Validate Student doesn't exist already
                if (!empty($this->loadStudent())){
                        $errorBag['non_field_errors'][] = "You have already regsitered";
                        $errorBag['matric_no'][] = "Student with matric number exists already";
                }
                // Validate session of entry
                if (!preg_match('/^\d{4}\/\d{4}$/', $this->session_of_entry_to_the_department->value)){
                        $errorBag['session_of_entry_to_the_department'][] = "Session must be of the form 20**/20**";    
                }
               
                return $errorBag;
        }

        public function loadStudent()
        {
                $where = array ('`matric_no`' => ':matric_no');
                $value = array (':matric_no' => $this->matric_no->value);
                $data = $this->dbGetData(null, "`undergraduate_36dlc_training`", null, $where, $value, null);

                return $data[0] ?? null;
        }

        public function getStudent($lookup, $val)
        {
                $val = Help::clean($val);
                $where = array ("`$lookup`" => ":$lookup");
                $value = array (":$lookup" => $val);
                $data = $this->dbGetData(null, "`undergraduate_36dlc_training`", null, $where, $value, null);

                return $data[0] ?? null;
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

                $last_inserted = $this->insertData("`undergraduate_36dlc_training`", [
                    '`record_id`', '`surname`', '`other_names`', '`matric_no`', '`level`', '`session_of_entry_to_the_department`',
                    '`marital_status`', '`nationality`', '`permanent_home_address`', '`phone_number`', '`email`', 
                    '`faculty`', '`department`', '`name_of_next_of_kin`', '`address_of_next_of_kin`', '`phone_number_of_next_of_kin`',
                    '`date_of_birth`', '`physical_disabilities`', '`sex`', '`language_other_than_english`', 
                    '`previous_work_experience`', '`where_previous_work_experience`', '`session`', '`duration`' ,
                    '`signature_link`' ,'`passport_link`', '`date`'
                    
                ], [ // This insertData implementation is not efficient, needs refactoring and optimization - Timothy
                        ':record_id' => $this->record_id,
                        ':surname' => $this->surname->value,
                        ':other_name' => $this->other_names->value,
                        ':matric_no' => $this->matric_no->value,
                        ':level' => $this->level->value,
                        ':session_of_entry_to_the_department' => $this->session_of_entry_to_the_department->value,
                        ':marital_status' => $this->marital_status->value,
                        ':nationality' => $this->nationality->value,
                        ':permanent_home_address' => $this->permanent_home_address->value,
                        ':phone_number' => $this->phone_number->value,
                        ':email' => $this->email->value,
                        ':faculty' => $this->faculty->value,
                        ':department' => $this->department->value,
                        ':name_of_next_of_kin' => $this->name_of_next_of_kin->value,
                        ':address_of_next_of_kin' => $this->address_of_next_of_kin->value,
                        ':phone_number_of_next_of_kin' => $this->phone_number_of_next_of_kin->value,
                        ':date_of_birth' => $this->date_of_birth->value,
                        ':physical_disabilities' => $this->physical_disabilities->value,
                        ':sex' => $this->sex->value,
                        ':language_other_than_english' => $this->language_other_than_english->value,
                        ':previous_work_experience' => $this->previous_work_experience->value,
                        ':where_previous_work_experience' => $this->where_previous_work_experience->value,
                        ':session' => $this->session->value,
                        ':duration' => $this->duration->value,
                        ':signature_link' => $this->signature_link->value,
                        ':passport_link' => $this->passport_link->value,
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
        public function thisObj()
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