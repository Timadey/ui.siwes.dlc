var buttons =  [{
        text: 'Add',
        name: 'add'
    },     // do not change name

    {
        extend: 'selected', // Bind to Selected row
        text: 'Edit',
        name: 'edit'        // do not change name
    },

    {
        extend: 'selected', // Bind to Selected row
        text: 'Delete',
        name: 'delete'      // do not change name
    }
];

function onEditRow (datatable, rowdata, success, error){
    // $.ajax({
    //     // a tipycal url would be /{id} with type='POST'
    //     url: url_ws_mock_ok,
    //     type: 'GET',
    //     data: rowdata,
    //     success: success,
    //     error: error
    // });
    console.log(rowdata);
}