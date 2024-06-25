import { populateCity, populateCourseOfStudy, populateState } from "../utils.js";

$(document).ready(function() {
  $("#company-datatable").hide();
  
  populateCourseOfStudy();
  
  
  $("#courses").change(function (e) { 
    e.preventDefault();
    $("#states").empty();
    $("#cities").empty();
    populateState($(this).val());
  });

  $("#states").change(function (e) { 
    e.preventDefault();
    $("#cities").empty();
    populateCity($("#courses").val(), $(this).val());
    
  });


  // When submit button is clicked
  $("#submit-browse").click(function (e) {
    e.preventDefault();
  
    // Disable the button and show processing text
    const $submitButton = $(this);
    $submitButton.prop('disabled', true).text('Processing...');
  
    // Serialize form data
    const formData = new FormData($("#browse-companies")[0]);
  
    // Send Ajax request to search companies
    searchCompanies(formData).finally(() => {
      $submitButton.prop('disabled', false).text('Browse');
    });
    // $submitButton.prop('disabled', false).text('Browse');

    ;


  });
  

  




  
  
  
});
  