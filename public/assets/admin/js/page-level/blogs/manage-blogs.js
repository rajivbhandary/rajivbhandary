var TableDataTables = function(){
    var handleBlogTable = function(){
        var manageBlogTable = $("#blogs_datatable");
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
                    "page": "manage_blogs"
                }
            },
            "lengthMenu" : [
                [5, 10, 20, -1],
                [5, 10, 20, 'All']
            ],
            "order" : [
                
            ],
            "columnDefs":[{
                'orderable' : false,
                'targets' : [0, 1, -2, -1]
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

function displayTrashModalForm($blogID) {
    var url = '/control-panel/blogs/trash/' + $blogID;
    $("#deleteForm").attr('action', url);
}

function displayApproveModalForm($blogID) {
    var url = '/control-panel/blogs/approve/' + $blogID;
    $("#approveForm").attr('action', url);
}

function displayDisapproveModalForm($blogID) {
    var url = '/control-panel/blogs/disapprove/' + $blogID;
    $("#disapproveForm").attr('action', url);
}
