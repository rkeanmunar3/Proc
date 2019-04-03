

var docsTable = $('#documents_table').DataTable({
    'info' : false,
    'lengthChange' : false,
    'pageLength': 10,
    'dom': '<"text-center justify-content-center"t<"row col-md-12 justify-content-center"p>>',
    width: '100%',
    buttons : [

    ],
});

var addModal = $('#addDocumentModal');


app.bind = function(){
    app.sendAjax();
}
app.sendAjax = function(){
    $(document).ready(function(){

    });
   
    $(document).on('click','.view', function(){
        var id = $(this).attr('data-id');
        alert(id);
    });

    $('#add-document-button').on('click', function(){
        addNewTransaction();
    });

    $('#category').on('change', function(){
        var id = $(this).val();

        loadDocType(id);
   });

   $('#department').on('change', function(){
    var dept_id = $(this).val();

    loadUsers(dept_id);
    });

   $('#search').on('keyup', function(){
       docsTable.search($(this).val()).draw();
   })
};

app.bind();

/* ----------------------------------------- 
                FUNCTIONS
   ----------------------------------------- */

   function addNewTransaction(){
        var form = $('#add-document-form');
        var trans_type = $('#add-document-button').attr('transaction-type');

        $.ajax({
            method: 'post',
            url: 'addTransaction',
            data: form.serialize(),
            dataType: 'json',
            success: function(response){
                switch(response.status)
                {  
                    case 'success':
                    {
                        var date = response.datas.created_at.date.split('.');

                        addModal.modal('hide');
                        swal({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            button: 'Ok'
                        });

                        docsTable.row.add([
                            response.datas.document_category,
                            response.datas.type,
                            'From '+response.datas.sender_name+' : ' +response.datas.details,
                            response.datas.recipient_id,
                            response.datas.trans_status,
                            date[0],
                            '<a href="#" id="viewButton" class="view" data-id="'+ response.id +'">'+
                                '<i class="fas fa-eye"></i>' + 
                            '</a>',
                        ]).draw(false);
                        break;
                    }
                }
                
            }
        });
   };

   function loadDocType(id)
   {
       $('option', '#document_type').remove();
       $.ajax({
           method: 'get',
           url: 'get_types',
           dataType: 'json',
           data: 'id='+id,
           success: function(response){

               if(id != '')
               {
                response.forEach(element => {
                    $('#document_type').append($('<option>', {value : element.category_code, text : element.name}));
                });
               }
           }
       })
   }

   function loadUsers(department_id)
   {
        $.ajax({
            method: 'get',
            url: 'get_users',
            dataType: 'json',
            data: 'department_id='+department_id,
            success: function(response){
                $('option', '#recipient').remove();
                response.forEach(element => {
                    $('#recipient').append($('<option>',{ value: element.id, text: element.name}))
                });
            }
        })
   }

/* -----------------------------------------
                 POPOVERS                                   
   ----------------------------------------- */
var pop = $('#addButton').popover({
    trigger: 'click',
    html: true,
    content : '<div class="pop-container"><a href="#" class="addButton btn btn-sm btn-success" transaction-type="incoming">Incoming</a>&nbsp<a href="#" class="addButton btn btn-sm btn-primary" transaction-type="outgoing">Outgoing</a></div>',
    animation: true,
    placement: 'right'
});

$('#reloadButton').popover({
    content : 'Refresh',
    animation: true,
    trigger: 'hover',
    placement: 'right'
});
$('.view').popover({
    content : 'View',
    animation: true,
    trigger: 'hover',
    placement: 'auto'
});

/* ---------------------------------------
                MODALS
    -------------------------------------- */

$(document).on('click', '.addButton', function(){
    var trans_type = $(this).attr('transaction-type');

    var caps = trans_type.charAt(0).toUpperCase();
    var slice = trans_type.slice(1);
    var title = caps + slice + ' Document';

    addModal.modal('show');
    $('#addDocumentModalLabel').text(title);
    $('#trans_type').val(trans_type);
    pop.popover('hide');
})

var popshown = false;
$(document).on('shown.bs.popover', pop, function(){
    popshown = true;
});
$(document).on('hidden.bs.popover', pop, function(){
    popshown = false;
});
$(document).on('click', function(e){
    var id = $(e.target).attr('id');

    if(id != 'addButton' && popshown == true){
        pop.popover('hide');
    }
})