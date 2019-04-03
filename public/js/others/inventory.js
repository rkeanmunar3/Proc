var inventoryTable = $('#inventoryTable').DataTable({
    'columnDefs': [
        {
            visible: false,
            targets: [0],
        },
        {
            width: '100px',
            targets: [1, 5],
            class: 'text-center'
        },
        {
            width: '600px',
            targets: [2,3,4]
        },

    ],
    'info' : false,
    'searching' : true,
    'lengthChange' : false,
    'pageLength' : 12,
    
});

$('#inventoryTable_paginate').detach().appendTo('.paging');
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

app.bind = function(){
    app.sendAjax();
}

app.sendAjax = function(){
    $('#search').on('keyup', function(){
        var searchString = $(this).val();
        
        inventoryTable.search(searchString).draw();
    });
    $('#grpcode').on('change', function(){
        var searchString = $(this).val();
        
        inventoryTable.search(searchString).draw();
    });
    $(document).ready(function(){
        fetchAllItems();
    })
    $(document).on('click','.addPR',function(){
        var tr = $(this).closest('tr');
        var data = inventoryTable.row(tr).data();
        
        createPR(data);

        $(tr).css('background', 'green');
    })
}

app.bind();

function fetchAllItems(){
    $.ajax({
        type: 'get',
        url : 'fetchAll',
        dataType: 'json',
        success: function(res){

            res.data.forEach(element => {
                inventoryTable.row.add([
                    element.grpcode,
                    element.itemcode,
                    element.name,
                    element.specs,
                    element.type,
                    '<a href="#" class="addPR">PR <i class="fas fa-plus"></i></a>'
                ]).draw(false);
            });
        }
    })
}

function createPR(data){
    var grpcode = data[0];
    var itemcode = data[1];
    var itemname = data[2];
    var desc = data[3];
    var specs = data[4];

    $.ajax({
        type: 'POST',
        url: 'createPR',
        data: 'grpcode='+grpcode+"&itemcode="+itemcode+"&name="+itemname+"&desc="+desc+"&specs="+specs,
        dataType: 'json',
        success: function(res){
           switch(res.status){
               case 'success':
               {
                    swal({
                        title: 'Success',
                        text: res.message,
                        icon: 'success',
                        button: 'Ok',
                        timer: 2000,
                        placement: 'top-right'
                    });
                    break
               }
               case 'error':
               {
                    swal({
                        type: 'error',
                        text: res.message
                    });
                    break
               }
           }
        }
    })
}
