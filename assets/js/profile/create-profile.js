import { getJqFormFields, fireAlert, handleFieldErrors } from "../utils.js";
import { faculties } from "../config.js";



$(document).ready(function () {

    // Populate faculty dropdown options
    var facultyDropdown = $('#faculty');
    facultyDropdown.append($('<option>').text('Select Faculty'));
    Object.keys(faculties).forEach(function(faculty) {
        facultyDropdown.append($('<option>').text(faculty).attr('value', faculty));
    });

    // Handle change event on faculty dropdown
    facultyDropdown.change(function() {
        var selectedFaculty = $(this).val();
        var departmentDropdown = $('#department');

        // Clear existing options
        departmentDropdown.empty();

        // Add default option
        departmentDropdown.append($('<option>').text('Select Department'));

        // Populate department dropdown with departments of selected faculty
        faculties[selectedFaculty].forEach(function(department) {
            departmentDropdown.append($('<option>').text(department).attr('value', department));
        });
    });

    // When submit button is clicked
    $("#submit-btn").click(function (e) {
        e.preventDefault();
        // Remove previous error texts
        $(".error").text("");
        $(".error").css('display', 'none');

        // Disable the button and show processing text
        $(this).prop('disabled', true).text('Processing...');

        const form = $("#create-profile-form").get()[0]
        const formData = new FormData(form);

        // Send Ajax request to create student profile
        $.ajax({
            type: "POST",
            url:'register-it',
            // headers: {
            //     "Authorization": `Token ${getAuthToken()}`,
            // },
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                $("#submit-btn").text('Registration successful');
                fireAlert('success','Profile Updated','You have successfully registered');
                console.log(response);
                window.location.assign(`/siwes/dlc/preview?reg=${response.record_id}`);
            },
            error: function(xhr, status, error){
                console.log(xhr, xhr.responseText);
                // Enable the button and revert to its original text
                $("#submit-btn").prop('disabled', false).text('Submit');
                fireAlert('error','Error in creating profile','You may have some errors in your input');
                const fields = getJqFormFields(formData);
                const errors = xhr.responseJSON;

                if (xhr.status == 400){
                    handleFieldErrors(fields, errors);
                }else{
                    fireAlert('error','Stop that!','Hey what have you done? Don\'t worry it could be from our side');
                }
            }
        });
        
    })

});