var TableDataTables = function(){
    var handleBoardPaperTable = function(){
        var manageBoardPaperTable = $("#board_papers_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageBoardPaperTable.dataTable({
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
                    "page": "manage_board_papers"
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
            handleBoardPaperTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

function displayTrashModalForm($boardPaperID) {
    var url = '/control-panel/board-papers/trash/' + $boardPaperID;
    $("#deleteForm").attr('action', url);
}

