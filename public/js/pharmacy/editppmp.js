var table = $('#itemsTable').DataTable({
    searching: false,
    info: false,
    lengthChange: false,
    paging: false,
    scrollCollapse: true,
    scrollX:        true,
    scrollY: '650px',
    fixedColumns:   {
        leftColumns: 6
    },
    columnDefs :[
        {
            width: '100px',
            targets: [0]
        },
        {
            width: '200px',
            targets: [1]
        },
        {
            width: '100px',
            targets: [2,3,4,5]
        },
        {
            visible: false,
            targets: [18, 5]
        },
        {
            width: '100px',
            targets: [6,7,8,9,10,11,12,13,14,15,16,17, 18],
            class: 'text-center'
        }
    ]
})

$(table.table().header()).css({
    'color' : 'white',
    'background' : 'rgba(8, 0, 46,0.7)'
})

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

app.bind = function(){
    app.sendAjax();
}

app.sendAjax= function(){
    $(document).on('change', '.qty', function(){
        var tr = $(this).closest('tr');
        var td = $(this).closest('td');

        
        var origqty = table.cell(tr, 18).nodes().to$().find('.hiddenqty').val();

        var qty = $(this).val();

        if(qty > origqty){
            $(this).val(origqty);
        }
       
    })
    $(document).on('change', '.origqty', function(){
        var tr = $(this).closest('tr');
        var td = $(this).closest('td');
        var val = $(this).val();
       
        table.cell(tr, 18).nodes().to$().find('.hiddenqty').val(val);
    })
    $(document).on('click', '.savePPMP', function(){
        var transcode = $(this).attr('data-transcode');
        savePPMP(transcode);
    })

    $(document).on('click', '.sendPPMP', function(){
        var transcode = $(this).attr('data-transcode');
        sendPPMP(transcode);
    })
}   

app.bind();


function savePPMP(transcode){
    var milestones = [];
    var items = [];

    table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
        var datas = table.row(rowIdx).data();

        var jan = table.cell(rowIdx, 6).nodes().to$().find('#janqty').val();
        var feb = table.cell(rowIdx, 7).nodes().to$().find('#febqty').val();
        var mar = table.cell(rowIdx, 8).nodes().to$().find('#marqty').val();
        var apr = table.cell(rowIdx, 9).nodes().to$().find('#aprqty').val();
        var may = table.cell(rowIdx, 10).nodes().to$().find('#mayqty').val();
        var jun = table.cell(rowIdx, 11).nodes().to$().find('#junqty').val();
        var jul = table.cell(rowIdx, 12).nodes().to$().find('#julqty').val();
        var aug = table.cell(rowIdx, 13).nodes().to$().find('#augqty').val();
        var sep = table.cell(rowIdx, 14).nodes().to$().find('#sepqty').val();
        var oct = table.cell(rowIdx, 15).nodes().to$().find('#octqty').val();
        var nov = table.cell(rowIdx, 16).nodes().to$().find('#novqty').val();
        var dec = table.cell(rowIdx, 17).nodes().to$().find('#decqty').val();

        var itemcode = datas[0];
        var qty = table.cell(rowIdx, 18).nodes().to$().find('.hiddenqty').val();

        var milestone = jan+':'+feb+':'+mar+':'+apr+':'+may+':'+jun+':'+jul+':'+aug+':'+sep+':'+oct+':'+nov+':'+dec;

        var array = {
            'itemcode' : itemcode,
            'milestones' : milestone,
            'transcode' : transcode
        };

        var darray = {
            'qty' : qty,
            'itemcode' : itemcode,
            'transcode' : transcode
        };

        milestones.push(array);
        items.push(darray);

        
    } );

    $.ajax({
        type: 'post',
        url: 'savePPMP',
        data: {milestones : milestones, items : items},
        dataType: 'JSON',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    swal({
                        icon: 'success',
                        text: res.message,
                        timer: 1500
                    })
                    break;
                }
                case 'error':
                {
                    swal({
                        icon: 'error',
                        text: res.message,
                        timer: 1500
                    })
                    break;
                }
            }
        }
    })
}

function sendPPMP(transcode){
    
    $.ajax({
        type: 'post',
        url: 'sendPPMP',
        data: {transcode: transcode},
        dataType: 'JSON',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    swal({
                        icon: 'success',
                        text: res.message,
                        timer: 1500
                    })
                    break;
                }
                case 'error':
                {
                    swal({
                        icon: 'error',
                        text: res.message,
                        timer: 1500
                    })
                    break;
                }
            }
        }
    })
}

function displayItems(){
    
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
