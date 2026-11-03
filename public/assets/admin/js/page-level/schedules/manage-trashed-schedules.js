var TableDataTables = function(){
    var handleScheduleTable = function(){
        var manageScheduleTable = $("#trashed_schedules_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageScheduleTable.dataTable({
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
                    "page": "manage_trashed_schedules"
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
            handleScheduleTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})


function displayDeleteModalForm($scheduleID) {
    var url = '/control-panel/schedules/' + $scheduleID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/schedules/restore/' + id;
    $("#restoreForm").attr('action', url);
}
