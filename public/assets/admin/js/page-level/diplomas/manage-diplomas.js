var TableDataTables = function(){
    var handleDiplomaTable = function(){
        var manageDiplomaTable = $("#diplomas_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageDiplomaTable.dataTable({
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
                    "page": "manage_diplomas"
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
            handleDiplomaTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

function displayTrashModalForm($diplomaID) {
    var url = '/control-panel/diplomas/trash/' + $diplomaID;
    $("#deleteForm").attr('action', url);
}

