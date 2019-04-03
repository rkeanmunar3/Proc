(function (app) {
    var itemsTable = $('#itemsTable').DataTable({
        'info' : false,
        'paginate' : false,
        'lengthChange' : false,
        'scrollY' : '700px',
        'columnDefs' : [
            {
                width: '150px',
                targets: 0,
                className: 'text-center'
            },
            {
                width: '800px',
                targets: 1,
            },
            {
                className: 'text-center',
                targets: 2
            },
            {
                className: 'text-center',
                targets: 3
            },
            {
                width: '20px',
                sortable: false,
                targets: 4,
            },
        ]
    });
    var biddersTable = $('#biddersTable').DataTable({
        'info' : false,
        'paginate' : false,
        'lengthChange' : false,
        'scrollY' : '600px',
        /*'select': {
            style:    'checkbox',
            selector: 'td:first-child'
        },*/
        'columnDefs' : [/*
            {
                className: 'select-checkbox',
                orderable: false,
                width: '20px',
                targets: 0,
                className: 'text-center'
            },*/
            {
                visible: false,
                targets: [0,2],
               // className: 'text-center'
            },
            {
                width: '800px',
                targets: 1,
            },
            {
                width: '20px',
                sortable: false,
                targets: 3,
            },
        ]
    });
    var bidInfoTable = $('#bidInfoTable').DataTable({
        'info' : false,
        'paginate' : false,
        'lengthChange' : false,
        'scrollY' : '300px',
        'searching' : false,
        'columnDefs' : [
            {
                visible: false,
                targets: 0,
            },
            {
                width: '500px',
                targets: 1,
            },
            {
                width: '150px',
                targets: [2,3,4,5,6],
            },
        ]
    });

    $(itemsTable.table().header()).css({
        background : 'rgba(1, 10, 76, 0.8)',
        color : 'white'
    })
    app.bind = function () {
        app.sendAjax();
    };

    app.sendAjax = function () {
        $(document).ready(function () {
            getItems();
        })
        $(document).on('click', '.addBidderModal', function () {
            var itemcode = $(this).attr('data-itemcode');
            var has_bidder = parseInt($(this).attr('data-hasbidder'));
            var id = '#'+itemcode+'itemChildTable';

            var tr = $(this).closest('tr');
            var row = itemsTable.row(tr);

            if(has_bidder > 0){

                if(!row.child.isShown()){
                    row.child.show();
                    if(!$.fn.DataTable.isDataTable(id)){
                        initializeTable(id);
                    }
                }
            }

            $('#bidderInfoModal').modal('show');
            $('.addBid').attr('data-itemcode', itemcode);

            getSuppliers(itemcode);
        })
        $(document).on('click', '.addBid', function () {
            var bidderid = $('#bidder').val();
            var itemcode = $(this).attr('data-itemcode');
            var  bidderName = $('option:selected', '#bidder').text();
            var  bidderAddress = $('#address').val();
            var  bidprice = $('#bidprice').val();
            var  brand = $('#brand').val();
            var  manufacturer = $('#manufacturer').val();
            var  origin = $('#origin').val();
            var  description = $('#description').val();

            $.ajax({
                type: 'post',
                url: 'addBidder',
                data: {itemcode: itemcode, bidderid: bidderid, bidprice: bidprice, brand: brand, manufacturer: manufacturer, origin: origin, description: description},
                success: function () {
                    var tables = $('.dataTable').DataTable();
                    var table = tables.table('#'+itemcode+'itemChildTable');

                    table.row.add([
                        null,
                        null,
                        bidderName,
                        bidprice,
                        brand,
                        description,
                        manufacturer,
                        origin
                    ]).draw(false);
                    //getSuppliers(itemcode);
                }
            })
        })
        $(document).on('mouseenter', '.bidderName', function () {
            var pop = $(this).popover({
                html: true,
                title: 'Bidder Information',
                container: 'body',
                trigger: 'click',
                content: function () {
                    var template = '<div class="col-md-12">' +
                                        '<div class="row">' +
                                            '<div class="input-group mb-2">' +
                                                '<span class="col-form-label col-md-4">Name:</span>' +
                                                '<label class="col-form-label col-md-8">'+ $(this).attr('data-name') +'</label>'+
                                            '</div>' +
                                        '</div>' +
                                        '<div class="row">' +
                                            '<div class="input-group mb-2">' +
                                                '<span class="col-form-label col-md-4">Address:</span>' +
                                                '<label class="col-form-label col-md-8" >'+ $(this).attr("data-address") +'</label>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>';

                    return template;
                }
            });

            pop.trigger('click');

            $(this).on('mouseout', function () {
                pop.trigger('click');
                $('.popover').popover.not(this).hide();
            })
        })
        $(document).on('click', '.biddercount', function () {
            var itemcode = $(this).attr('data-itemcode');
            var tr = $(this).closest('tr');
            var row = itemsTable.row(tr);

            if(row.child.isShown()){
                row.child.hide();
            }else {
                row.child.show();
                var id = '#'+ itemcode +'itemChildTable';
                if(!$.fn.DataTable.isDataTable(id)){
                    initializeTable(id);
                }
        }

        })
        $('#bidder').change(function (e) {
            var address = $('option:selected', this).attr('data_address');
            $('#bidderAddress').text(address);
        })
    };

    app.bind();

    function getItems() {
        $.ajax({
            type: 'get',
            url: 'psItems',
            dataType: 'json',
            async: false,
            success: function (res) {
                itemsTable.clear().draw(false);

                res.forEach(element => {
                    var index = itemsTable.row.add([
                        element.id,
                        '<strong>'+ element.name.toUpperCase() +'&nbsp</strong>'+ element.specs +' '+ element.description,
                        element.unit,
                        '<a href="#" class="biddercount hover-blue" data-itemcode="'+ element.itemcode +'" data-hasbidder="'+ element.has_bidder +'" style="">'+ element.biddercount +'</a>',
                        '<a href="#" class="addBidderModal" data-itemcode="'+ element.itemcode +'" data-hasbidder="'+ element.has_bidder +'"><i class="fas fa-plus"></i></a>'
                    ]);
                    var rw = itemsTable.row(index.index());
                    setChildTable(element.itemcode, element.has_bidder, rw);
                    var row = itemsTable.row(index.index()).node();

                    if(parseInt(element.has_bidder) == 0){

                        $(row).css({
                            background: '#ff2b2b',
                            color: 'white'
                        });
                    }
                })
                itemsTable.draw();
            }
        })


    }
    function getSuppliers(itemcode) {
        var count = 0;
        $.ajax({
            type: 'get',
            url: 'getSuppliers',
            data: {itemcode: itemcode},
            dataType: 'json',
            success: function (res) {
                $('#bidder').empty();
                res.forEach(element => {
                    if(count == 0){
                        $('#bidder').append($('<option>', {
                            value: null,
                            text: 'Select Supplier'
                        }).attr({
                            hidden: 'hidden',
                            selected: 'selected',
                            disabled: 'disabled',

                        }));

                        count += 1;
                    }
                    $('#bidder').append($('<option>', {
                        value: element.suppid,
                        text: element.name,
                        data_address: element.address
                    }));
                })
            }
        })
    }
    function getItemBidder(itemcode) {
         var template = '';
         var rows = '';
         var count = 0;

         $.ajax({
            type: 'get',
            url: 'getBidders',
            data: {itemcode: itemcode},
            dataType: 'json',
            async: false,
            success: function (res) {
                res.forEach(element => {
                    count += 1;
                    var bidprice = parseFloat(element.bidprice).toFixed(2);
                    rows += '<tr>' +
                                '<td></td>' +
                                '<td>'+ count +'</td>' +
                                '<td>'+ element.name +'</td>' +
                                '<td>'+ bidprice +'</td>' +
                                '<td>'+ element.brand +'</td>' +
                                '<td>'+ element.description +'</td>' +
                                '<td>'+ element.manufacturer +'</td>' +
                                '<td>'+ element.origin +'</td>' +
                            '</tr>';
                })

                template = '<table class="table table-sm childTables" id="'+ itemcode +'itemChildTable">'+
                                '<thead>' +
                                    '<tr>' +
                                        '<th></th>' +
                                        '<th>Final Rank</th>' +
                                        '<th>Bidder</th>' +
                                        '<th>Bid Price</th>' +
                                        '<th>Brand</th>' +
                                        '<th>Packaging</th>' +
                                        '<th>Manufacturer</th>' +
                                        '<th>Origin</th>' +
                                    '</tr>'+
                                '</thead>' +
                                '<tbody>' + rows +'</tbody>' +
                            '</table>';
            }
        })

        return template;

    }
    function setChildTable(itemcode, has_bidder, row) {
        if(parseInt(has_bidder) > 0){
            row.child(getItemBidder(itemcode));
        }
    }
    function initializeTable(id) {
        $(id).DataTable({
            searching: false,
            paginate: false,
            lengthChange: false,
            info: false,
            sorting: false,
            columnDefs: [
                {
                    width: '300px',
                    targets: [0],
                },
                {
                    width: '150px',
                    className: 'text-center',
                    targets: [1]
                },
                {
                    width: '800px',
                    targets: [2],
                },
                {
                    width: '150px',
                    targets: [3]
                },
                {
                    width: '200px',
                    targets: [4]
                },
                {
                    width: '450px',
                    targets: [5]
                },
                {
                    width: '450px',
                    targets: [6]
                },
                {
                    width: '150px',
                    targets: [7]
                }
            ]
        });
    }
})(jQuery);

