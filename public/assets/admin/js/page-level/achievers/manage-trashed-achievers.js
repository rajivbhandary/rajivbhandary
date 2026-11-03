var TableDataTables = function(){
    var handleAchieverTable = function(){
        var manageAchieverTable = $("#trashed_achievers_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageAchieverTable.dataTable({
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
                    "page": "manage_trashed_achievers"
                }
            },
            "lengthMenu" : [
                [5, 10, 20, -1],
                [5, 10, 20, 'All']
            ],
            "order" : [
                [2, "ASC"]
            ],
            "columnDefs":[{
                'orderable' : false,
                'targets' : [0, 1, -1]
            }],
        });

    }
    return {
        init : function(){
            handleAchieverTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})


function displayDeleteModalForm($achieverID) {
    var url = '/control-panel/achievers/' + $achieverID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/achievers/restore/' + id;
    $("#restoreForm").attr('action', url);
}
