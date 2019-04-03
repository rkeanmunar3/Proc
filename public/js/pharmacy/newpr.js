(function(app){


    var items = [];

var inventoryTable = $('#inventoryTable').DataTable({
    'columnDefs': [
        {
            visible: false,
            targets: [0],
        },
        {
            width: '250px',
            targets: [1],
        },
        {
            width: '150px',
            targets: [5,6],
            class: 'text-center'
        },
        {
            width: '400px',
            targets: [4,2,3]
        },

    ],
    'info' : false,
    'searching' : true,
    'lengthChange' : false,
    'dom': '<t<p>>',
    'paging': false,
    'scrollY': '520px'
});

$(inventoryTable.table().header()).css({
    background: 'rgba(9, 1, 53, 0.7)'
})
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
    $(document).on('click','.addItem',function(){
        var tr = $(this).closest('tr');
        var data = inventoryTable.row(tr).data();

        $(this).popover({
            title: '<strong>Enter Quantity</strong>',
            html: true,
            content: '<div class="input-group"> ' +
                        '<input type="number" class="form-control qty" id="">' +
                        '<button class="btn btn-sm btn-primary addQty" data-row="'+ tr[0].rowIndex +'">ADD <i class="fas fa-plus"></i></button>'+
                     '</div>'
        })

        $('.addItem').not(this).popover('hide');
        //addItem(data);

        $(tr).css('background', 'rgba(44, 224, 0, 0.5)');
    })
    $(document).on('click','.addQty',function(){
        var quantity = $(this).prev('.qty').val();
        var row = $(this).attr('data-row');

        var datas = inventoryTable.rows(row - 1).data();

        addItem(datas[0], quantity);
        $(tr).css({
            'background' : 'red'
        })
    })

    $(document).on('click','.sendPR',function(){
        
        if(items.length > 0){
            sendPR('P');
        }else{
            $.notify('Please add an item to your transaction first', {
                className: 'info',
                style : 'bootstrap',
                showAnimation: 'slideDown',

            })
        }
    })
    $(document).on('click','.savePR',function(){
        
        if(items.length > 0){
            sendPR('S');
        }else{
            $.notify('Please add an item to your transaction first', {
                className: 'info',
                style : 'bootstrap',
                showAnimation: 'slideDown',

            })
        }
    })
    $(document).on('click', '.viewPR', function(){
        $.ajax({
            type: 'get',
            url: 'newPR',
            success: function(res){

            }
        })
    })
    $('#attachmentForm').on('submit', function(){
        var form = $(this);
        
        $.ajax({
            type: 'post',
            url: 'uploadFile',
            data: form.serialize(),
            dataType: 'json',
            contentType: false,
            success: function(res){
                
            }
        })
    })
    $(document).on('mouseover', '.itemdesc', function(){
        var pop = $(this).popover({
             html: true,
             title: '<strong>Item Description</strong>',
             trigger: 'click',
             content: function(){
                return $(this).attr('data-desc');
             },
         }).trigger('click');
     })
     $(document).on('mouseout', '.itemdesc', function(){
        var pop = $(this).popover('hide');
     })
 
     $(document).on('mouseover', '.itemspec', function(){
         var pop = $(this).popover({
              html: true,
              title: '<strong>Specification</strong>',
              trigger: 'click',
              content: function(){
                 return $(this).attr('data-spec');
              },
          }).trigger('click');
  
      })
      $(document).on('mouseout', '.itemspec', function(){
        var pop = $(this).popover('hide');
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
                var price = 0;
                if(element.price == null){
                    price = 0;
                }else{
                    price = Number(element.price);
                }
               inventoryTable.row.add([
                    element.codegrp,
                    element.itemcode,
                    element.name,
                    element.description,
                    element.specs,
                    price,
                    '<a href="#" class="addItem">ADD <i class="fas fa-plus"></i></a>'
                ]).draw(false);
            });
        }
    })
}

function addItem(data, quantity){
    var itemcode = data[1];
    var itemname = data[2];
    var desc = data[3];
    var specs = data[4];
    var price = parseFloat(data[7]);

    var item = {
        'itemcode' : itemcode,
        'name' : itemname,
        'specs' : specs,
        'price' : price,
        'qty' : quantity,
        'desc' : desc
    };

    items.push(item);

    $.notify(itemname+' added',{
        autoHide : true,
        style: 'bootstrap',
        className: 'success',
        autoHideDelay: 1000,
    });
}

function sendPR(status){
    var purpose = $('#purpose').val();
    var type = $('#type').val();
    var supplier = $('#supplier').val();
    var total = 0;

    items.forEach(element => {
        var price = element.price * element.qty;
        total += price;
    })
    
    $.ajax({
        type: 'post',
        url: 'createTransaction',
        data: {items : items, purpose: purpose, type : type, supplier : supplier, total : total, status: status},
        dataType: 'json',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    swal({
                        icon: 'success',
                        text: res.message,
                        timer: 1500,
                    })
                    $('#transcode').val(res.transcode);
                    $('#attachmentForm').submit();
                    break;
                }
                case 'error':
                {   
                    swal({
                        icon: 'success',
                        text: res.message,
                        timer: 1500,
                    })
                    
                    break;
                }
            }
        }
    })
}

function uploadFile(form){
    
}


})(jQuery);