var TableDataTables = function(){
    var handleCourseTable = function(){
        var manageCourseTable = $("#trashed_courses_datatable");
        var baseURL = window.location.origin;
        var filePath = "/ajax";
        var oTable = manageCourseTable.dataTable({
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
                    "page": "manage_trashed_courses"
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
                'targets' : [0, 1, 6, -1]
            }],
        });

    }
    return {
        init : function(){
            handleCourseTable();
        }
    }
}();

jQuery(document).ready(function(){
    TableDataTables.init();
})


function displayDeleteModalForm($courseID) {
    var url = '/control-panel/courses/' + $courseID;
    $("#deleteForm").attr('action', url);
}

function displayRestoreModalForm(id){
    var url = '/control-panel/courses/restore/' + id;
    $("#restoreForm").attr('action', url);
    $("#restoreModalContent").text('Are you sure want to restore the Course ?');
    $("#restoreModalLabel").text('Restore Course');
}

function displayRestoreStreamModalForm(id){
    var url = '/control-panel/courses/' + id + '/streams/restore/';
    $("#restoreForm").attr('action', url);
    $("#restoreModalContent").text('Are you sure want to restore the Stream ?');
    $("#restoreModalLabel").text('Restore Stream');
}
