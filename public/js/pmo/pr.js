var prTable = $('#prTable').DataTable({
    'info': false,
    'lengthChange': false,
    'searching': false,
    'pageLength': 10,
    'columnDefs': [
        {
            width: '100px',
            class: 'text-center',
            targets: [6]
        },
    ]
});

var itemTable = $('#itemsTable').DataTable({
    'lengthChange': false,
    'searching': false,
    'info': false,
    'scrollY' : '600px',

    'paging' : false,
    //'dom': '<t<p>>',
    'columnDefs' : [
        {
            width: '150px',
            targets: [0]
        },
        {
            orderable : false,
            targets : [6]
        }
    ],
})
$(itemTable.table().header()).css({
    'color' : 'white',
    'background-color' : 'rgba(9, 1, 44, 0.8)'
});

$('#prTable_paginate').detach().appendTo('.paging');

//$('#itemsTable_paginate').detach().appendTo('.itemsPaging');

var removedItems = [];

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

app.bind = function(){
    app.sendAjax();
}

app.sendAjax = function(){
    $(document).ready(function(){

    })

    $(document).on('shown.bs.modal', '#prModal', function(){
        var prno = $(this).attr('data-prno');
        $('.approvePR').attr('data-prno', prno);
        $('.returnPR').attr('data-prno', prno);
        displayItems(prno)
    })

    $(document).on('click', 'tbody tr', function(){
        var tr = $(this);

        var data = prTable.row(tr).data();

        $('#prModalLabel').text(data[0]);
        $('#prModal').modal('show');
        $('#prModal').attr('data-prno', data[0]);
        $('.sendPR').attr('data-prno', data[0]);
    })

    $(document).on('change', '.qty', function(){
        var tr = $(this).closest('tr');
  
        var price = $(tr).find('.price');

        var qty = $(this).val();
        var prc = price.val();
        var total = qty * prc;

        $(tr).find('.total').val(parseFloat(Number(total)));
    })

    $(document).on('change', '.price', function(){
        var tr = $(this).closest('tr');

        var qty = $(tr).find('.qty').val();
        var prc = $(this).val();

        var total = qty * prc;

        $(tr).find('.total').val(parseFloat(Number(total)));
    })

    $(document).on('click', '.remove', function(){
        var prno = $(this).attr('data-prno');
        var itemcode = $(this).attr('data-itemcode');
        var tr = $(this).closest('tr');

        swal({
            title: 'Are you sure?',
            icon: 'warning',
            text: 'Item will be removed from your purchase request',
            buttons: [
                'Cancel',
                'Yes',
            ]
    
        }).then((confirm) => {
            if(confirm)
            {
                removeItem(itemcode, prno, tr);
            }
            else
            {
                $(tr).css('background-color','');
            }
        })
    })

    $(document).on('click', '.createPO', function(e){
        e.stopPropagation();

        var prno = $(this).attr('data-prno');
        
        createPO(prno);
    })
    $(document).on('click', '.generatePO', function(e){
        e.stopPropagation();
    })
    $(document).on('click', '.viewPR', function(e){
        e.stopPropagation();

        approvePR(123);
    })
    $(document).on('click', '.removeItem', function(){
        var tr = $(this).closest('tr');
        var itemcode = $(this).attr('data-itemcode');

        $(tr).css('background', 'rgba(121, 3, 3, 0.8)');

        removedItems.push(itemcode);
        $.notify('Item removed', {
            className : 'warn',
            style : 'bootstrap',
            autoHideDelay: 1000,
        })

        $(this).addClass('returnItem');
        $(this).removeClass('removeItem');
        $(this).find('.fas').toggleClass('fa-times fa-check');
    })
    $(document).on('click', '.returnItem', function(){
        var tr = $(this).closest('tr');
        var itemcode = $(this).attr('data-itemcode');
        var ako = $(this);
        
        $(tr).css('background', '');

        var index = removedItems.indexOf(tr);

        removedItems.splice(index);

        $.notify('Item returned', {
            className : 'success',
            style : 'bootstrap',
            autoHideDelay: 1000,
        })

        $(this).addClass('removeItem');
        $(this).removeClass('returnItem');
        $(this).find('.fas').toggleClass('fa-check fa-times')
    })
    $(document).on('click', '.approvePR', function(){
        var prno = $(this).attr('data-prno');
        
        approvePR(prno);
    })
    $(document).on('click', '.returnPR', function(){
        var prno = $(this).attr('data-prno');
        
        returnPR(prno);
        alert(prno);
    })
}

app.bind();



function displayItems(prno){
    
    itemTable.clear().draw();
    
    $.ajax({
        type: 'get',
        url: 'pmogetItems',
        data: 'prno='+prno,
        dataType: 'JSON',
        success: function(res){
            res.items.forEach(element => {
                itemTable.row.add([
                    element.itemcode,
                    element.name,
                    //element.unit,
                    element.description,
                    element.specs,
                    '<input type="number" value="'+ element.qty +'" class="qty">',
                    '<input type="number" value="'+ Number(element.price) +'" class="price text-center">',
                    function(){
                        var total = 0;

                        var qty = element.qty;
                        var prc = element.price;

                        total = qty * prc;

                        return '<input type="number" value="'+ total +'" class="total">';
                    },
                    '<a href="#" class="removeItem" data-itemcode="'+ element.itemcode +'" data-prno="'+ element.prno +'"><i class="fas fa-times"></i></a>'
                ]).draw(false);
            })
        }

    })
}

function removeItem(itemcode, prno, tr){
    $.ajax({
        type: 'post',
        url: 'removeItem',
        data: 'prno='+prno+"&itemcode="+itemcode,
        dataType: 'json',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    $(tr).css('background-color', 'rgba(150, 4, 16, 0.5)');
                    //itemTable.row(tr).remove().draw();
                    swal({
                        icon: 'success',
                        title: 'Success!',
                        text: res.message,
                        timer: '1500'
                    });
                    break;
                }
                case 'error':
                {
                    swal({
                        icon: 'error',
                        title: 'Failed!',
                        text: res.message,
                        timer: '1500'
                    })
                    break;
                }
            }
        }
    })
}

function approvePR(prno){
    $.ajax({
        type: 'post',
        url: 'pmoapprovePR',
        data: "transcode="+prno,
        dataType: 'JSON',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    swal({
                        icon: 'success',
                        title: 'Success!',
                        text: res.message,
                        timer: '1500'
                    })
                    break;
                }
                case 'error':
                {
                    swal({
                        icon: 'error',
                        title: 'Failed!',
                        text: res.message,
                        timer: '1500'
                    })
                    break;
                }
            }
        }
    })
}

function returnPR(prno){
    $.ajax({
        type: 'post',
        url: 'pmoreturnPR',
        data: { transcode : prno, items : removedItems},
        dataType: 'JSON',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    swal({
                        icon: 'success',
                        title: 'Success!',
                        text: res.message,
                        timer: '1500'
                    })
                    break;
                }
                case 'error':
                {
                    swal({
                        icon: 'error',
                        title: 'Failed!',
                        text: res.message,
                        timer: '1500'
                    })
                    break;
                }
            }
        }
    })
}

function createPO(prno){

    $.ajax({
        type: 'get',
        url: 'pmo/createPO',
        dataType: 'json',
        data: 'prno='+prno,
        success: function(res){
            window.location.href = res;
        }
    })
}