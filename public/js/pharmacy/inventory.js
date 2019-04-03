var inventoryTable = $('#inventoryTable').DataTable({
    'columnDefs': [
        {
            visible: false,
            targets: [0, 1],
        },
        {
            width: '150px',
            targets: [6, 5],
            class: 'text-center'
        },
        {
            width: '400px',
            targets: [2,3,4, 5]
        },

    ],
    'info' : false,
    'searching' : true,
    'lengthChange' : false,
    'pageLength' : 12,
    'dom': '<t<p>>'
    
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
        
        if(searchString != 'A'){
            inventoryTable.search(searchString).draw();
        }else{
            inventoryTable.search('').draw(true);
        }
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
                    element.codegrp,
                    element.itemcode,
                    element.name,
                    element.description,
                    element.specs,
                    function(){
                        if( Number(element.price) != 0 ){
                            return  Number(element.price);
                        }else
                        {
                            return '-';
                        }
                    },
                    '<a href="#" class="addPR">PR <i class="fas fa-plus"></i></a><a href="#" class="addPPMP">PPMP <i class="fas fa-plus"></i></a>'
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
    var price = parseFloat(data[5]);
    $.ajax({
        type: 'POST',
        url: 'createPR',
        data: 'grpcode='+grpcode+"&itemcode="+itemcode+"&name="+itemname+"&desc="+desc+"&specs="+specs,
        dataType: 'json',
        success: function(res){
            console.log(res);
           switch(res.status){
               case 'success':
               {
                    swal({
                        title: 'Success',
                        text: res.message,
                        icon: 'success',
                        button: 'Ok',
                        timer: 2000,
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
