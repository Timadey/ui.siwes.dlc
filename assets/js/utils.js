export function getFormObject(fieldArray){
    // This function is deprecated and uses fieldArray 
    // which does not work well with forms with files.
    // Please use FormData class instead for create form name and value pair
    // Accepts a array of field objects with attribute name and value
    // return an object with field name and the value
    let formObject = {};
    fieldArray.forEach(field => {
        formObject[field.name] = field.value;
    });
    return formObject;
}

export function getJqFormFields(formData) {  
    // Accepts a form data with attribute name and value
    // Returns an object with attribute field name and equivalent jquery object
    let jqFormFields = {};
    for (const field of formData.keys()) {
        jqFormFields[field] = $(`#${field}`);
      }
    return jqFormFields;
}

export function _getJqFormFields(fieldArray) {
    // This function is deprecated and uses fieldArray 
    // which does not work well with forms with files. Use getJqFormFields instead
    // Accepts and array of field objects with attribute name and value
    // Returns an object with attribute field name and equivalent jquery object
    let jqFormFields = {};
    fieldArray.forEach(field => {
        jqFormFields[field.name] = $(`#${field.name}`);
    });
    return jqFormFields;
}

export function fireAlert(type, title, text){
    return Swal.fire({
        icon:type,
        title:title,
        text:text,
    });
}

export function handleFieldErrors(fields, errors){
    let errorField;
    for (const error in errors) {
        if (error == 'non_field_errors'){
            if (error in errors){
                let err = errors[error].join('\n')
                fireAlert('error', 'Oh No!', err);
            }
        }else{
            fireAlert('error', 'Oh No!', 'You have some errors in your input');
            if (error in fields && error in errors){
                errorField = $(`#${fields[error].attr('id')}_error`);console.log(errorField, error);

                errorField.html("<p>* " + errors[error].join("</p><p>* " ) + "</p>");
                errorField.css('display', 'block');

            }
        };
    }
}
