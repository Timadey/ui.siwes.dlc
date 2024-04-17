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

export function handleFieldErrors(fields, errors, errorLabelSuffix = '_error'){
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
                errorField = $(`#${fields[error].attr('id')}${errorLabelSuffix}`);console.log(errorField, error);

                errorField.html("<p>* " + errors[error].join("</p><p>* " ) + "</p>");
                errorField.css('display', 'block');

            }
        };
    }
}

/** Populates a parent and child dropdown.
 * The child dropdown selct options are populated based on the selected option of parent
 * Array is of form [parent1:[child1, child2, child3], parent2:[child1, child2]...]
 */
export function populateDropdownSelect(array, parentDropdownId, childDropdownId, step=2){
    // Populate state dropdown options
    var parentDropdown = $(`#${parentDropdownId}`);
    parentDropdown.append($('<option>').text(`Select ${parentDropdownId}`).attr('value', ""));
    if (!childDropdownId || step == 1){
        Object.values(array).forEach(function(elem) {
            parentDropdown.append($('<option>').text(elem).attr('value', elem));
        });
    }else{
        Object.keys(array).forEach(function(elem) {
            parentDropdown.append($('<option>').text(elem).attr('value', elem));
        });
    }

    // Handle change event on faculty dropdown
    if (childDropdownId && step == 2){

        parentDropdown.change(function() {
            var selectedParent = $(this).val();
            var childDropdown = $(`#${childDropdownId}`);
    
            // Clear existing options
            childDropdown.empty();
    
            // Add default option
            childDropdown.append($('<option>').text(`Select ${childDropdownId}`).attr('value', ""));
    
            // Populate department dropdown with departments of selected faculty
            array[selectedParent].forEach(function(child) {
                childDropdown.append($('<option>').text(child).attr('value', child));
            });
        });
    }
    
}

export function populateState(course, state_id="states"){
    $.ajax({
        type: "POST",
        data: {course},
        url: 'companies/states',
        success: function (response) {
            response = JSON.parse(response);
            drawState(response, state_id);
        },
        error: function(xhr, status, error){
            console.log(xhr, xhr.responseText);
            fireAlert('error','Error getting cities','We couldn\'t load the list of states');
        }
    });

}

export function populateCity(course, state, cities_id="cities"){
    $.ajax({
        type: "POST",
        data: {course, state},
        url: 'companies/cities',
        success: function (response) {
            response = JSON.parse(response);
            populateDropdownSelect(response, cities_id);
        },
        error: function(xhr, status, error){
            console.log(xhr, xhr.responseText);
            fireAlert('error','Error getting cities','We couldn\'t load the list of cities');
        }
    });

}

export function drawState(states, state_id="states"){
    return populateDropdownSelect(states, state_id);
}

export function populateCourseOfStudy(course_id="courses"){
    $.ajax({
        type: "POST",
        url:'companies/courses',
        contentType: false,
        processData: false,
        success: function (response) {
            response = JSON.parse(response);
            populateDropdownSelect(response, course_id);
        },
        error: function(xhr, status, error){
            console.log(xhr, xhr.responseText);
            fireAlert('error','Error getting course of study','We couldn\'t load the list of courses of study');
        }
    });

}
