var departmentsTable = $('#departmentsTable').DataTable({
    paginate: false,
    lengthChange: false,
    info: false,
    scrollY: '300px',
    select: {
        style:    'checkbox',
        selector: 'td:first-child'
    },
    columnDefs : [
        {
            className: 'select-checkbox',
            orderable: false,
            targets: 0,
            
        }
    ]
})

var budgetTable = document.getElementById('budgetTable');

app.bind = function(){
    app.sendAjax();
}
var addModal = $('#addModal');

app.sendAjax = function(){
    $(document).on('click', '.addenduser', function(){
        addModal.modal('show');
        var id = $(this).attr('data-id');
        var row = $(this).closest('tr');
        var papcode = $(this).attr('data-papcode');

        $('#addModalLabel').text($(this).attr('data-programname'));
        $('.add').attr('data-id', id);
        $('.add').attr('data-papcode', papcode);
        $('.add').attr('data-row', row[0].rowIndex);
        getDepartments();
    })
    
    $(document).on('click', '.add', function(){
        var id = $(this).attr('data-id');
        var row = $(this).attr('data-row');
        var papcode = $(this).attr('data-papcode');

        var dataTableRows = departmentsTable.rows({selected: true}).data().toArray();
        var arrTableSelectedRowsRendered = [];
        var names = [];

        for (var i = 0; i < dataTableRows.length; i++){
            dataTableRows[i] = dataTableRows[i].slice(1, dataTableRows[i].length);

            arrTableSelectedRowsRendered.push( dataTableRows[i].slice( 0, dataTableRows[i].length-1)  );
            names.push( dataTableRows[i].slice( 1, dataTableRows[i].length)  );
        }

        names.forEach(element => {
            var str = element;
            var template = element;

            budgetTable.rows[row].cells[2].append(template);
        })
        console.log(arrTableSelectedRowsRendered);
        add(id, papcode, arrTableSelectedRowsRendered);
    })

    $(document).on('click', '.saves', function(){
        var row = $(this).closest('tr');
        var papid = $(this).attr('data-id');
        var papcode = $(this).attr('data-papcode');

        var budget = budgetTable.rows[row[0].rowIndex].cells[8].children[0].value;
        var mode = budgetTable.rows[row[0].rowIndex].cells[4].children[0].value;
        
        var datas = {
            mode: mode,
            budget : budget
        };

        console.log(datas)
        setBudget(papid, datas, papcode);
    })
}

app.bind();

function getDepartments(){
    $.ajax({
        type: 'get',
        url: 'getDepartments',
        dataType: 'json',
        success:function(res){
            departmentsTable.clear().draw();
            res.forEach(element => {
                
                departmentsTable.row.add([
                    null,
                    element.deptid,
                    element.name
                ]).draw(false)
            });
        }
    })
}

function add(papid, papcode, datas){
    $.ajax({
        type: 'post',
        url: 'setDepartments',
        data: {papid : papid, datas : datas, papcode: papcode},
        dataType: 'json',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    swal({
                        text: res.message,
                        icon: 'success',
                        timer: 1500
                    })
                    setInterval(() => {
                        window.location.reload()
                    }, 1600)
                    break;
                }
                case 'error':
                {
                    swal({
                        text: res.message,
                        icon: 'error',
                        timer: 1500
                    })
                    break;
                }
            }
        }
    })
}

function setBudget(papid, datas, papcode){
    $.ajax({
        type: 'post',
        url: 'setBudget',
        data: {papid : papid, datas : datas, papcode: papcode},
        dataType: 'json',
        success: function(res){
            switch(res.status){
                case 'success':
                {
                    swal({
                        text: res.message,
                        icon: 'success',
                        timer: 1500
                    })
                    setInterval(() => {
                        window.location.reload()
                    }, 1600)
                    break;
                }
                case 'error':
                {
                    swal({
                        text: res.message,
                        icon: 'error',
                        timer: 1500
                    })
                    break;
                }
            }
        }
    })
}