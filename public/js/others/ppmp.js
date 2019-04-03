var inventoryTable = $('#ppmpTable').DataTable({
    'columnDefs': [
        {
            visible: false,
            targets: [0],
        },
        {
            width: '300px',
            targets: [1]
        },
        {
            width: '520px',
            targets: [2]
        },
        {
            width: '250px',
            targets: [3]
        },
        {
            width: '150px',
            targets: [4]
        },
    ],
    'info' : false,
    'searching' : true,
    'lengthChange' : false,
    'dom' : '<"row"t<"row col-md-12 justify-content-center"p>',
    'pageLength' : 9,
    
});