import { fireAlert, populateCity, populateCourseOfStudy, populateState } from "../utils.js";

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
    $(this).prop('disabled', true).text('Processing...');

    const form = $("#browse-companies").get()[0]
    const formData = new FormData(form);

    // Send Ajax request to search companies
    $.ajax({
      type: "POST",
      url:'companies/search',
      data: formData,
      contentType: false,
      processData: false,
      success: function (response) {
        $("#submit-browse").prop('disabled', false).text('Browse');
        fireAlert('success','Companies Found',`Query returned ${response.length} companies`);

        if (response && response.length > 0){
          $("#company-datatable").show();
          drawDataTable(response)
        }else{
          fireAlert('error','Not Found','Search returned an empty result');
          $("#company-datatable").hide();
        }
      },
      error: function(xhr, status, error){
        // console.log(xhr, xhr.responseText);
        // console.error(error);
        
        // Enable the button and revert to its original text
        $("#submit-browse").prop('disabled', false).text('Browse');
        fireAlert('error','Query Error', `${xhr.responseText}`);
      }
    });
 
  });

  function drawDataTable(data) {
    if ($.fn.DataTable.isDataTable('#companies')) {
      $('#companies').DataTable().destroy();
    }

    var columnDefs = [{
      data: "id",
      title: "Id",
      type: "readonly",
      visible: false
    },
    {
      data: "company_name",
      title: "Company Name"
    },
    {
      data: "company_address",
      title: "Company Address"
    },
    {
      data: "course_of_study",
      title: "Course of Study"
    },
    {
      data: "city_or_area",
      title: "City or Area"
    },
    {
      data: "state",
      title: "State"
    },
    {
      data: "email",
      title: "Email"
    },
    {
      data: "phone",
      title: "Phone"
    },
    {
      data: "website",
      title: "Website"
    }];
  
    var myTable;
  
  
    myTable = $('#companies').DataTable({
      "sPaginationType": "full_numbers",
      data: data,
      columns: columnDefs,
      dom: 'Bfrtip',       
      select: 'single',
      responsive: true,
      altEditor: true,     
      buttons: buttons, 
      onEditRow: onEditRow
    });
  }

  
  
  
});
  