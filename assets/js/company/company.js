$(document).ready(function() {

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
    ajax: {
      url : "companies/all",
      dataSrc : ''
  },
    columns: columnDefs,
    dom: 'Bfrtip',       
    select: 'single',
    responsive: true,
    altEditor: true,     
    buttons: buttons, 
    onEditRow: onEditRow
  });
  
  
});
  