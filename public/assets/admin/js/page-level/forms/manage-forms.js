var TableDataTables = function(){
    var handleFormTable = function(){
        var manageFormTable = $("#forms_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageFormTable.dataTable({
            "processing" : true,
            "serverSide" : true,
            "paging": true,
            "scrollX": false,
            "ajax" : {
                url : baseURL + filePath,
                method : "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {
                    "page": "manage_forms"
                }
            },
            "lengthMenu" : [
                [5, 10, 20, -1],
                [5, 10, 20, 'All']
            ],
            "order" : [
                [1, "ASC"]
            ],
            "columnDefs":[{
                'orderable' : false,
                'targets' : [0, -1]
            }],
        });
    }
    return {
        init : function(){
            handleFormTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

