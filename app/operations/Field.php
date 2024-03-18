<?php
namespace app\operations;

use app\helpers\Help;
use app\helpers\FieldValidator;

/**
 * Field - A class for creating a field for a database
 * @value: The value of the field
 * @validators: The list of validators for the field
 */
class Field
{
    public $value = null;
    public $validators = [];

    public function __construct($value, $validators=[])
    {
        $this->value = Help::clean($value);
        $this->validators = $validators;
    }

    /**
     * validate_field - Run the validators on the field
     * @Returns: a list of errors
     */
    public function validate_field()
    {
        $errors = [];
        foreach ($this->validators as $validator) {
            // Run validator on the field value
            $validator_and_args = explode(':', $validator);
            $validator_func = $validator_and_args[0];
            unset($validator_and_args[0]);
            $error = call_user_func([FieldValidator::class, $validator_func], $this->value, $validator_and_args);
            if ($error){
                $errors[] = $error;
            }
            
        }
        return $errors;
    }


}

class ImageField extends Field
{
    public $target_dir;
    public $uploaded_file_name;

    public function __construct($target_dir, $uploaded_file_name)
    {
        $this->target_dir = SITE_ROOT . $target_dir;
        $this->uploaded_file_name = $uploaded_file_name;
        $this->validators[] = 'validateImageUpload';

    }

    public function validate_field()
    {
        $errors = [];
        $uploaded_file = $_FILES[$this->uploaded_file_name];
        $target_file = $this->target_dir . basename($uploaded_file['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (!$uploaded_file["tmp_name"]){
            $errors[] = "$this->uploaded_file_name is required";
            return $errors;
        }
        
        // Check if image file is a actual image or fake image
        $check = getimagesize($uploaded_file["tmp_name"]);
        if($check == false) {
            $errors[] = "File is not an image.";
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            $errors[] =  "Sorry, file already exists.";
        }

        // Check file size
        if ($uploaded_file["size"] > MAX_FILE_SIZE) {
            $errors[] = "Sorry, Maximum of " . MAX_FILE_SIZE/1000 . " KB allowed.";
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
        if (empty($errors)){
            $target_filename = Help::randomCharacters() . '.' .$imageFileType;
            $target_file = $this->target_dir . $target_filename;
            if (!$this->upload($target_file)){
                $errors[] = "Sorry, there was an error uploading your file.";
            }else {
                $this->value = $target_filename;
            }
        }
        return $errors;
        
    }

    public function upload($target_file){
        $uploaded = move_uploaded_file($_FILES[$this->uploaded_file_name]["tmp_name"], $target_file);
        return $uploaded;
    }
}