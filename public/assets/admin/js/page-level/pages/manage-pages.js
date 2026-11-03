var TableDataTables = function(){
    var handlePageTable = function(){
        var managePageTable = $("#pages_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = managePageTable.dataTable({
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
                    "page": "manage_pages"
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
                'targets' : [0, 1, -2, -1]
            }],
        });
    }
    return {
        init : function(){
            handlePageTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})
