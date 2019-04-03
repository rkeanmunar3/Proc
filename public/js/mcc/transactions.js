var prTable = $('#prTable').DataTable({
    'info': false,
    'lengthChange': false,
    'searching': false,
    'pageLength': 10,
    'columnDefs': [
        {
            width: '120px',
            targets: [0]
        },
        
        {
            className: 'text-center',
            targets: [6]
        }
    ],
    'paging' : false,
    'scrollY' : '350px'
});

var itemTable = $('#itemTable').DataTable({
    'lengthChange': false,
    'searching': false,
    'info': false,
    'page': 10,
    'dom': '<t<"row col-md-12 justify-content-center"p>>',
    'columnDefs': [
        {
            visible: false,
            targets: [0]
        },
        {
            width: '400px',
            targets: [1]
        },
        {
            width: '80px',
            targets: [2]
        },
        {
            width: '600px',
            targets: [3,4]
        },
        {
            width: '200px',
            targets: [5,6,7]
        },
    ]
})

$(prTable.table().header()).css({
    'background' : 'rgba(11, 2, 59, 0.5)'
})
$('#prTable_paginate').detach().appendTo('.paging');

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
        //fetchAll();
    })

    $(document).on('shown.bs.modal', '#prModal', function(){
        var prno = $(this).attr('data-prno');

        displayItems(prno)
    })

    /*$(document).on('click', 'tbody tr', function(){
        var tr = $(this);

        var data = prTable.row(tr).data();

        $('#prModalLabel').text(data[0]);
        $('#prModal').modal('show');
        $('#prModal').attr('data-prno', data[0]);
        $('.sendPR').attr('data-prno', data[0]);
    })*/

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

        $(tr).css('background-color', 'rgba(150, 4, 16, 0.5)');
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

    $(document).on('click', '.approvePR', function(e){
        e.stopPropagation();

        var prno = $('#prModal').attr('data-prno');
        
        approvePR(prno);
    })
}

app.bind();

function fetchAll(){
    
    $.ajax({
        type: 'get',
        url: 'mcc/fetchPR',
        dataType: 'json',
        success: function(res){
            prTable.clear().draw();
            
            res.datas.forEach(element => {
                var template = '';
                if(element.statcode == 'P'){
                    template = '<a href="#" class="approvePR" data-prno="'+ element.transcode +'">APPROVE <i class="fas fa-check"></i></a>';
                }else{
                    template = '<a href="#" class="viewPR" data-prno="'+ element.transcode +'">VIEW <i class="fas fa-eye"></i></a>';
                }
                prTable.row.add([
                     element.transcode,
                     element.name,
                     element.items,
                     element.totalprice,
                     element.date_sent,
                     element.status,
                     template,
                 ]).draw(false);
             });
        }
    })
}

function displayItems(prno){
    
    itemTable.clear().draw();
    $.ajax({
        type: 'get',
        url: 'getItems',
        data: 'prno='+prno,
        dataType: 'JSON',
        success: function(res){
           
            res.forEach(element => {
                itemTable.row.add([
                    element.itemcode,
                    element.name,
                    element.unit,
                    element.description,
                    element.specs,
                    '<input type="number" value="'+ element.qty +'" class="qty" disabled>',
                    '<input type="number" value="'+ Number(element.price) +'" class="price text-center" disabled>',
                    function(){
                        var total = 0;

                        var qty = element.qty;
                        var prc = element.price;

                        total = qty * prc;

                        return '<input type="number" value="'+ total +'" class="total" disabled>';
                    }
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
                    itemTable.row(tr).remove().draw();
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
        url: 'mcc/approvePR',
        data: 'prno='+prno,
        dataType: 'json',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    swal({
                        icon: 'success',
                        title: 'Success!',
                        text: res.message,
                        timer: '1500'
                    });
                    fetchAll();
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