var prTable = $('#prTable').DataTable({
    'info': false,
    'lengthChange': false,
    'searching': false,
    'pageLength': 10,
    'columnDefs': [
        {
            className: 'text-center',
            targets: [2]
        },
        {
           orderable: false,
            targets: [6],
            class : 'text-center'
        }
    ],
    'scrollY' : '500px',
    'paginate': false,
});

//$('#prTable_paginate').detach().appendTo('.paging');
$(prTable.table().header()).css('background' , 'rgba(13, 3, 70, 0.3)');
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
        {
            width: '10px',
            targets: [8],
            sorting: false
        }
    ]
})

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

    $(document).on('click', '.sendPR', function(e){
        e.stopPropagation();

        var prno = $(this).attr('data-prno');
     
        sendPR(prno);
        getTotal();
    })

    $(document).on('click', '.editPR', function(e){
        e.stopPropagation();

        var prno = $(this).attr('data-prno');
     
        editPR(prno);
    })
}

app.bind();

function fetchAll(){
    $.ajax({
        type: 'get',
        url: 'fetchAllPR',
        dataType: 'json',
        success: function(res){
            res.forEach(element => {
                var status = element.status.trim();

                prTable.row.add([
                    element.transcode,
                    "<a href='#' class='viewItems' data-prno='"+ element.transcode +"'>"+ element.items +"</a>",
                    element.created_at,
                    function(){
                        return element.statusname;
                    },
                    function(){
                        if(status == 'NS'){
                            return '<a href="#" class="sendPR" data-prno="'+ element.prno +'"><i class="fas fa-paper-plane"></i></a>&nbsp<a href="#" class="editPR" data-prno="'+ element.prno +'"><i class="fas fa-edit"></i></a>';
                        }else if(status == 'P'){
                            return '<a href="#" class="sendPR" data-prno="'+ element.prno +'"><i class="fas fa-eye"></i></a>&nbsp';
                        }else if(status == 'A'){
                            return '<a href="#" class="sendPR" data-prno="'+ element.prno +'"><i class="fas fa-search-location"></i></a>&nbsp';
                        }
                    }
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
                    '<input type="number" value="'+ element.qty +'" class="qty">',
                    '<input type="number" value="'+ Number(element.price) +'" class="price text-center">',
                    function(){
                        var total = 0;

                        var qty = element.qty;
                        var prc = element.price;

                        total = qty * prc;

                        return '<input type="number" value="'+ total +'" class="total">';
                    },
                    '<a class="remove" href="#" data-itemcode="'+ element.itemcode +'" data-prno="'+ element.prno +'"><i class="fas fa-times"></i></a>'
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

function sendPR(prno){
    var datas = [];
    var total = getTotal();
    itemTable.rows().every(function(tr){
        var data = itemTable.row(tr).data();
        
        var qty = itemTable.cells(tr, 5).nodes().to$().find('input').val();
        var prce = itemTable.cells(tr, 6).nodes().to$().find('input').val();
        var total = itemTable.cells(tr, 7).nodes().to$().find('input').val();

        var arr = {
            'itemcode' : data[0],
            'qty' : qty,
            'price' : prce,
            'total' : total
        };
        
        datas.push(arr);
    });

    $.ajax({
        type: 'post',
        url: 'sendPR',
        data: {prno: prno , datas : datas, total : total},
        dataType: 'json',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    swal({
                        title: 'Success',
                        icon: 'success',
                        text: res.message,
                        timer: '1500',
                    })
                    break;
                }
                case 'error':
                {
                    swal({
                        title: 'Error',
                        icon: 'error',
                        text: res.message,
                        timer: '1500',
                    })
                    break;
                }
            }
        }
    })
}

function editdPR(prno){

    $.ajax({
        type: 'post',
        url: 'editPR',
        data: {prno: prno },
        dataType: 'json',
        success: function(res){
            Window.location.href = res;
        }
    })
}

function getTotal(){
    var total = 0;

    itemTable.rows().every(function(tr){
        var price = itemTable.cells(tr, 7).nodes().to$().find('input').val();

        total = total + parseFloat(price);
    });

    return total;
}

