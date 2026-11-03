var TableDataTables = function(){
    var handleStreamTable = function(){
        var manageStreamTable = $("#streams_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageStreamTable.dataTable({
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
                    "page": "manage_streams"
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
            handleStreamTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

function displayTrashModalForm($streamID) {
    var url = '/control-panel/streams/trash/' + $streamID;
    $("#deleteForm").attr('action', url);
}

