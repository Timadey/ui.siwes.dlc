<?php
namespace app\helpers;

use app\helpers\Validator;

class FieldValidator extends Validator
{
        public static function either($value, ...$list){
                $list = explode(',', $list[0][1]);
                $l = implode(', ', $list);
                if (!in_array($value, $list)){
                        return "Allowed values include $l";    
                }
        }
        public static function isRequired($value, ...$kwargs){
                if (strlen($value)===0){
                        return "This field is required";
                }
        }

        public static function minLength($value, ...$min){
                if ($value){
                        $val = "$value";
                        $m = (int) $min[0][1];
                        if (strlen($val) < $m){
                            return "This field should not be less than $m characters long";
                        }
                }
        }

        public static function maxLength($value, ...$max){
                if ($value){

                        $val = "$value";
                        $m = (int) $max[0][1];
                        if (strlen($val) > $m){
                        return "This field can only be $m characters long";
                        }
                }
        }

        public static function validPhone($value, ...$kwargs){
                if ($value){
                        if (!preg_match('/^(?:080|081|090|091|070)(?:\d{8})$/', $value)){
                                return "Phone number must be of format 08012345678";
                        }
                }

        }

        public static function validEmail($value, ...$kwargs){
                if ($value){

                        if (filter_var($value, FILTER_VALIDATE_EMAIL) == false){
                                return "Please use a valid email";
                        }
                }

        }

        public static function validDate($value, ...$kwargs){
                if ($value){

                        if (strtotime($value) == false){
                                return "Date format is not correct";
                        }
                }

        }

        public static function validateImageUpload($uploaded_file_name, $max_size = 500000){
                $errors = [];
                $uploaded_file = $_FILES[$uploaded_file_name];
                // $target_file = $this->target_dir . basename($uploaded_file['name']);
                $imageFileType = strtolower(pathinfo($uploaded_file['name'], PATHINFO_EXTENSION));
                
                // Check if image file is a actual image or fake image
                $check = getimagesize($uploaded_file["tmp_name"]);
                if($check == false) {
                $errors[] = "File is not an image.";
                }

                // Check if file already exists
                // if (file_exists($target_file)) {
                // $errors[] =  "Sorry, file already exists.";
                // }

                // Check file size
                if ($uploaded_file["size"] > $max_size) {
                $errors[] = "Sorry, your file is too large.";
                }

                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif" ) {
                $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                }
        }
}

?>