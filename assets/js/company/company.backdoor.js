import { submitFormFn, fireAlert } from "../utils.js";


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

var actionButtons =  [{
        text: 'Add',
        name: 'add'
    },     // do not change name

    // {
    //     extend: 'selected', // Bind to Selected row
    //     text: 'Edit',
    //     name: 'edit'        // do not change name
    // },

    // {
    //     extend: 'selected', // Bind to Selected row
    //     text: 'Delete',
    //     name: 'delete'      // do not change name
    // }
];

$("#get-all-companies").click(function (e) { 
  e.preventDefault();
  
    const $submitButton = $(this);
    $submitButton.prop('disabled', true).text('Processing...');
    searchCompanies(null, "companies/all").finally(() => {
      $submitButton.prop('disabled', false).text('Get all companies');
    });
});

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
  fireAlert('error', 'Query Error', 'An error occurred while processing your request.');
}

function drawDataTable(targetElement, data, columnDefs=tableColumns, buttons=actionButtons) {

  // Check if DataTable is already initialized and destroy it
  if ($.fn.DataTable.isDataTable(targetElement)) {
    $(targetElement).DataTable().destroy();
  }

  // Initialize the DataTable
  $(targetElement).DataTable({
    "sPaginationType": "full_numbers",
    data: data,
    columns: columnDefs,
    dom: 'Bfrtip',
    select: 'single',
    responsive: true,
    buttons: buttons, 
  });

  // Add Button Click Event
  $(targetElement).DataTable().button(0).action(function (e, dt, button, config) {
    $('#companyModal').modal('show');
    $('#addModalLabel').text('Add new company');
    
    const submitCompanyBtn = $("#submitCompany");
    submitCompanyBtn.click(function(e) {
      e.preventDefault();
      submitFormFn({
        url : "companies/add",
        formId : "companyModalForm",
        submitBtnId : "submitCompany",
        success: function (response) {
          $('#companyModalForm')[0].reset();
          $('#companyModal').modal('hide');
          searchCompanies(null, "companies/all")
          fireAlert("success", "Company added successfully", `${response.company_name} has been added to the list`);
        },
        error: function(xhr, status, error) {
          console.log(xhr, xhr.responseText);
          fireAlert("error", "An error occurred while adding the company", `${error}`)
        }
        
      })
    })
  })

  // Edit Button Click Event
  $(targetElement).on('click', '.edit-btn', function () {
    const rowData = $(this).data('row');
    // Prefill modal with row data
    prefillModal(rowData);
    $('#addModalLabel').text('Edit company');
    $('#companyModal').modal('show');

    const submitCompanyBtn = $("#submitCompany");
    submitCompanyBtn.click(function(e) {
      e.preventDefault();
      submitFormFn({
        url : "companies/edit",
        formId : "companyModalForm",
        submitBtnId : "submitCompany",
        success: function (response) {
          $('#companyModalForm')[0].reset();
          $('#companyModal').modal('hide');
          searchCompanies(null, "companies/all");
          fireAlert("success", "Company edited successfully", `${response.company_name} details has been updated`);
        },
        error: function(xhr, status, error) {
          console.log(xhr, xhr.responseText);
          fireAlert("error", "An error occurred while updating the company", `${error}`)
        }
        
      })
    })
  });
}

function prefillModal(rowData){
  Object.keys(rowData).forEach(key => {
    const inputField = $(`[name="${key}"]`);
    console.log(inputField);

    if (inputField.length > 0) {
      inputField.val(rowData[key]);
    }
  });
  
}


window.drawDataTable = drawDataTable;
window.searchCompanies = searchCompanies;
