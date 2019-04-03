
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN' : $('meta[name="csrf-token"').attr('content')
    }
})
app.bind = function(){
    app.sendAjax();
}

app.sendAjax = function(){
    $(document).ready(function(){
        restockNotifications();
    })
}

app.bind();

function restockNotifications(){
    $.ajax({
        type : 'get',
        url : 'restockNotifications',
        dataType: 'json',
        success: function(res){
            if(res > 0){
                $('.notification').notify('You have a new notification',{
                    autoHide : true,
                    style: 'bootstrap',
                    className: 'info',
                    position: 'bottom-right',
                    hideDelay: 3000
                });
                $('#notif-count').text(1);
                /*res.forEach(element => {
                    var template = '<a href="#" style="color:black; cursor: pointer">' +
                                        '<div class="container-fluid item-container">' +
                                                '<div class="row">' +
                                                        '<div class="col-md-12">' +
                                                                '<div class="form-group mb-1">' +
                                                                        '<div class="row">' +
                                                                                '<div class="col-md-8">' +
                                                                                        '<small>'+ element.name +'</small>' +
                                                                                '</div>' +
                                                                                '<div class="col-md-4">' +
                                                                                        '<small>Balance: '+ element.balance +'</small>' +
                                                                                '</div>' +
                                                                        '</div>' +
                                                                '</div>' +
                                                        '</div>' +
                                                '</div>' +
                                        '</div>' +
                                    ' </a>'+
                                    '<hr class="mt-0 mb-0 bg-primary"></hr>';

    

                });*/
                var template = '<div class="form-group">' +
                                    '<a href="#" class="notif-link nav-link text-gray">'+ res +' items reached reorder point</a>'+
                                '</div>';
                $('#notif-content').append(template);
            }
           
        }
    })
}
