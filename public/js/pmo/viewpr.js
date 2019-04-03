
var itemsTable = $('#itemsTable').DataTable({
    'info' : false,
    'lengthChange' : false,
    'searching' : false,
    //'dom': '<t<p>>',
    'scrollY' : '470px',
    'paginate' : false,
    'columnDefs' : [
        {
            width: '120px',
            targets: [0]
        },
        {
            orderable : false,
            targets : [7],
        }
    ]
})

var id = $(itemsTable.table().header()).attr('id', 'tableHeader');
//$('#itemsTable_paginate').detach().appendTo('.paging');

$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

var removedItems = [];
var mode = '';

app.bind = function(){
    app.sendAjax();
}

app.sendAjax = function(){
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
        if(removedItems.length > 0){
            $('#actionButton').text('RETURN ').css('color', '#a2a2ff').append('<i class="fas fa-undo"></i>').addClass('returnTransaction').removeClass('approveTransaction');      
        }else{
            $('#actionButton').text('APPROVE ').css('color', 'lime').append('<i class="fas fa-check"></i>').removeClass('returnTransaction').addClass('approveTransaction');      
        }
    })
    $(document).on('click', '.returnItem', function(){
        var tr = $(this).closest('tr');
        var item = $(this).attr('data-itemcode');

        $(tr).css('background', '');

        var index = removedItems.indexOf(item);

        removedItems.splice(index,1);

        $.notify('Item returned', {
            className : 'success',
            style : 'bootstrap',
            autoHideDelay: 1000,
        })

        $(this).addClass('removeItem');
        $(this).removeClass('returnItem');
        $(this).find('.fas').toggleClass('fa-check fa-times')
        if(removedItems.length > 0){
            $('#actionButton').text('RETURN ').css('color', '#a2a2ff').append('<i class="fas fa-undo"></i>').addClass('returnTransaction').removeClass('approveTransaction');      
        }else{
            $('#actionButton').text('APPROVE ').css('color', 'lime').append('<i class="fas fa-check"></i>').addClass('approveTransaction').removeClass('returnTransaction');      
        }

    })
    
    $(document).on('click', '.approveTransaction', function(){
        var prno = $(this).attr('data-transcode');
     
        approvePR(prno);
    })
    $(document).on('click', '.returnPR', function(){
        var prno = $(this).attr('data-prno');
      
        //approvePR(prno);
    })
    $(document).on('click', '.forwardPR', function(){
        var prno = $(this).attr('data-prno');
        $('#forwardModal').modal();
    })
    $(document).on('change', '#supplier', function(){
        var transcode = $(this).attr('data-transcode');
        var id = $(this).val();

        setSupplier(transcode, id);
    })
   /* $(document).on('click', '.poButton', function(){
        var transcode = $(this).attr('data-transcode');
        
        $('#forwardModal').modal();
        $('.generatePO').attr('data-transcode', transcode);
        $('#forwardModalLabel').text(transcode);
    })

    /************POPOVERS**************/

    $(document).on('mouseover', '.itemdesc', function(){
       var pop = $(this).popover({
            html: true,
            title: '<strong>Item Description</strong>',
            trigger: 'click',
            content: function(){
               return $(this).attr('data-desc');
            },
        }).trigger('click');
        
        $(document).on('mouseout', this, function(){
            $('.popover').popover('hide');
        })

    })

    $(document).on('mouseover', '.itemspec', function(){
        var pop = $(this).popover({
             html: true,
             title: '<strong>Specification</strong>',
             trigger: 'click',
             content: function(){
                return $(this).attr('data-desc');
             },
         }).trigger('click');
         
         $(document).on('mouseout', this, function(){
             $('.popover').popover('hide');
         })
 
     })
}

app.bind();

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
                    window.location.reload();
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

function setSupplier(prno, id){
    $.ajax({
        type: 'post',
        url: 'setSupplier',
        data: "transcode="+prno+"&supplierid="+id,
        dataType: 'JSON',
        success: function(res){
            
        }
    })
}

