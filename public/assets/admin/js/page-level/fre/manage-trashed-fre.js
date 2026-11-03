var TableDataTables = function(){
    var handleFRETable = function(){
        var manageFRETable = $("#trashed_fre_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageFRETable.dataTable({
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
                    "page": "manage_trashed_fre"
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
                'targets' : [0, 1, -1]
            }],
        });

    }
    return {
        init : function(){
            handleFRETable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})


function displayDeleteModalForm($freID) {
    var url = '/control-panel/fre/' + $freID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/fre/restore/' + id;
    $("#restoreForm").attr('action', url);
}
