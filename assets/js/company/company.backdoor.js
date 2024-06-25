import { submitFormFn, fireAlert, populateState, populateCity, populateCourseOfStudy } from "../utils.js";

$(document).ready(function () {
  var tableColumns = [{
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
    },
    {
      title: 'Action',
      orderable: false,
      searchable: false,
      render: function (data, type, row, meta) {
        return `
          <button class="btn btn-primary edit-btn" data-row='${JSON.stringify(row)}'>Edit</button>
          <button class="btn btn-danger delete-btn" data-row-id='${row.id}'>Delete</button>
        `;
      }
  }];

  function searchCompanies(formData, url="companies/search") {
    return new Promise((resolve, reject) => {
      $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          handleSuccess(response);
          resolve(response);
        },
        error: function (xhr, status, error) {
          handleAjaxError(xhr);
          reject(error);
        }
      });
    });
  }

  function getCompanies(formData, url="companies/search") {
    return new Promise((resolve, reject) => {
      $.ajax({
        type: "POST",
        url: url,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
          resolve(response);
        },
        error: function (xhr, status, error) {
          reject(error);
        }
      });
    });
  }

  function handleSuccess(response) {
    if (response && response.length > 0) {
      $("#company-datatable").show();
      drawDataTable("#companies", response);
      fireAlert('success', 'Companies Found', `Query returned ${response.length} companies`);
    } else {
      $("#company-datatable").hide();
      fireAlert('error', 'Not Found', 'Search returned an empty result');
    }
  }

  function handleAjaxError(xhr) {
    // Log detailed error for debugging
    console.error(xhr.responseText);
    // Show user-friendly error message
    fireAlert('error', 'Query Error', `${xhr.responseText}`);
  }

  function drawDataTable(targetElement, data, columnDefs=tableColumns) {

    // Check if DataTable is already initialized and destroy it
    if ($.fn.DataTable.isDataTable(targetElement)) {
      $(targetElement).DataTable().destroy();
    }

    // Initialize the DataTable
    const table = $(targetElement).DataTable({
      "sPaginationType": "full_numbers",
      data: data,
      columns: columnDefs,
      dom: 'Bfrtip',
      select: 'single',
      responsive: true,
    });


    // Edit Button Click Event
    $(targetElement).on('click', '.edit-btn', function () {
      const rowData = $(this).data('row');
      // Prefill modal with row data
      prefillModal(rowData);
      setModalAction("edit");
    });

    $(targetElement).on('click', '.delete-btn', function () {
      const rowId = $(this).data('row-id');
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          deleteCompany(rowId).then(
            (response)  => {
              console.log(response);
              Swal.fire({
                title: "Deleted!",
                text: "Company has been deleted.",
                icon: "success"
              });
              table
                .row($(this).parents('tr'))
                .remove()
                .draw();

            }, 
            (xhr, status, error) => {
              console.log(xhr, xhr.responseText);
              fireAlert('error','Error in deleting company');
            }
          )}
          // Swal.fire({
          //   title: "Deleted!",
          //   text: "Your file has been deleted.",
          //   icon: "success"
          // });
      });
      
    });
  }

  function deleteCompany(id) {
    return new Promise((resolve, reject) => {
      $.ajax({
        type: "POST",
        data: {id},
        url: 'companies/delete',
        success: function (response) {
          resolve(response);
            
          // table
          // .row($(this).parents('tr'))
          // .remove()
          // .draw();
        },
        error: function(xhr, status, error){
          reject(xhr, status, error);
          console.log(xhr, xhr.responseText);
          fireAlert('error','Error in deleting company');
        }
      });
    }
  )
    
  }

  function prefillModal(rowData){
    Object.keys(rowData).forEach(key => {
      const inputField = $(`[name="${key}"]`);
      // console.log(inputField);

      if (inputField.length > 0) {
        inputField.val(rowData[key]);
      }
    });

    // populate city or area
    populateCity("", $("#stateInModal").val(), "cityOrArea");

    
  }

  function setModalAction(type="add")
  {
    if (type == "edit")
    {
      $('#addModalLabel').text('Edit company');
      $('#companyModal').modal('show');
      $("#submitCompany").text("Edit company");
      $("#courseOfStudy").attr('disabled', true);
      $("#companyModalForm").attr('action', 'companies/edit');
    }
    else if (type == "add")
    {
      $('#companyModal').modal('show');
      $('#addModalLabel').text('Add new company');
      $('#companyModalForm')[0].reset();
      $("#courseOfStudy").attr('disabled', false);
      $("#submitCompany").text("Add company");
      $("#companyModalForm").attr('action', 'companies/add');
    }
  }

  // function addorEditCompany(url, action){
  //   console.log("Adding company");
  //   return submitFormFn({
  //     url : url,
  //     formId : "companyModalForm",
  //     submitBtnId : "submitCompany",
  //     success: function (response) {
  //       $('#companyModalForm')[0].reset();
  //       $('#companyModal').modal('hide');
  //       getCompanies(null, "companies/all").then((response) => {
  //         if (response && response.length > 0) {
  //           $("#company-datatable").show();
  //           drawDataTable("#companies", response);
  //         } else {
  //           $("#company-datatable").hide();
  //           fireAlert('error', 'Not Found', 'Search returned an empty result');
  //         }
  //       });
  //       fireAlert("success", "Company " + action + " successfully", `${response.company_name} has been ${action}.`);
  //     },
  //     error: function(xhr, status, error) {
  //       console.log("new error ", xhr, xhr.responseText);
  //       fireAlert("error", "An error occurred while adding the company", `${error}`)
  //     }
      
  //   });
  // }

  $("#new-company").click(function (e) {
    e.preventDefault();
    setModalAction("add");
  })

  $("form#companyModalForm").submit(function (e) { 
    e.preventDefault();
    const url = $(this).attr("action");
    var action;
    if (url == "companies/add")
    {
      action = "added";
    }
    else {
      action = "updated";
    }
    submitFormFn({
      url : url,
      formId : "companyModalForm",
      submitBtnId : "submitCompany",
      success: function (response) {
        $('#companyModalForm')[0].reset();
        $('#companyModal').modal('hide');
        getCompanies(null, "companies/all").then((response) => {
          if (response && response.length > 0) {
            $("#company-datatable").show();
            drawDataTable("#companies", response);
          } else {
            $("#company-datatable").hide();
            fireAlert('error', 'Not Found', 'Search returned an empty result');
          }
        });
        fireAlert("success", "Company " + action + " successfully", `${response.company_name} has been ${action}.`);
      },
      error: function(xhr, status, error) {
        console.log("new error ", xhr, xhr.responseText);
        fireAlert("error", "An error occurred while adding the company", `${error}`)
      }
      
    });
  });

  $("#get-all-companies").click(function (e) { 
    e.preventDefault();
    
      const $submitButton = $(this);
      $submitButton.prop('disabled', true).text('Processing...');
      searchCompanies(null, "companies/all").finally(() => {
        $submitButton.prop('disabled', false).text('Get all companies');
      });
  });

  populateCourseOfStudy("courseOfStudy");
  

  // populateState($(this).val());
  populateState("", "stateInModal");
  $("#stateInModal").change(function (e) { 
    e.preventDefault();
    $("#cityOrArea").empty();
    populateCity("", $(this).val(), "cityOrArea");
    
  });

  $('#companyName').keyup(function(e) {
    if (e.which !== 38 && e.which !== 40 && e.which !== 16){
      e.preventDefault();


      const find = $(this).val();
      if (find && find.length > 0){
        const where = "company_name"
        
        // Send AJAX request to the backend to fetch suggestions
        $.ajax({
          url: 'companies/suggest',
          method: 'POST',
          data: { where, find },
          success: function(response) {
            // console.log(response);
            if (response.length > 0) {
              fillSuggestions(JSON.parse(response));
              $('#companyNameSuggestionList').show();
            } else {
              $('#companyNameSuggestionList').hide();
            }
          },
          error: function(xhr, status, error) {
            console.error(error);
          }
        });
      }else if(e.which == 16){

        e.preventDefault();
        // get current active
        currentActiveSuggestion = suggestionList.find("li.dropdown-item.active");
        // get the value
        const suggestionValue = currentActiveSuggestion.text();
        // put value in input field
        $(this).val(suggestionValue);
        // remove suggestions
        removeSuggestion()
      }else {
        removeSuggestion()
      }
    }
  });

  // I was trying to make each suggestion active on arrow key and when the enter key is pressed
  // the value of the current active will be filled into the box
  // but the implemetation clashes with the default enter key for form submission
  // $('#companyName').keydown(function(e) {
  //   const suggestionList = $('#companyNameSuggestionList');

  //   // if suggestion list is not empty
  //   if (suggestionList.children().length > 1) {

  //     if (e.which === 38 || e.which === 40) {
  //       e.preventDefault();
  //       var currentActiveSuggestion = suggestionList.find("li.dropdown-item.active");

  //       if (currentActiveSuggestion.length > 0) {
  //         if (e.which === 38) {
  //           var nextSuggestion = currentActiveSuggestion.prev("li.dropdown-item");
  //         } else if (e.which === 40) {
  //           var nextSuggestion = currentActiveSuggestion.next("li.dropdown-item");
  //         }

  //         currentActiveSuggestion.removeClass("active"); // Remove class only if it's not the current active suggestion

  //         if (nextSuggestion.length > 0) {
  //           // Set the next suggestion as active
  //           nextSuggestion.addClass("active");
  //         } else {
  //           // If there is no next suggestion, loop back to the first suggestion
  //           suggestionList.find("li.dropdown-item").first().addClass("active");
  //         }
  //       }
  //     }else if(e.which == 16){
  //       e.preventDefault();
  //       // get current active
  //       currentActiveSuggestion = suggestionList.find("li.dropdown-item.active");
  //       // get the value
  //       const suggestionValue = currentActiveSuggestion.text();
  //       // put value in input field
  //       $(this).val(suggestionValue);
  //       // remove suggestions
  //       removeSuggestion()

  //     }
  //   };
  //   // return false;
  // });
  var lastClicked;
  $("#companyNameSuggestionList").on('click', 'li.dropdown-item', function(e){
    e.preventDefault();
    // get the value
    const suggestionValue = e.target.textContent;
    // put value in input field
    $('#companyName').val(suggestionValue);
    lastClicked = $(this);
    // remove suggestions
    removeSuggestion();
  });

  $("#companyNameSuggestionList").on('click', '#remove-suggestion', function(e){
    e.preventDefault();
    removeSuggestion();
  });


  $("#companyModalForm").on("focus", function(e) {
    // Check if the focused element is not #companyName input
    console.log(e);
    if (!$(e.target).is("#companyName")) {
      removeSuggestion();
    }
  });




  function fillSuggestions(suggestions) {
    // console.log(suggestions);
    const suggestionList = $('#companyNameSuggestionList');
    suggestionList.empty();

    // Iterate over the suggestions and append them to the dropdown menu
    suggestions.forEach((suggestion, index) => {
      suggestionList.append(`<li class="dropdown-item">${suggestion}</li>`);
    });
    suggestionList.append('<li><hr class="dropdown-divider"></li>');
    suggestionList.append('<li><a class="dropdown-item bg-danger" id="remove-suggestion"> x remove</a></li>');

  }

  function removeSuggestion() {
    const suggestionList = $('#companyNameSuggestionList');
    suggestionList.empty();
    suggestionList.hide();
  }


  window.drawDataTable = drawDataTable;
  window.searchCompanies = searchCompanies;

});


