var TableDataTables = function(){
    var handleBlogTable = function(){
        var manageBlogTable = $("#trashed_blogs_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageBlogTable.dataTable({
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
                    "page": "manage_trashed_blogs"
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
            handleBlogTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})


function displayDeleteModalForm($blogID) {
    var url = '/control-panel/blogs/' + $blogID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/blogs/restore/' + id;
    $("#restoreForm").attr('action', url);
}
