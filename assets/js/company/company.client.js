const tableColumns = [{
    data: "company_name",
    title: "Company Name"
  },
  {
    data: "company_address",
    title: "Company Address"
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

function drawDataTable(targetElement, data, columnDefs=tableColumns) {
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
  });

}
