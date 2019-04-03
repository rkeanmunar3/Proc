var itemTable = $('#itemsTable').DataTable({
    'paging': false,
    'info' : false,
    'lengthChange' : false,
    'dom': '<t>',
    'scrollY': '530px'
})

$(itemTable.table().header()).css({
    'background' : 'rgba(10, 2, 80, 0.3)',
    'color' : 'white'
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
             return $(this).attr('data-spec');
          },
      }).trigger('click');
      
      $(document).on('mouseout', this, function(){
          $('.popover').popover('hide');
      })

  })

  $(document).on('mouseover', '.itemname', function(){
    var pop = $(this).popover({
         html: true,
         title: '<strong>Name</strong>',
         trigger: 'click',
         content: function(){
            return $(this).attr('data-name');
         },
     }).trigger('click');
     
     $(document).on('mouseout', this, function(){
         $('.popover').popover('hide');
     })

 })

 app.bind = function(){
     app.sendAjax();
 }

 app.sendAjax = function(){
    $('.approveTransaction').on('click', function(){
        var transcode = $(this).attr('data-transcode');
        approveTransaction(transcode);
    })
 }

 app.bind();

 function approveTransaction(transcode){
     $.ajax({
         type : 'post',
         url : 'approveTransaction',
         data: {transcode : transcode},
         dataType: 'json',
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