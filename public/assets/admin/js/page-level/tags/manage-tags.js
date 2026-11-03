var TableDataTables = function(){
    var handleTagTable = function(){
        var manageTagTable = $("#tags_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageTagTable.dataTable({
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
                    "page": "manage_tags"
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
            handleTagTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

function displayTrashModalForm($tagID) {
    var url = '/control-panel/tags/trash/' + $tagID;
    $("#deleteForm").attr('action', url);
}

