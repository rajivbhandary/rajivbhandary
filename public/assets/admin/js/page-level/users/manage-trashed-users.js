var TableDataTables = function(){
    var handleUserTable = function(){
        var manageUserTable = $("#trashed_users_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageUserTable.dataTable({
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
                    "page": "manage_trashed_users"
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
            handleUserTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})

function displayDeleteModalForm($userID) {
    var url = '/control-panel/users/' + $userID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/users/restore/' + id;
    $("#restoreForm").attr('action', url);
}
